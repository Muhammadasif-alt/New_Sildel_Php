import { PageFlip } from 'page-flip';
import 'page-flip/src/Style/stPageFlip.css';

/**
 * Press flipbook. Cards with data-pdf open a <dialog> where PDF.js renders every page to an image
 * and StPageFlip turns them like a real magazine (two-page spread on wide screens, one page on
 * phones). Cards with data-image open the clipping enlarged. Arrow keys turn pages, Esc closes.
 */

let pdfjsLoader;

function loadPdfjs() {
    pdfjsLoader ??= Promise.all([import('pdfjs-dist'), import('pdfjs-dist/build/pdf.worker.min.mjs?url')]).then(([lib, worker]) => {
        lib.GlobalWorkerOptions.workerSrc = worker.default;
        return lib;
    });
    return pdfjsLoader;
}

/** Downloads a file as bytes, retrying a couple of times (dropped connections on busy or dev servers). */
async function fetchBytes(url, attempts = 3) {
    let lastError;
    for (let attempt = 1; attempt <= attempts; attempt++) {
        try {
            const response = await fetch(url, { credentials: 'same-origin' });
            if (!response.ok) throw new Error(`Request failed: ${response.status}`);
            return new Uint8Array(await response.arrayBuffer());
        } catch (error) {
            lastError = error;
            await new Promise((resolve) => setTimeout(resolve, 400 * attempt));
        }
    }
    throw lastError;
}

/** Renders every PDF page to a JPEG data URL, sized for the stage height and screen density. */
async function renderPages(lib, url, targetHeight, onProgress, isCancelled) {
    // Fetch the whole file once (small magazine extracts) instead of HTTP range requests,
    // which some servers, including PHP's built-in one, do not support.
    const data = await fetchBytes(url);
    const doc = await lib.getDocument({ data, disableRange: true, disableStream: true }).promise;
    const images = [];
    let ratio = 0.75;

    for (let n = 1; n <= doc.numPages; n++) {
        if (isCancelled()) return null;
        const page = await doc.getPage(n);
        const base = page.getViewport({ scale: 1 });
        if (n === 1) ratio = base.width / base.height;

        const scale = Math.min(3, targetHeight / base.height);
        const viewport = page.getViewport({ scale });
        const canvas = document.createElement('canvas');
        canvas.width = Math.round(viewport.width);
        canvas.height = Math.round(viewport.height);
        await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
        images.push(canvas.toDataURL('image/jpeg', 0.88));
        page.cleanup();
        onProgress(n, doc.numPages);
    }

    doc.destroy();
    return { images, ratio };
}

function setup(root) {
    const dialog = root.querySelector('[data-flipbook-dialog]');
    if (!dialog) return;

    const $ = (name) => dialog.querySelector(`[data-flipbook-${name}]`);
    const stage = $('stage');
    const wrap = $('wrap');
    const image = $('image');
    const loading = $('loading');
    const status = $('status');
    const counter = $('counter');
    const download = $('download');
    const hint = $('hint');
    const prev = $('prev');
    const next = $('next');

    let flip = null;
    let book = null;
    let pages = null;
    let token = 0;
    let lastTrigger = null;

    const updateCounter = () => {
        if (!flip) return;
        const total = flip.getPageCount();
        const index = flip.getCurrentPageIndex();
        const spread = flip.getOrientation() === 'landscape' && index > 0 && index < total - 1;
        counter.textContent = spread ? `${index + 1}-${index + 2} / ${total}` : `${index + 1} / ${total}`;
        prev.disabled = index <= 0;
        next.disabled = index >= total - (spread ? 2 : 1);
    };

    const destroyBook = () => {
        if (flip) {
            try {
                flip.destroy();
            } catch {
                book?.remove();
            }
        }
        flip = null;
        book = null;
    };

    /** Builds the book at the largest size that fits the stage. */
    const buildBook = (startPage = 0) => {
        if (!pages) return;
        destroyBook();

        const navSpace = window.matchMedia('(min-width: 56.25rem)').matches ? 150 : 24;
        const maxW = stage.clientWidth - navSpace;
        const maxH = stage.clientHeight - 16;
        const { ratio } = pages;

        // Two pages side by side when they fit at a readable size, otherwise one.
        const spread = pages.images.length > 1 && maxW / maxH > ratio * 1.25;
        const columns = spread ? 2 : 1;
        let pageH = maxH;
        let pageW = pageH * ratio;
        if (pageW * columns > maxW) {
            pageW = maxW / columns;
            pageH = pageW / ratio;
        }
        pageW = Math.floor(pageW);
        pageH = Math.floor(pageH);

        book = document.createElement('div');
        book.className = 'flipbook-book';
        book.style.width = `${pageW * columns}px`;
        book.style.height = `${pageH}px`;
        wrap.replaceChildren(book);

        flip = new PageFlip(book, {
            width: pageW,
            height: pageH,
            size: 'fixed',
            autoSize: false,
            showCover: true,
            usePortrait: true,
            drawShadow: true,
            maxShadowOpacity: 0.55,
            flippingTime: 900,
            mobileScrollSupport: false,
            showPageCorners: true,
            startPage,
        });
        flip.loadFromImages(pages.images);

        // StPageFlip paints the canvas white before each frame, which shows as a blank page beside
        // the closed cover. Clear it to transparent instead so only real pages are drawn.
        const render = flip.getRender();
        if (render && typeof render.clear === 'function') {
            render.clear = function clearTransparent() {
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            };
        }
        flip.on('flip', updateCounter);
        flip.on('changeOrientation', updateCounter);
        flip.on('init', updateCounter);
        requestAnimationFrame(updateCounter);
    };

    const reset = () => {
        token++;
        destroyBook();
        pages = null;
        wrap.replaceChildren();
        image.hidden = true;
        image.removeAttribute('src');
        loading.hidden = true;
        counter.textContent = '';
        prev.hidden = true;
        next.hidden = true;
        hint.hidden = true;
        download.hidden = true;
        dialog.classList.remove('is-image');
    };

    const open = async (trigger) => {
        lastTrigger = trigger;
        reset();
        const mine = token;
        const { pdf, title, date } = trigger.dataset;

        $('title').textContent = title ?? '';
        $('date').textContent = date ?? '';

        dialog.showModal();
        document.documentElement.classList.add('has-dialog');

        if (!pdf) {
            dialog.classList.add('is-image');
            image.src = trigger.dataset.image;
            image.alt = [title, date].filter(Boolean).join(', ');
            image.hidden = false;
            return;
        }

        download.href = pdf;
        download.hidden = false;
        loading.hidden = false;
        status.textContent = dialog.dataset.labelLoading;

        try {
            const lib = await loadPdfjs();
            const target = Math.min(2200, stage.clientHeight * Math.min(2, window.devicePixelRatio || 1) * 1.1);
            const rendered = await renderPages(
                lib,
                pdf,
                target,
                (n, total) => {
                    if (mine === token) status.textContent = `${dialog.dataset.labelLoading} ${n} / ${total}`;
                },
                () => mine !== token,
            );
            if (!rendered || mine !== token) return;

            pages = rendered;
            loading.hidden = true;
            prev.hidden = false;
            next.hidden = false;
            hint.hidden = false;
            buildBook(0);
        } catch (error) {
            if (mine !== token) return;
            console.error(error);
            status.textContent = dialog.dataset.labelError;
            dialog.querySelector('.flipbook-spinner').hidden = true;
        }
    };

    root.querySelectorAll('[data-flipbook-open]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            if (event.metaKey || event.ctrlKey || event.shiftKey || event.button === 1) return;
            event.preventDefault();
            open(trigger);
        });
    });

    prev.addEventListener('click', () => flip?.flipPrev());
    next.addEventListener('click', () => flip?.flipNext());
    $('close').addEventListener('click', () => dialog.close());

    $('fullscreen').addEventListener('click', () => {
        if (document.fullscreenElement) document.exitFullscreen();
        else dialog.requestFullscreen?.().catch(() => {});
    });

    // Click on the dark backdrop (outside the book) closes the viewer.
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });

    dialog.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') flip?.flipPrev();
        if (event.key === 'ArrowRight') flip?.flipNext();
    });

    dialog.addEventListener('close', () => {
        if (document.fullscreenElement) document.exitFullscreen().catch(() => {});
        reset();
        document.documentElement.classList.remove('has-dialog');
        lastTrigger?.focus();
    });

    let resizeTimer;
    const relayout = () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (!dialog.open || !pages) return;
            buildBook(flip ? flip.getCurrentPageIndex() : 0);
        }, 180);
    };
    window.addEventListener('resize', relayout);
    document.addEventListener('fullscreenchange', relayout);
}

export default function initFlipbook(roots) {
    roots.forEach(setup);
    // Warm PDF.js up while the visitor browses the grid, so the first magazine opens quickly.
    const warm = () => loadPdfjs().catch(() => {
        pdfjsLoader = undefined;
    });
    if ('requestIdleCallback' in window) requestIdleCallback(warm, { timeout: 3000 });
    else setTimeout(warm, 1500);
}

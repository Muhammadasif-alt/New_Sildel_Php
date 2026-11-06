/**
 * Mouse drag-to-scroll for a horizontal overflow container (useDragScroll equivalent).
 * Touch keeps native scrolling. A drag longer than 5px suppresses the click that follows,
 * so dragging across a card never opens it.
 *
 * @param {HTMLElement} track
 * @returns {() => void} cleanup
 */
export function dragScroll(track) {
    let down = false;
    let moved = false;
    let startX = 0;
    let startScroll = 0;

    const onDown = (event) => {
        if (event.pointerType !== 'mouse' || event.button !== 0) return;
        down = true;
        moved = false;
        startX = event.clientX;
        startScroll = track.scrollLeft;
    };

    const onMove = (event) => {
        if (!down) return;
        const delta = event.clientX - startX;

        if (!moved && Math.abs(delta) > 5) {
            moved = true;
            track.classList.add('is-dragging');
        }

        if (moved) {
            event.preventDefault();
            track.scrollLeft = startScroll - delta;
        }
    };

    const onUp = () => {
        if (!down) return;
        down = false;
        track.classList.remove('is-dragging');
    };

    const onClick = (event) => {
        if (moved) {
            event.preventDefault();
            event.stopPropagation();
            moved = false;
        }
    };

    // Native image/link dragging would hijack the gesture.
    const onDragStart = (event) => event.preventDefault();

    track.addEventListener('pointerdown', onDown);
    window.addEventListener('pointermove', onMove);
    window.addEventListener('pointerup', onUp);
    track.addEventListener('click', onClick, true);
    track.addEventListener('dragstart', onDragStart);

    return () => {
        track.removeEventListener('pointerdown', onDown);
        window.removeEventListener('pointermove', onMove);
        window.removeEventListener('pointerup', onUp);
        track.removeEventListener('click', onClick, true);
        track.removeEventListener('dragstart', onDragStart);
    };
}

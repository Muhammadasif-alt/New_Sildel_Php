import { elementProgress, onScrollFrame } from '../lib/scroll-progress';
import { prefersReducedMotion } from '../lib/motion';

/** Statement text: words light up one by one as the paragraph scrolls through the viewport. */
export default function initScrub(paragraphs) {
    paragraphs.forEach((paragraph) => {
        const words = [...paragraph.querySelectorAll('.scrub-word')];

        if (prefersReducedMotion()) {
            words.forEach((word) => word.classList.add('is-lit'));
            return;
        }

        let lit = -1;

        onScrollFrame(() => {
            const count = Math.floor(elementProgress(paragraph) * words.length);
            if (count === lit) return;
            lit = count;
            words.forEach((word, index) => word.classList.toggle('is-lit', index < count));
        });
    });
}

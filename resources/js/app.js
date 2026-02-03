import './bootstrap';
import { initGlobe } from './globe';

// Initialize globe when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('globe-canvas');
    if (canvas) {
        initGlobe(canvas);
    }
});

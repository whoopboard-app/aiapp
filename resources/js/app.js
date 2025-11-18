import './bootstrap';
import Alpine from 'alpinejs';
import 'preline/preline';

// Initialize Alpine
window.Alpine = Alpine;
Alpine.start();

// Initialize Preline after page load
document.addEventListener('DOMContentLoaded', () => {
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
});

// Reinitialize Preline after Livewire navigation (for SPAs)
document.addEventListener('livewire:navigated', () => {
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
});

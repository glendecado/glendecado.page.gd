// Wait until full page (including images and scripts) is loaded
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    loader.classList.add('hidden');
    // Optional: remove from DOM after fade-out
    setTimeout(() => loader.remove(), 500);
});
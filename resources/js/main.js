window.$ = require('jquery');

(function () {
    var key = 'tts-theme';
    var root = document.documentElement;

    function updateThemeIcons(theme) {
        document.querySelectorAll('#theme-icon').forEach(function (icon) {
            icon.className = theme === 'dark' ? 'bx bx-sun' : 'bx bx-moon';
        });
    }

    function setTheme(theme) {
        root.setAttribute('data-theme', theme);
        root.setAttribute('data-bs-theme', theme);
        localStorage.setItem(key, theme);
        updateThemeIcons(theme);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var current = root.getAttribute('data-theme') || 'light';
        updateThemeIcons(current);

        document.querySelectorAll('#theme-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                setTheme(next);
            });
        });
    });
})();

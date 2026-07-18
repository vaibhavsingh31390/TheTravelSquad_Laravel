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

        document.addEventListener('click', function (event) {
            var toggle = event.target.closest('[data-search-toggle]');
            if (!toggle) {
                return;
            }

            var form = toggle.closest('.archive-search-form');
            if (!form) {
                return;
            }

            event.preventDefault();

            var input = form.querySelector('.archive-search-input');
            var isOpen = form.classList.contains('is-open');

            if (isOpen && input && input.value.trim() !== '') {
                form.submit();
                return;
            }

            isOpen = form.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

            if (isOpen && input) {
                input.focus();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') {
                return;
            }

            document.querySelectorAll('.archive-search-form.is-open').forEach(function (form) {
                if (!form.querySelector('.archive-search-input')?.value) {
                    form.classList.remove('is-open');
                    var toggle = form.querySelector('[data-search-toggle]');
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });
    });
})();

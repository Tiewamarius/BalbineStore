
    document.addEventListener('DOMContentLoaded', () => {

        const tabs = document.querySelectorAll('.sub-menu a');
        const contents = document.querySelectorAll('.tab-content');

        function activateTab(target) {
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

            document.querySelector(`.sub-menu a[data-tab="${target}"]`)?.classList.add('active');
            document.querySelector(`.tab-content[data-tab="${target}"]`)?.classList.add('active');
        }

        // Tab par défaut
        const defaultTab = window.location.hash.replace('#', '') || 'overview';
        activateTab(defaultTab);

        // Click tabs
        tabs.forEach(tab => {
            tab.addEventListener('click', e => {
                e.preventDefault();
                const target = tab.getAttribute('data-tab');
                activateTab(target);
                history.replaceState(null, '', `#${target}`);
            });
        });
    });

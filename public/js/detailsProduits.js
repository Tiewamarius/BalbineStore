document.addEventListener('DOMContentLoaded', () => {

    /* === UTILITY : TOAST === */
    const showToast = (message, duration = 2000) => {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.classList.add('show'), 100);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    };

    /* === MINIATURES === */
    const mainImg = document.querySelector('.main-image');
    const thumbs = document.querySelectorAll('.thumb');
    if (mainImg && thumbs.length) {
        thumbs.forEach(t => {
            t.addEventListener('click', () => {
                mainImg.src = t.src;
                thumbs.forEach(x => x.classList.remove('active'));
                t.classList.add('active');
            });
        });
    }

    /* === VOIR PLUS / VOIR MOINS === */
    const viewBtn = document.querySelector('.view-more-btn');
    const desc = document.querySelector('.product-description p');
    if (viewBtn && desc) {
        viewBtn.addEventListener('click', () => {
            desc.classList.toggle('expanded');
            viewBtn.textContent = desc.classList.contains('expanded') ? 'Voir moins' : 'Voir plus';
        });
    }

    /* === ACCORDÉONS === */
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const isOpen = content.classList.contains('open');
            document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('open'));
            if (!isOpen) content.classList.add('open');
        });
    });

});

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

    /* === PANIER ET CONTROLE DE QUANTITE === */
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const cartCountElem = document.getElementById('cartCount');

    const updateCartBadge = async () => {
        try {
            const res = await fetch('/cart/count');
            if (res.ok) {
                const data = await res.json();
                if (cartCountElem) cartCountElem.textContent = data.count;
            }
        } catch (err) {
            console.error('Erreur mise à jour badge panier:', err);
        }
    };

const initCartButton = (wrapper) => {
    const cartBtn = wrapper.querySelector('.add-to-cart-btn');
    const productId = wrapper.dataset.id;

    const contactBtn = wrapper.querySelector('.contact-advisor-link');
    const voirPanierBtn = wrapper.querySelector('.panier-advisor-link');

const createQuantityControl = (initialQty = 1) => {
    const quantityControl = document.createElement('div');
    quantityControl.className = 'quantity-control';
    quantityControl.innerHTML = `
        <button class="decrease">−</button>
        <span class="quantity">${initialQty}</span>
        <button class="increase">+</button>
    `;
    wrapper.appendChild(quantityControl);
    cartBtn.style.display = 'none';

    // Afficher / masquer boutons correctement
    if(contactBtn) contactBtn.classList.add('hidden');
    if(voirPanierBtn) voirPanierBtn.classList.remove('hidden');

    const qtyDisplay = quantityControl.querySelector('.quantity');
    const decreaseBtn = quantityControl.querySelector('.decrease');
    const increaseBtn = quantityControl.querySelector('.increase');

    increaseBtn.addEventListener('click', async () => {
        let qty = parseInt(qtyDisplay.textContent) + 1;
        qtyDisplay.textContent = qty;
        await fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' },
            body: JSON.stringify({ quantity: qty })
        });
        updateCartBadge();
    });

    decreaseBtn.addEventListener('click', async () => {
        let qty = parseInt(qtyDisplay.textContent);
        if (qty > 1) {
            qty--;
            qtyDisplay.textContent = qty;
            await fetch(`/cart/update/${productId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' },
                body: JSON.stringify({ quantity: qty })
            });
        } else {
            quantityControl.remove();
            cartBtn.style.display = 'inline-block';

            // Restaurer les boutons correctement
            if(contactBtn) contactBtn.classList.remove('hidden');
            if(voirPanierBtn) voirPanierBtn.classList.add('hidden');

            await fetch(`/cart/remove/${productId}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf } });
        }
        updateCartBadge();
    });
};

    cartBtn.addEventListener('click', async () => {
        try {
            const res = await fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' },
                body: JSON.stringify({ quantity: 1 })
            });
            const result = await res.json();
            if (!res.ok || !result.success) return alert(result.message || "Erreur");

            createQuantityControl(1);
            showToast('Produit ajouté au panier !');
            updateCartBadge();

            cartBtn.classList.add('added');
            setTimeout(() => cartBtn.classList.remove('added'), 800);

        } catch (err) {
            console.error(err);
            alert('Erreur réseau');
        }
    });
};


    document.querySelectorAll('.cart-quantity-wrapper').forEach(wrapper => initCartButton(wrapper));

    // Mise à jour initiale du badge
    updateCartBadge();
});

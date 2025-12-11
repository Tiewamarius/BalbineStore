document.addEventListener('DOMContentLoaded', () => {

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const cartCount = document.getElementById('cartCount');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartToggle = document.getElementById('cartToggle');
    const closeCart = document.getElementById('closeCartSidebar');

    // s'assurer que la valeur est une string 'true' ou 'false'
    const isLoggedIn = window.Laravel?.isLoggedIn === 'true';

    /* -------------------------------
       1. BADGE PANIER
    ------------------------------- */
    const updateCartBadge = async () => {
        try {
            const res = await fetch('/cart/count');
            if (!res.ok) return;
            const data = await res.json();
            if (cartCount) cartCount.textContent = data.count;
        } catch (err) {
            console.error("Erreur badge panier", err);
        }
    };

    /* -------------------------------
       2. SIDEBAR PANIER
    ------------------------------- */
    const loadCartSidebar = async () => {
        try {
            const res = await fetch('/cart/sidebar');
            if (!res.ok) return;
            const html = await res.text();
            // replace seulement le contenu de la sidebar
            const body = document.querySelector('#cartSidebar .contact-body');
            if (body) body.innerHTML = html;
        } catch (err) {
            console.error("Erreur chargement sidebar", err);
        }
    };

    /* -------------------------------
       3. OUVERTURE / FERMETURE SIDEBAR
    ------------------------------- */
    cartToggle?.addEventListener('click', async () => {
        cartSidebar.classList.add('active');
        await loadCartSidebar();
    });
    closeCart?.addEventListener('click', () => cartSidebar.classList.remove('active'));

    /* -------------------------------
       4. BOUTON "AJOUTER AU PANIER" SUR PAGE PRODUIT
          + Création du contrôle quantité (ne change pas tes classes)
    ------------------------------- */
    const initCartButton = (wrapper) => {
        const cartBtn = wrapper.querySelector('.add-to-cart-btn');
        const productId = wrapper.dataset.id;

        if (!cartBtn) return;

        cartBtn.addEventListener('click', async () => {
            try {
                const res = await fetch(`/cart/add/${productId}`, {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
                    body: JSON.stringify({ quantity: 1 })
                });
                if (!res.ok) return;
                const data = await res.json();
                if (!data.success) return;

                // Remplacer le bouton par le contrôle quantité (garder classes)
                const quantityControl = document.createElement('div');
                quantityControl.className = 'quantity-control';
                quantityControl.innerHTML = `
                    <button class="qty-btn decrease" data-id="${productId}">−</button>
                    <span class="quantity">1</span>
                    <button class="qty-btn increase" data-id="${productId}">+</button>
                `;
                // vider wrapper et inserer control
                wrapper.innerHTML = '';
                wrapper.appendChild(quantityControl);

                await updateCartBadge();
                await loadCartSidebar();
            } catch (err) {
                console.error('Erreur ajout produit', err);
            }
        });
    };
    document.querySelectorAll('.cart-quantity-wrapper').forEach(initCartButton);

    /* -------------------------------
       5. INCREMENT / DECREMENT (sidebar et produits)
       - on vérifie data.success côté serveur
       - on gère correctement quantity undefined/null
    ------------------------------- */
    document.addEventListener('click', async (e) => {
        // prend bouton increase/decrease (avec classe qty-btn)
        const btn = e.target.closest('.qty-btn.increase, .qty-btn.decrease');
        if (!btn) return;

        const productId = btn.dataset.id;
        // choisir l'url selon le role connecté
        let url = '';
        if (btn.classList.contains('increase')) {
            url = isLoggedIn ? '/cart/increase' : '/cart/session/increase';
        } else {
            url = isLoggedIn ? '/cart/decrease' : '/cart/session/decrease';
        }

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' },
                body: JSON.stringify({ product_id: productId })
            });

            if (!res.ok) {
                console.error('Réponse non OK', res.status);
                return;
            }

            const data = await res.json();

            // Si serveur indique échec, juste afficher un console + ne pas casser l'UI
            if (data.success === false) {
                console.warn('Endpoint a retourné success=false', data.message || data);
                // recharger le sidebar pour rester synchro mais ne supprime pas le contrôle en page produit
                await loadCartSidebar();
                await updateCartBadge();
                return;
            }

            // Normal case: data.quantity present (number) or 0
            const qtySpan = btn.parentElement?.querySelector('.quantity');

            if (typeof data.quantity === 'number' && data.quantity > 0) {
                if (qtySpan) qtySpan.textContent = data.quantity;
            } else {
                // quantity = 0 ou undefined => on supprime le control côté produit si présent
                const wrapper = btn.closest('.cart-quantity-wrapper');
                if (wrapper) {
                    wrapper.innerHTML = `<button class="add-to-cart-btn">Ajouter au panier</button>`;
                    initCartButton(wrapper); // réattache listener
                }
                // supprime l'élément du sidebar si présent
                if (btn.closest('#cartSidebar')) {
    const cartItem = btn.closest('.cart-item');
    cartItem?.remove();
}
            }

            // mettre à jour badge et sidebar pour garantir synchro
            await updateCartBadge();
            await loadCartSidebar();
        } catch (err) {
            console.error(`Erreur qty pour le produit ${productId}`, err);
        }
    });

    /* -------------------------------
       6. INITIALISATION DU BADGE
    ------------------------------- */
    updateCartBadge();
});

document.addEventListener('DOMContentLoaded', () => {

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const cartCount = document.getElementById('cartCount');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartToggle = document.getElementById('cartToggle');
    const closeCart = document.getElementById('closeCartSidebar');

    /* ---------------------------------------
        1. BADGE PANIER
    --------------------------------------- */
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


    /* ---------------------------------------
        2. PAGE PRODUIT — bouton + quantité
    --------------------------------------- */
    const initCartButton = (wrapper) => {

        const cartBtn = wrapper.querySelector('.add-to-cart-btn');
        const productId = wrapper.dataset.id;
        const contactBtn = wrapper.querySelector('.contact-advisor-link');
        const voirPanierBtn = wrapper.querySelector('.panier-advisor-link');

        const createQuantityControl = (qty = 1) => {

            const quantityControl = document.createElement('div');
            quantityControl.className = 'quantity-control';
            quantityControl.innerHTML = `
                <button class="decrease">−</button>
                <span class="quantity">${qty}</span>
                <button class="increase">+</button>
            `;
            wrapper.appendChild(quantityControl);
            cartBtn.style.display = 'none';

            if(contactBtn) contactBtn.classList.add('hidden');
            if(voirPanierBtn) voirPanierBtn.classList.remove('hidden');

            const qtyDisplay = quantityControl.querySelector('.quantity');

            quantityControl.querySelector('.increase').addEventListener('click', async () => {
                let q = parseInt(qtyDisplay.textContent) + 1;
                qtyDisplay.textContent = q;

                await fetch(`/cart/update/${productId}`, {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
                    body: JSON.stringify({ quantity: q })
                });

                updateCartBadge();
            });

            quantityControl.querySelector('.decrease').addEventListener('click', async () => {
                let q = parseInt(qtyDisplay.textContent);
                if (q > 1) {
                    q--;
                    qtyDisplay.textContent = q;
                    await fetch(`/cart/update/${productId}`, {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
                        body: JSON.stringify({ quantity: q })
                    });
                } else {
                    quantityControl.remove();
                    cartBtn.style.display = 'inline-block';

                    if(contactBtn) contactBtn.classList.remove('hidden');
                    if(voirPanierBtn) voirPanierBtn.classList.add('hidden');

                    await fetch(`/cart/remove/${productId}`, {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": csrf },
                    });
                }

                updateCartBadge();
            });
        };

        cartBtn.addEventListener('click', async () => {
            const res = await fetch(`/cart/add/${productId}`, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
                body: JSON.stringify({ quantity: 1 })
            });

            const data = await res.json();
            if (!data.success) return;

            createQuantityControl(1);
            updateCartBadge();
        });
    };

    document.querySelectorAll('.cart-quantity-wrapper').forEach(initCartButton);



    /* ---------------------------------------
        3. SIDEBAR PANIER
    --------------------------------------- */
    if (cartToggle) {
        cartToggle.addEventListener('click', () => cartSidebar.classList.add('active'));
    }

    if (closeCart) {
        closeCart.addEventListener('click', () => cartSidebar.classList.remove('active'));
    }


    /* ---------------------------------------
        4. AJOUT SIMPLE AU PANIER (cards produits)
    --------------------------------------- */
    document.addEventListener('click', async e => {
        if (e.target.classList.contains('add-to-cart')) {

            const id = e.target.dataset.id;

            const res = await fetch(`/cart/add/${id}`, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf }
            });

            const data = await res.json();
            if (data.success) updateCartBadge();
        }
    });


    /* ---------------------------------------
        5. BOUTONS + ET – DANS LE SIDEBAR
    --------------------------------------- */
    document.addEventListener('click', async e => {

        // Increase
        if (e.target.classList.contains('increase')) {
            const id = e.target.dataset.id;
            const qtySpan = e.target.parentElement.querySelector('.quantity');

            const res = await fetch(`/cart/increase`, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
                body: JSON.stringify({ product_id: id })
            });

            const data = await res.json();
            qtySpan.textContent = data.quantity;
            cartCount.textContent = data.cart_total;
        }

        // Decrease
        if (e.target.classList.contains('decrease')) {
            const id = e.target.dataset.id;
            const qtySpan = e.target.parentElement.querySelector('.quantity');

            const res = await fetch(`/cart/decrease`, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
                body: JSON.stringify({ product_id: id })
            });

            const data = await res.json();
            qtySpan.textContent = data.quantity;
            cartCount.textContent = data.cart_total;
        }

    });


    /* ---------------------------------------
        6. INITIALISATION DU BADGE
    --------------------------------------- */
    updateCartBadge();

});

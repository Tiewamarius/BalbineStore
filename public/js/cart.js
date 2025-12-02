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
                <button class="decrease" data-id="${productId}">−</button>
                <span class="quantity">${qty}</span>
                <button class="increase" data-id="${productId}">+</button>
            `;
            wrapper.appendChild(quantityControl);
            cartBtn.style.display = 'none';

            if (contactBtn) contactBtn.classList.add('hidden');
            if (voirPanierBtn) voirPanierBtn.classList.remove('hidden');

            const qtyDisplay = quantityControl.querySelector('.quantity');

            // Increase
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

            // Decrease
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

                    if (contactBtn) contactBtn.classList.remove('hidden');
                    if (voirPanierBtn) voirPanierBtn.classList.add('hidden');

                    await fetch(`/cart/remove/${productId}`, {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": csrf }
                    });
                }

                updateCartBadge();
            });
        };

        // Ajouter au panier
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
        3. OUVERTURE / FERMETURE SIDEBAR
    --------------------------------------- */
    if (cartToggle) cartToggle.addEventListener('click', () => cartSidebar.classList.add('active'));
    if (closeCart) closeCart.addEventListener('click', () => cartSidebar.classList.remove('active'));



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
        if (data.success) {
            updateCartBadge();

            // Met à jour le sidebar dynamiquement
            let cartBody = document.querySelector('#cartSidebar .cart-items');
            if (!cartBody) {
                // Crée la div si panier vide
                cartBody = document.createElement('div');
                cartBody.className = 'cart-items';
                document.querySelector('#cartSidebar .contact-body').innerHTML = '';
                document.querySelector('#cartSidebar .contact-body').appendChild(cartBody);
            }

            // Vérifie si le produit est déjà dans le sidebar
            let item = cartBody.querySelector(`.cart-item[data-id="${id}"]`);
            if (item) {
                let qty = item.querySelector('.quantity');
                qty.textContent = parseInt(qty.textContent) + 1;
            } else {
                // Ajoute le produit au sidebar
                let productName = e.target.dataset.name;
                let productPrice = e.target.dataset.price;
                let productImage = e.target.dataset.image;

                const html = `
                <div class="cart-item" data-id="${id}">
                    <img src="${productImage}" class="cart-item-img" alt="${productName}">
                    <div class="cart-item-info">
                        <h4 class="cart-item-name">${productName}</h4>
                        <p class="cart-item-price">${productPrice} XOF</p>
                        <div class="cart-item-qty">
                            <button class="qty-btn decrease" data-id="${id}">−</button>
                            <span class="quantity">1</span>
                            <button class="qty-btn increase" data-id="${id}">+</button>
                        </div>
                    </div>
                </div>`;
                cartBody.insertAdjacentHTML('beforeend', html);
            }
        }
    }
});




    /* ---------------------------------------
        5. BOUTONS + ET – DANS LE SIDEBAR
    --------------------------------------- */
    document.addEventListener('click', async e => {

        // Increase
        if (e.target.classList.contains('increase') && e.target.dataset.id) {

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
        if (e.target.classList.contains('decrease') && e.target.dataset.id) {

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


document.addEventListener('click', async e => {

    if (e.target.classList.contains('increase') && e.target.dataset.id) {
        const id = e.target.dataset.id;
        const qtySpan = e.target.parentElement.querySelector('.quantity');

        const url = window.Laravel.isLoggedIn ? '/cart/increase' : '/cart/session/increase';

        const res = await fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ product_id: id })
        });
        const data = await res.json();
        qtySpan.textContent = data.quantity;
        cartCount.textContent = data.cart_total;
    }

    if (e.target.classList.contains('decrease') && e.target.dataset.id) {
        const id = e.target.dataset.id;
        const qtySpan = e.target.parentElement.querySelector('.quantity');

        const url = window.Laravel.isLoggedIn ? '/cart/decrease' : '/cart/session/decrease';

        const res = await fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ product_id: id })
        });
        const data = await res.json();
        qtySpan.textContent = data.quantity;
        cartCount.textContent = data.cart_total;

        if (data.quantity === 0) {
            // Supprime la div du sidebar si qty = 0
            e.target.closest('.cart-item').remove();
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const cartCount = document.getElementById('cartCount');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartToggle = document.getElementById('cartToggle');
    const closeCart = document.getElementById('closeCartSidebar');

    const updateCartBadge = async () => {
        const res = await fetch('/cart/count');
        if (!res.ok) return;
        const data = await res.json();
        cartCount && (cartCount.textContent = data.count);
    };

    // Sidebar toggle
    cartToggle && cartToggle.addEventListener('click', () => cartSidebar.classList.add('active'));
    closeCart && closeCart.addEventListener('click', () => cartSidebar.classList.remove('active'));

    // Ajout au panier
    document.addEventListener('click', async e => {
        if (!e.target.dataset.id) return;

        let id = e.target.dataset.id;
        let action = '';
        if (e.target.classList.contains('add-to-cart')) action = 'add';
        else if (e.target.classList.contains('increase')) action = 'increase';
        else if (e.target.classList.contains('decrease')) action = 'decrease';
        else return;

        let url = '';
        let delta = 0;
        if (action === 'add') url = `/cart/add/${id}`;
        if (action === 'increase' || action === 'decrease') {
            const auth = window.Laravel.isLoggedIn;
            url = auth ? `/cart/${action}` : `/cart/session/${action}`;
        }

        const res = await fetch(url, {
            method: "POST",
            headers: { "X-CSRF-TOKEN": csrf, "Content-Type": "application/json" },
            body: JSON.stringify({ product_id: id })
        });
        const data = await res.json();

        // Update badge
        updateCartBadge();

        // Update sidebar qty
        const qtySpan = e.target.closest('.cart-item')?.querySelector('.quantity');
        if (qtySpan) qtySpan.textContent = data.quantity;
        if (data.quantity === 0) e.target.closest('.cart-item')?.remove();
    });

    updateCartBadge();
});

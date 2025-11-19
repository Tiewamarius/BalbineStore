document.addEventListener('DOMContentLoaded', () => {

    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartToggle = document.getElementById('cartToggle');
    const closeCart = document.getElementById('closeCartSidebar');
    const cartCount = document.getElementById('cartCount');

    /* ------------------------------
        1. OUVERTURE / FERMETURE
    ------------------------------ */
    if (cartToggle) {
        cartToggle.addEventListener('click', () => {
            cartSidebar.classList.add('active');
        });
    }

    if (closeCart) {
        closeCart.addEventListener('click', () => {
            cartSidebar.classList.remove('active');
        });
    }


    /* ---------------------------------------
        2. AJOUTER AU PANIER (add-to-cart)
    --------------------------------------- */
    document.addEventListener('click', async e => {
        if (e.target.classList.contains('add-to-cart')) {

            const id = e.target.dataset.id;

            const res = await fetch(`/cart/add/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                }
            });

            const data = await res.json();

            if (data.success && cartCount) {
                cartCount.textContent = data.count;
            }
        }
    });


    /* ---------------------------------------
        3. AUGMENTER LA QUANTITÉ (+)
    --------------------------------------- */
    document.addEventListener('click', async e => {
        if (e.target.classList.contains('increase')) {

            const productId = e.target.dataset.id;
            const qtySpan = e.target.parentElement.querySelector(".quantity");

            const res = await fetch(`/cart/increase`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf
                },
                body: JSON.stringify({ product_id: productId })
            });

            const data = await res.json();

            qtySpan.textContent = data.quantity;
            cartCount.textContent = data.cart_total;
        }
    });


    /* ---------------------------------------
        4. DIMINUER LA QUANTITÉ (–)
    --------------------------------------- */
    document.addEventListener('click', async e => {
        if (e.target.classList.contains('decrease')) {

            const productId = e.target.dataset.id;
            const qtySpan = e.target.parentElement.querySelector(".quantity");

            const res = await fetch(`/cart/decrease`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf
                },
                body: JSON.stringify({ product_id: productId })
            });

            const data = await res.json();

            qtySpan.textContent = data.quantity;
            cartCount.textContent = data.cart_total;
        }
    });

});

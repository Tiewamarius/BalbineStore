document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const cartToggle = document.getElementById('cartToggle');
    const cartSidebar = document.getElementById('cartSidebar');
    const closeCart = document.getElementById('closeCartSidebar');
    const clearCart = document.getElementById('clearCart');
    const cartCount = document.getElementById('cartCount');

    /* ------------------------------
       🧩 1. OUVRIR / FERMER le panier
    ------------------------------ */
    if (cartToggle && cartSidebar) {
        cartToggle.addEventListener('click', () => {
            cartSidebar.classList.add('active');
        });

        if (closeCart) {
            closeCart.addEventListener('click', () => {
                cartSidebar.classList.remove('active');
            });
        }
    }

    /* ------------------------------
       🛒 2. AJOUTER un article au panier
    ------------------------------ */
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', async e => {
            e.preventDefault();
            const id = btn.dataset.id;

            const res = await fetch(`/cart/add/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json',
                },
            });

            const data = await res.json();
            if (data.success) {
                // Met à jour le compteur panier
                if (cartCount) cartCount.textContent = data.count;
                alert('Produit ajouté au panier ✅');
            } else {
                alert('Une erreur est survenue ❌');
            }
        });
    });

    /* ------------------------------
       ❌ 3. SUPPRIMER un article du panier
    ------------------------------ */
    document.addEventListener('click', async e => {
        if (e.target.classList.contains('remove-item')) {
            const id = e.target.dataset.id;

            const res = await fetch(`/cart/remove/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json',
                },
            });

            const data = await res.json();
            if (data.success) {
                e.target.closest('li').remove();
                if (cartCount) cartCount.textContent = data.count;
            }
        }
    });

    /* ------------------------------
       🔄 4. METTRE À JOUR la quantité
    ------------------------------ */
    document.addEventListener('change', async e => {
        if (e.target.classList.contains('cart-qty')) {
            const id = e.target.closest('.cart-item').dataset.id;
            const quantity = e.target.value;

            const res = await fetch(`/cart/update`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, quantity }),
            });

            const data = await res.json();
            if (data.success && cartCount) {
                cartCount.textContent = data.count;
            }
        }
    });

    /* ------------------------------
       🧹 5. VIDER le panier
    ------------------------------ */
    if (clearCart) {
        clearCart.addEventListener('click', async () => {
            const res = await fetch(`/cart/clear`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
            });

            const data = await res.json();
            if (data.success) {
                const list = document.querySelector('.cart-items');
                if (list) list.innerHTML = '';
                if (cartCount) cartCount.textContent = '0';
            }
        });
    }
});

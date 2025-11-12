document.addEventListener('DOMContentLoaded', () => {

    /* === 1. MINIATURES === */
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

    /* === 2. VOIR PLUS / VOIR MOINS === */
    const viewBtn = document.querySelector('.view-more-btn');
    const desc = document.querySelector('.product-description p');
    if (viewBtn && desc) {
        viewBtn.addEventListener('click', () => {
            desc.classList.toggle('expanded');
            viewBtn.textContent = desc.classList.contains('expanded') ? 'Voir moins' : 'Voir plus';
        });
    }

    /* === 3. ACCORDÉONS === */
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const isOpen = content.classList.contains('open');
            document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('open'));
            if (!isOpen) content.classList.add('open');
        });
    });

    /* === 4. PANIER (AJAX + CONTRÔLE QUANTITÉ) === */
    const cartBtn = document.querySelector('.add-to-cart-btn');
    const cartCount = document.getElementById('cartCount');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // 🧩 Fonction utilitaire : mise à jour du badge panier
    const updateCartBadge = async () => {
        try {
            const res = await fetch('/cart/count');
            if (res.ok) {
                const data = await res.json();
                if (cartCount) cartCount.textContent = data.count;
            }
        } catch (err) {
            console.error('Erreur de mise à jour du badge panier:', err);
        }
    };

    // 🧩 Fonction AJAX pour mise à jour du panier
    const updateCart = async (url, body = null) => {
        return await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Content-Type': 'application/json'
            },
            body: body ? JSON.stringify(body) : null
        });
    };

    // === 4.1 Bouton “Ajouter au panier” ===
    if (cartBtn) {
        cartBtn.addEventListener('click', async e => {
            const id = e.target.dataset.id;

            try {
                const response = await updateCart(`/cart/add/${id}`, { quantity: 1 });

                if (!response.ok) {
                    alert("Erreur lors de l'ajout au panier");
                    return;
                }

                // ✅ Masquer le bouton et créer le contrôle quantité
                cartBtn.style.display = 'none';
                const quantityControl = document.createElement('div');
                quantityControl.className = 'quantity-control';
                quantityControl.innerHTML = `
                    <button class="decrease">−</button>
                    <span class="quantity">1</span>
                    <button class="increase">+</button>
                `;
                cartBtn.parentNode.insertBefore(quantityControl, cartBtn.nextSibling);

                const qtyDisplay = quantityControl.querySelector('.quantity');
                const decreaseBtn = quantityControl.querySelector('.decrease');
                const increaseBtn = quantityControl.querySelector('.increase');

                // 🔄 Mise à jour du badge
                updateCartBadge();

                // ➕ Incrémenter
                increaseBtn.addEventListener('click', async () => {
                    let qty = parseInt(qtyDisplay.textContent) + 1;
                    qtyDisplay.textContent = qty;
                    await updateCart(`/cart/update/${id}`, { quantity: qty });
                    updateCartBadge();
                });

                // ➖ Décrémenter
                decreaseBtn.addEventListener('click', async () => {
                    let qty = parseInt(qtyDisplay.textContent);
                    if (qty > 1) {
                        qty--;
                        qtyDisplay.textContent = qty;
                        await updateCart(`/cart/update/${id}`, { quantity: qty });
                        updateCartBadge();
                    } else {
                        // Supprimer du panier
                        quantityControl.remove();
                        cartBtn.style.display = 'inline-block';
                        await updateCart(`/cart/remove/${id}`);
                        updateCartBadge();
                    }
                });

            } catch (err) {
                console.error(err);
                alert('Erreur réseau');
            }
        });
    }
});

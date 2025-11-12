 document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-input-lg');
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');

    // 1. Mettre le focus sur le champ de recherche au chargement de la page
    // Cela rend l'expérience utilisateur immédiate : l'utilisateur peut taper directement.
    if (searchInput) {
        setTimeout(() => {
            searchInput.focus();
        }, 100); 
    }

    // 2. Gestion des favoris (Wishlist)
    wishlistButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            
            // Simuler l'ajout/retrait du produit des favoris
            const productCard = button.closest('.product-card');
            const productName = productCard.querySelector('.product-name').textContent;

            button.classList.toggle('is-favorited');

            if (button.classList.contains('is-favorited')) {
                console.log(`${productName} a été ajouté aux favoris.`);
                // Changer l'icône ou la couleur si l'état "favoris" est actif
                button.style.opacity = 1;
                button.querySelector('svg').style.fill = '#4bcef3'; // Rendre le cœur rouge
            } else {
                console.log(`${productName} a été retiré des favoris.`);
                // Rétablir l'icône/couleur par défaut
                button.style.opacity = 0.8;
                button.querySelector('svg').style.fill = '#000000';
            }
        });
    });
});
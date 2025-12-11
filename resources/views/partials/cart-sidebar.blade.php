<!-- Définir si l'utilisateur est connecté pour le JS -->
<script>
    window.Laravel = {
        isLoggedIn: "{{ auth()->check() ? 'true' : 'false' }}"
    };
</script>

<!-- Modale Wishlist -->
<aside class="contact-sidebar login-sidebar" id="wishlistSidebar">
    <header class="contact-header">
        <h2 class="contact-title">Ma Liste de Souhaits</h2>
        <button id="closeWishlistSidebar" class="close-btn" aria-label="Fermer la wishlist">&times;</button>
    </header>

    <div class="contact-body">
        @include('partials.wishlist-sidebar-items')
    </div>
</aside>

<!-- Modale Panier -->
<aside class="contact-sidebar cart-sidebar" id="cartSidebar">
    <header class="contact-header">
        <h2 class="contact-title">Mon Panier</h2>
        <button id="closeCartSidebar" class="close-btn" aria-label="Fermer le panier">&times;</button>
    </header>

    <div class="contact-body">
        @include('partials.cart-sidebar-items')
    </div>
</aside>
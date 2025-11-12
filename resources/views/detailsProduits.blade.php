<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Produit - BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="css/detailsProduits.css">
    <script src="js/detailsProduits.js" defer></script>
</head>

<body class="modal-closed">


    <section class="product-detail-section">
        <div class="product-images">
            <img src="{{ asset('images/repulsif_serpents_concentre.jpg') }}" alt="Pantalon technique convertible" class="main-image">
            <img src="{{ asset('images/repulsif_serpents_concentre.jpg') }}" alt="Détail du T-shirt" class="detail-image">
        </div>
        <div class="product-info">
            <p class="product-status">Nouveau</p>
            <h1 class="product-name">Produit phytotop blabalal</h1>
            <p class="product-price">1 500,00 XOF</p>

            <div class="size-selection-container">
                <label for="size-select" class="size-label">Sélectionnez nombre</label>
                <select id="size-select" class="size-select">
                    <option value="" disabled selected>Nombre</option>
                    <option value="S">1</option>
                    <option value="M">2</option>
                    <option value="L">3</option>
                    <option value="XL">4</option>
                </select>
                <a href="#" class="size-guide-link">Correspondances de taille</a>
            </div>

            <button class="add-to-cart-btn" data-id="{{ $product->id }}">Ajouter au panier</button>
            <a href=" #" class="contact-advisor-link" id="contactAdvisorLink">Contacter un conseiller</a>

            <div class="product-description">
                <p>
                    Parfait en toutes circonstances, ce pantalon technique convertible 2-en-1 en ripstop léger se glisse aisément dans un sac. Des fermetures éclair discrètes permettent de retirer les bas de jambes pour le transformer en short.
                </p>
                <button class="view-more-btn">Voir plus</button>
            </div>

            <div class="product-features">
                <button class="feature-toggle">Caractéristiques environnementales</button>
            </div>
        </div>
    </section>

    <section class="product-selection-section">
        <h2 class="section-title">Explorez les produits d'entretient de vos espaces</h2>

        <div class="product-grid">
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/repulsif_serpents_concentre.jpg') }}" alt="Collection Monogram Personnalisation" class="product-image">
                </div>
                <p class="product-label">Viper repulsif</p>
            </div>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/Solipropre-ultra-degraissant-Ecolabel-750ml-bleu-500x668.jpg') }}" alt="Sacs Femme Louis Vuitton" class="product-image">
                </div>
                <p class="product-label">Javel liquide</p>
            </div>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/gants-600x574.png') }}" alt="Bijoux Fantaisie Femme" class="product-image">
                </div>
                <p class="product-label">Gants</p>
            </div>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/Pulverisateurs.jpg') }}" alt="Produits de La Beauté Louis Vuitton" class="product-image">
                </div>
                <p class="product-label">Pulverisateurs</p>
            </div>
        </div>
    </section>
    <section class="pubmarketing-section">
        <img src="{{ asset('images/BALBINE-STORE-1--1536x768.jpg') }}" alt="Promotion spéciale" class="pub-image">
    </section>

</body>

</html>
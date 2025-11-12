<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALBINE STORE - Recherche</title>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <script src="js/search.js" defer></script>
</head>

<body>

    <div class="search-page-container" id="searchPage">
        <div class="search-container">
            <header class="search-header">
                <a href="{{ url('/') }}">
                    <div class="hero-center">
                        <h1 class="logo">BALBINE STORE</h1>
                    </div>
                </a>
            </header>

            <div class="search-content">
                <div class="search-input-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#4a4a4a">
                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg>
                    <input type="text" placeholder="Rechercher des articles, des prix..." class="search-input-lg">
                </div>

                <div class="popular-searches">
                    <h3>RECHERCHES POPULAIRES</h3>
                    <div class="tags">
                        <a href="#">Javel Liquide</a>
                        <a href="#">Calivoir</a>
                        <a href="#">Promaster</a>
                        <a href="#">Parfumage</a>
                        <a href="#">Senter</a>
                        <a href="#">Brosse</a>
                    </div>
                </div>

                <div class="inspirations-section">
                    <h2>Recherche Avancée</h2>
                    <div class="product-grid">

                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <img src="images/desinfectant-virucide-500x667.jpg" alt="Sac Side Trunk MM">
                                <span class="custom-badge">Personnalisable</span>
                            </div>
                            <div class="product-info">
                                <p class="product-name">Sac Side Trunk MM</p>
                                <p class="product-price">3 200,00 XOF</p>
                            </div>
                            <button class="wishlist-btn" aria-label="Ajouter aux favoris">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                                </svg>
                            </button>
                        </div>

                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <img src="images/desinfectant-virucide-500x667.jpg" alt="Écharpe Reykjavík 2.0">
                                <span class="custom-badge">Précommande en ligne</span>
                            </div>
                            <div class="product-info">
                                <p class="product-name">Écharpe Reykjavík 2.0</p>
                                <p class="product-price">880,00 XOF</p>
                            </div>
                            <button class="wishlist-btn" aria-label="Ajouter aux favoris">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="inspirations-section">
                    <h2>Recherche Avancée</h2>
                    <div class="product-grid">
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
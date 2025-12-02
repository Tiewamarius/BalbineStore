/***************************************************
 *  BARRE DE RECHERCHE DYNAMIQUE (LIVE SEARCH)
 ***************************************************/
document.addEventListener("DOMContentLoaded", function () {

    const input          = document.querySelector(".search-input-lg");
    const resultsContainer = document.getElementById("search-results");
    const randomGrid     = document.querySelector(".product-grid");

    let timer = null;

    input.addEventListener("keyup", function () {
        const query = input.value.trim();

        clearTimeout(timer);

        timer = setTimeout(() => {

            // 🔹 Moins de 2 caractères → reset
            if (query.length < 2) {
                resultsContainer.style.display = "none";
                randomGrid.style.display = "grid";
                resultsContainer.innerHTML = "";
                return;
            }

            // 🔹 Requête AJAX
            fetch(`/search-products?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(products => {

                    resultsContainer.innerHTML = "";

                    // Aucun résultat
                    if (products.length === 0) {
                        resultsContainer.innerHTML = `
                            <p style="grid-column:1/-1; text-align:center">
                                Aucun produit trouvé
                            </p>`;
                    } else {

                        // Affichage produits trouvés
                        products.forEach(p => {
                            resultsContainer.innerHTML += `
                                <a href="/detailsProduct/${p.id}">
                                    <div class="product-card">
                                        
                                        <div class="product-image-wrapper">
                                            <img src="/storage/${p.image}" alt="${p.name}">
                                        </div>

                                        <div class="product-info">
                                            <p class="product-name">${p.name}</p>
                                            <p class="product-price">${p.price} XOF</p>
                                        </div>

                                    </div>
                                </a>
                            `;
                        });
                    }

                    // Toggle affichage
                    randomGrid.style.display = "none";
                    resultsContainer.style.display = "grid";
                });

        }, 300); // Anti-spam
    });
});


/***************************************************
 *  BARRE DE RECHERCHE STICKY AU SCROLL
 ***************************************************/
document.addEventListener("scroll", () => {
    const bar = document.querySelector(".sticky-search");

    if (!bar) return;

    if (window.scrollY > 50) {
        bar.classList.add("is-sticky");
    } else {
        bar.classList.remove("is-sticky");
    }
});

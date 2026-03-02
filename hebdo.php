<?php
// hebdo.php - Page Menu Hebdomadaire
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hebdo</title>
    <link rel="stylesheet" href="hebdo.css">
</head>
<body>
    <div class="dropdown">
        <button class="dropdown-btn">Menu Principal ▼</button>
        <div class="dropdown-content">
            <a href="index.php">Accueil</a>
            <div class="dropdown-item">
                <a href="#Menu">Menu ➤</a>
                <div class="submenu">
                    <a href="hebdo.php">Hebdo</a>
                </div>
            </div>
            <a href="reservation.php">Réservation</a>
            <a href="cartefidelite.php">Carte Fidélité</a>
            <a href="repasnoel.php">Repas De Noël</a>
            <a href="#" onclick="deconnexion()">Déconnexion</a>
        </div>
    </div>

    <div class="content">
        <h1>Menu Hebdomadaire</h1>
        <div class="meals-container">
            <!-- Repas 1 -->
            <div class="meal-card">
                <h2>Repas 1 <span class="meal-type standard">Standard</span></h2>
                
                <div class="meal-item">
                    <h3>🍽️ Entrée</h3>
                    <p>Salade verte aux tomates cerises et vinaigrette</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍖 Plat Standard</h3>
                    <p>Steak haché, frites et haricots verts</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍰 Dessert</h3>
                    <p>Tarte aux pommes</p>
                </div>
                
                <div class="meal-item">
                    <h3>🧀 Fromage / Yaourt</h3>
                    <p>Fromage blanc ou Yaourt nature</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍞 Pain</h3>
                    <p>Pain de campagne</p>
                </div>
            </div>

            <!-- Repas 2 -->
            <div class="meal-card">
                <h2>Repas 2 <span class="meal-type vegetarien">Végétarien</span></h2>
                
                <div class="meal-item">
                    <h3>🍽️ Entrée</h3>
                    <p>Velouté de légumes du jour</p>
                </div>
                
                <div class="meal-item">
                    <h3>🥗 Plat Végétarien</h3>
                    <p>Lasagnes aux légumes et fromage</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍰 Dessert</h3>
                    <p>Compote de fruits</p>
                </div>
                
                <div class="meal-item">
                    <h3>🧀 Fromage / Yaourt</h3>
                    <p>Yaourt aux fruits ou Fromage de chèvre</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍞 Pain</h3>
                    <p>Pain complet</p>
                </div>
            </div>

            <!-- Repas 3 -->
            <div class="meal-card">
                <h2>Repas 3 <span class="meal-type sans-porc">Sans Porc</span></h2>
                
                <div class="meal-item">
                    <h3>🍽️ Entrée</h3>
                    <p>Carottes râpées à la vinaigrette</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍗 Plat Sans Porc</h3>
                    <p>Poulet rôti, riz et ratatouille</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍰 Dessert</h3>
                    <p>Flan vanille</p>
                </div>
                
                <div class="meal-item">
                    <h3>🧀 Fromage / Yaourt</h3>
                    <p>Fromage de brebis ou Yaourt grec</p>
                </div>
                
                <div class="meal-item">
                    <h3>🍞 Pain</h3>
                    <p>Pain blanc</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdown = document.querySelector('.dropdown');

        dropdownBtn.addEventListener('click', function() {
            dropdown.classList.toggle('active');
        });

        // Fermer le menu en cliquant ailleurs
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Vérifier si l'utilisateur est connecté
        if (sessionStorage.getItem('loggedIn') !== 'true') {
            window.location.href = 'login.html';
        }

        // Fonction de déconnexion
        function deconnexion() {
            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('username');
            sessionStorage.removeItem('role');
            window.location.href = 'login.html';
        }
    </script>
</body>
</html>


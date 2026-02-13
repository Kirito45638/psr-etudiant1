<?php
// repasnoel.php - Page Repas de Noël
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repas de Noël - Restaurant PSR EREA</title>
    <link rel="stylesheet" href="repasnoel.css">
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

    <div class="container">
        <h1>🎄 Repas de Noël 🎄</h1>
        <p class="subtitle">Menu spécial à 8€</p>

        <div class="priority-notice">
            <h3>⭐ Priorité aux clients fidèles</h3>
            <p>Les clients ayant une carte de fidélité avec des points bénéficient d'une priorité pour la réservation du repas de Noël.</p>
        </div>

        <div class="menu-card">
            <h2>Menu de Noël</h2>
            
            <div class="menu-item">
                <h3>Entrée</h3>
                <p>Foie gras maison ou Salade de saison</p>
            </div>
            
            <div class="menu-item">
                <h3>Plat principal</h3>
                <p>Dinde aux marrons ou Saumon fumé</p>
            </div>
            
            <div class="menu-item">
                <h3>Dessert</h3>
                <p>Bûche de Noël ou Tarte aux pommes</p>
            </div>
            
            <div class="menu-item">
                <h3>Boisson</h3>
                <p>Vin ou Jus de fruits</p>
            </div>
        </div>

        <div class="price">8€</div>

        <form id="noelForm">
            <div class="form-group">
                <label for="date">Date du repas de Noël :</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="creneau">Créneau horaire :</label>
                <select id="creneau" name="creneau" required>
                    <option value="">Sélectionnez un créneau</option>
                    <option value="11h00">11h00</option>
                    <option value="11h30">11h30</option>
                    <option value="12h30">12h30</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mode de consommation :</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="sur-place" name="mode" value="sur-place" required>
                        <label for="sur-place">Sur place</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="emporter" name="mode" value="emporter">
                        <label for="emporter">À emporter</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">Réserver le repas de Noël</button>
        </form>

        <div id="successMessage" class="success-message">
            Réservation du repas de Noël effectuée avec succès !
        </div>
    </div>

    <!-- Flocons de neige -->
    <div id="snowflakes"></div>

    <!-- Étoiles -->
    <div id="stars"></div>

    <script>
        // Créer des flocons de neige
        function createSnowflakes() {
            const snowflakesContainer = document.getElementById('snowflakes');
            const snowflakeSymbols = ['❄', '❅', '❆', '✻', '✼', '✽', '✾', '✿'];
            
            for (let i = 0; i < 50; i++) {
                const snowflake = document.createElement('div');
                snowflake.className = 'snowflake';
                snowflake.textContent = snowflakeSymbols[Math.floor(Math.random() * snowflakeSymbols.length)];
                snowflake.style.left = Math.random() * 100 + '%';
                snowflake.style.animationDuration = (Math.random() * 3 + 2) + 's';
                snowflake.style.opacity = Math.random();
                snowflake.style.fontSize = (Math.random() * 10 + 10) + 'px';
                snowflakesContainer.appendChild(snowflake);
            }
        }

        // Créer des étoiles scintillantes
        function createStars() {
            const starsContainer = document.getElementById('stars');
            
            for (let i = 0; i < 20; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.textContent = '⭐';
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 2 + 's';
                starsContainer.appendChild(star);
            }
        }

        // Initialiser les effets
        createSnowflakes();
        createStars();
    </script>

    <script>
        // Vérifier si l'utilisateur est connecté
        if (sessionStorage.getItem('loggedIn') !== 'true') {
            window.location.href = 'login.html';
        }

        // Menu déroulant
        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdown = document.querySelector('.dropdown');

        dropdownBtn.addEventListener('click', function() {
            dropdown.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Formulaire de réservation
        const noelForm = document.getElementById('noelForm');
        const successMessage = document.getElementById('successMessage');

        // Définir la date minimale à aujourd'hui
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);

        noelForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                date: document.getElementById('date').value,
                creneau: document.getElementById('creneau').value,
                mode: document.querySelector('input[name="mode"]:checked').value,
                type: 'noel',
                prix: 8
            };

            // Vérifier si l'utilisateur a des points (priorité)
            const username = sessionStorage.getItem('username');
            const userPoints = JSON.parse(localStorage.getItem('userPoints') || '{}');
            const points = userPoints[username] || 0;
            
            if (points > 0) {
                console.log('Client fidèle détecté - Priorité accordée');
            }

            // Sauvegarder la réservation dans localStorage
            let reservations = JSON.parse(localStorage.getItem('reservations') || '[]');
            reservations.push({
                ...formData,
                id: Date.now(),
                username: username,
                priority: points > 0
            });
            localStorage.setItem('reservations', JSON.stringify(reservations));

            // Afficher le message de succès
            successMessage.classList.add('show');
            
            // Réinitialiser le formulaire
            noelForm.reset();
            
            // Masquer le message après 3 secondes
            setTimeout(() => {
                successMessage.classList.remove('show');
            }, 3000);
        });

        function deconnexion() {
            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('username');
            sessionStorage.removeItem('role');
            window.location.href = 'login.html';
        }
    </script>
</body>
</html>


<?php
// cartefidelite.php - Page Carte Fidélité
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Fidélité - Restaurant PSR EREA</title>
    <link rel="stylesheet" href="cartefidelite.css">
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
        <h1>Ma Carte Fidélité</h1>
        
        <div class="card">
            <div class="card-header">
                <div class="card-title">Restaurant PSR EREA</div>
                <div id="username-display"></div>
            </div>
            
            <div class="points-display">
                <div class="points-label">Vos points de fidélité</div>
                <div class="points-number" id="points-display">0</div>
                <div class="points-label">points</div>
            </div>

            <div class="info-section">
                <div class="info-item">
                    <h3>Comment gagner des points ?</h3>
                    <p>Chaque repas réservé et validé vous rapporte 10 points de fidélité.</p>
                </div>
                <div class="info-item">
                    <h3>Avantages de la carte</h3>
                    <p>Les clients fidèles bénéficient de priorités pour les repas spéciaux et peuvent obtenir des récompenses.</p>
                </div>
            </div>
        </div>

        <div class="advantages">
            <h2>Avantages et Récompenses</h2>
            
            <div class="advantage-item">
                <h3>🎁 50 points</h3>
                <p>Boisson offerte</p>
            </div>
            
            <div class="advantage-item">
                <h3>🎁 100 points</h3>
                <p>Dessert offert</p>
            </div>
            
            <div class="advantage-item">
                <h3>🎁 200 points</h3>
                <p>Repas offert</p>
            </div>
            
            <div class="advantage-item">
                <h3>⭐ Client fidèle (> de 200 pts)</h3>
                <p>Priorité pour les repas de Noël et événements spéciaux</p>
            </div>
        </div>
    </div>

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

        // Afficher le nom d'utilisateur
        const username = sessionStorage.getItem('username') || 'Utilisateur';
        document.getElementById('username-display').textContent = username.charAt(0).toUpperCase() + username.slice(1);

        // Calculer et afficher les points de fidélité
        function calculatePoints() {
            const username = sessionStorage.getItem('username');
            const reservations = JSON.parse(localStorage.getItem('reservations') || '[]');
            
            // Compter les réservations validées de l'utilisateur
            const userReservations = reservations.filter(r => r.username === username);
            const points = userReservations.length * 10; // 10 points par réservation
            
            // Sauvegarder les points dans localStorage
            let userPoints = JSON.parse(localStorage.getItem('userPoints') || '{}');
            userPoints[username] = points;
            localStorage.setItem('userPoints', JSON.stringify(userPoints));
            
            // Afficher les points
            document.getElementById('points-display').textContent = points;
        }

        // Charger les points au chargement de la page
        calculatePoints();

        function deconnexion() {
            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('username');
            sessionStorage.removeItem('role');
            window.location.href = 'login.html';
        }
    </script>
</body>
</html>


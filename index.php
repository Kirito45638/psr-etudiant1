<?php
// index.php - Page d'accueil
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Déroulant</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Vous êtes sur la page d'accueil !</h1>
    <br>
    <br>
    <h2>Menu Déroulant</h2>
    <br>
    <br>
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


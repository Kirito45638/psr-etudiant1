<?php
// reservation.php - Page Réservation
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Restaurant PSR EREA</title>
    <link rel="stylesheet" href="reservation.css">
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
        <h1>Réservation de Repas</h1>
        
        <form id="reservationForm">
            <div class="form-group">
                <label for="date">Date du repas :</label>
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
                <label for="typeRepas">Type de repas :</label>
                <select id="typeRepas" name="typeRepas" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="standard">Standard</option>
                    <option value="vegetarien">Végétarien</option>
                    <option value="sans-porc">Sans porc</option>
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

            <button type="submit" class="btn-submit">Réserver</button>
        </form>

        <div id="successMessage" class="success-message">
            Réservation effectuée avec succès !
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

        // Formulaire de réservation
        const reservationForm = document.getElementById('reservationForm');
        const successMessage = document.getElementById('successMessage');

        // Définir la date minimale à aujourd'hui
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);

        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                date: document.getElementById('date').value,
                creneau: document.getElementById('creneau').value,
                typeRepas: document.getElementById('typeRepas').value,
                mode: document.querySelector('input[name="mode"]:checked').value
            };

            // Sauvegarder la réservation dans localStorage
            let reservations = JSON.parse(localStorage.getItem('reservations') || '[]');
            reservations.push({
                ...formData,
                id: Date.now(),
                username: sessionStorage.getItem('username')
            });
            localStorage.setItem('reservations', JSON.stringify(reservations));

            // Afficher le message de succès
            successMessage.classList.add('show');
            
            // Réinitialiser le formulaire
            reservationForm.reset();
            
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


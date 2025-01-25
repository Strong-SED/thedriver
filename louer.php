<?php
require 'config.php'; // Inclure le fichier de configuration pour la connexion à la base de données

// Vérifier si l'id de la voiture est passé en paramètre
$voiture_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Récupérer les détails de la voiture à partir de la base de données
if ($voiture_id > 0) {
    $sql = "SELECT marque, modele, prix FROM voiture WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $voiture_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $voiture = $result->fetch_assoc();
        $marque = $voiture['marque'];
        $modele = $voiture['modele'];
        $prix = $voiture['prix']; // Récupérer le prix de la voiture
    } else {
        // Gérer le cas où aucune voiture avec cet id n'est trouvée
        // Par exemple, rediriger l'utilisateur vers une page d'erreur ou autre action
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louer une Voiture - TheDriver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .header, .footer {
            background-color: #343a40;
            color: #ffffff;
        }
        .header a, .footer a {
            color: #ffffff;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .header .logo {
            max-width: 150px;
            height: auto;
        }
        .button-group {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header class="header py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.html"><img src="img/logo_thedriver.png" alt="TheDriver Logo" class="logo"></a>
            <nav>
                <a href="reserver.php">Réserver</a>
                <a href="contact.php">Contact</a>
                <a href="apropos.php">À propos</a>
                <a href="verification_reservation.php">Mes reservations</a>
            </nav>
        </div>
    </header>

    <main class="container my-5">
        <div class="form-container">
            <h1 class="text-center">Louer <?php echo $marque . ' ' . $modele; ?></h1>
            <?php if ($voiture_id > 0 && isset($marque) && isset($modele)) : ?>
            <p class="text-center">Prix par jour: <?php echo number_format($prix, 2); ?> FCFA</p> <!-- Afficher le prix -->
            <?php endif; ?>
            <form id="locationForm" method="post" action="process_louer.php">
                <input type="hidden" name="voiture_id" value="<?php echo $voiture_id; ?>">
                <div class="form-group">
                    <label for="date_heure">Date et Heure de Location</label>
                    <input type="datetime-local" id="date_heure" name="date_heure" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse de Livraison</label>
                    <input type="text" id="adresse" name="adresse" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="duree">Durée de Location (en jours)</label>
                    <input type="text" id="duree" name="duree" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Votre Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Location avec Chauffeur</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="avec_chauffeur" id="oui" value="oui">
                            <label class="form-check-label" for="oui">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="avec_chauffeur" id="non" value="non" checked>
                            <label class="form-check-label" for="non">Non</label>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" id="paymentButton" class="btn btn-primary">Louer maintenant</button>
                </div>
            </form>
            <form id="paymentForm" action="paiement_success.php" method="POST" style="display: none;">
                <script
                    src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                    data-public-key="pk_sandbox_mKXS3gN8xjzi46pXcryDuQLu"
                    data-button-text="Payer <?php echo $prix; ?> XOF"
                    data-button-class="button-class"
                    data-transaction-amount="<?php echo $prix; ?>"
                    data-transaction-description="Location de voiture"
                    data-currency-iso="XOF"
                    data-callback="handlePaymentCallback">
                </script>
            </form>
        </div>
    </main>

    <footer class="footer py-3">
        <div class="container text-center">
            <div class="social-icons">
                <a href="https://web.facebook.com/thedriver229" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/the_driver_229/" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://web.whatsapp.com/send?autoload=1&app_absent=0&phone=22950141414&text" target="_blank"><i class="bi bi-whatsapp"></i></a>
            </div>
            <p>&copy; 2024 TheDriver.com - Location de Voiture. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Empêcher la sélection de dates passées
        document.getElementById('date_heure').setAttribute('min', new Date().toISOString().slice(0, 16));

        document.getElementById('paymentButton').addEventListener('click', function() {
            // Validation du formulaire
            var form = document.getElementById('locationForm');
            if (form.checkValidity()) {
                // Soumettre le formulaire via AJAX
                var formData = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "process_louer.php", true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Enregistrement réussi, afficher le bouton de paiement
                        document.getElementById('paymentForm').style.display = 'block';
                        document.querySelector('#paymentForm script').click();
                    } else {
                        // Gérer les erreurs d'enregistrement ici
                        alert('Erreur lors de l\'enregistrement. Veuillez réessayer.');
                    }
                };
                xhr.send(formData);
            } else {
                form.reportValidity();
            }
        });

        function handlePaymentCallback(response) {
            if (response.status === 'paid') {
                window.location.href = 'confirmation_page.php';
            } else {
                alert('Le paiement a échoué. Veuillez réessayer.');
            }
        }
    </script>
</body>
</html>

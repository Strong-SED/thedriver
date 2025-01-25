<?php
ini_set('display_errors', 0);

// reservation.php
require 'config.php';
require 'vendor/autoload.php'; // Inclure Composer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voiture_id = $_POST['voiture_id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // Générer un code de réservation unique
    $numero_reservation = uniqid('RES-', true);

    // Insérer les informations de réservation dans la table reservation
    $sql = "INSERT INTO reservation (voiture_id, nom, email, telephone, date_debut, date_fin, numero_reservation) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issssss", $voiture_id, $nom, $email, $telephone, $date_debut, $date_fin, $numero_reservation);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Envoyer un email de confirmation avec PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Spécifiez le serveur SMTP de votre fournisseur
        $mail->SMTPAuth = true;
        $mail->Username = 'maxlfh4@gmail.com'; // Votre adresse email SMTP
        $mail->Password = 'dqcl pwwh ftja llux'; // Votre mot de passe SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom('noreply@thedriver.com', 'The Driver');
        $mail->addAddress($email, $nom);

        // Contenu de l'email
        $mail->CharSet = 'UTF-8'; // Définit l'encodage des caractères
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de réservation';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif;'>
                <img src='img/logo_thedriver.png' alt='Logo The Driver' style='max-width: 200px;'><br><br>
                Bonjour $nom,<br><br>
                Félicitations ! Votre réservation chez The Driver a été confirmée avec succès.<br><br>
                Voici les détails de votre réservation :<br><br>
                - Date de début : $date_debut<br>
                - Date de fin : $date_fin<br>
                - Numéro de réservation : $numero_reservation<br><br>
                Vous pouvez à tout moment consulter vos réservations dans votre espace personnel sur notre site.<br><br>
                À propos de The Driver :<br>
                The Driver est une entreprise dédiée à offrir une expérience de location de voiture exceptionnelle. Que vous ayez besoin d'une voiture pour vos voyages d'affaires ou vos vacances en famille, nous sommes là pour répondre à tous vos besoins de déplacement.<br><br>
                Nous vous remercions de votre confiance et avons hâte de vous servir !<br><br>
                Cordialement,<br>
                L'équipe de The Driver<br><br>
                <small>Cet e-mail a été généré automatiquement. Merci de ne pas y répondre.</small>
            </div>";
        $mail->AltBody = "Bonjour $nom,\n\nVotre réservation a été confirmée avec succès.\n\nDétails de la réservation :\n\n- Voiture : " . $voiture['marque'] . " " . $voiture['modele'] . "\n- Date de début : $date_debut\n- Date de fin : $date_fin\n- Numéro de réservation : $numero_reservation\n\nÀ propos de The Driver :\n\nThe Driver est une entreprise dédiée à offrir une expérience de location de voiture exceptionnelle. Que vous ayez besoin d'une voiture pour vos voyages d'affaires ou vos vacances en famille, nous sommes là pour répondre à tous vos besoins de déplacement.\n\nNous vous remercions de votre confiance et avons hâte de vous servir !\n\nCordialement,\nL'équipe de The Driver\n\n(Cet e-mail a été généré automatiquement. Merci de ne pas y répondre.)";
        
        $mail->send();
    } catch (Exception $e) {
        // Gérer les erreurs si nécessaire
        echo "Le message n'a pas pu être envoyé. Erreur de Mailer: {$mail->ErrorInfo}";
    }

    // Rediriger vers la page de confirmation
    header("Location: confirmation.php?numero_reservation=$numero_reservation");
    exit();
}

// Récupérer les informations de la voiture sélectionnée
if (isset($_GET['id'])) {
    $voiture_id = $_GET['id'];
    $sql = "SELECT * FROM voiture WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $voiture_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $voiture = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
} else {
    header("Location: reserver.php");
    exit();
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver une Voiture</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header {
            background-color: #343a40;
            padding: 10px 0;
        }
        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header .navbar-brand, .header a {
            color: #ffffff;
            text-decoration: none;
        }
        .header .logo {
            max-width: 200px;
            height: auto;
        }
        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }
        .footer a {
            color: #ffffff;
            margin: 0 10px;
        }
        .social-icons {
            margin-top: 20px;
        }
        .social-icons a {
            display: inline-block;
            margin-right: 10px;
            font-size: 1.5rem;
            color: #007bff;
        }
        .social-icons a:hover {
            color: #e3e7ec;
        }
        .fieldset-container {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #ffffff;
        }
        .fieldset-container legend {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-reserver, .btn-annuler {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 0 auto 10px;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <header class="header">
        <div class="container">
            <a href="index.html" class="d-flex align-items-center">
                <span class="navbar-brand"><img src="img/logo_thedriver.png" alt="Logo" class="logo mr-2"></span>
            </a>
            <nav>
                <a href="reserver.php">Réserver</a>
                <a href="contact.php">Contact</a>
                <a href="about.php">À propos</a>

            </nav>
        </div>
    </header>

    <div class="container my-4">
        <h1 class="text-center">Réservation de <?= $voiture['marque'] ?> <?= $voiture['modele'] ?></h1>
        <form action="reservation.php" method="post">
            <input type="hidden" name="voiture_id" value="<?= $voiture['id'] ?>">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="form-group">
                <label for="date_debut">Date et heure de début</label>
                <input type="datetime-local" class="form-control" id="date_debut" name="date_debut" required>
            </div>
            <div class="form-group">
                <label for="date_fin">Date et heure de fin</label>
                <input type="datetime-local" class="form-control" id="date_fin" name="date_fin" required>
            </div>
            <div class="button-group"> <!-- Nouveau groupe de boutons -->
                <button type="submit" class="btn btn-primary btn-reserver">Réserver</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="social-icons">
                <a href="https://web.facebook.com/thedriver229" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/the_driver_229/" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://web.whatsapp.com/send?autoload=1&app_absent=0&phone=22950141414&text" target="_blank"><i class="bi bi-whatsapp"></i></a>
            </div>
            <p>Copyright &copy; 2024 Thedriver.com Location de Voiture Tous droits réservés</p>
        </div>
    </footer>

    <!-- JavaScript pour Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
session_start();
ini_set('display_errors', 1); // Affiche les erreurs pour le développement
error_reporting(E_ALL);

require 'config.php'; // Inclure le fichier de configuration pour la connexion à la base de données
require 'vendor/autoload.php'; // Inclure l'autoload de Composer pour PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_heure = $_POST['date_heure'];
    $adresse = $_POST['adresse'];
    $duree = $_POST['duree'];
    $email = $_POST['email'];
    $voiture_id = $_POST['voiture_id'];

    // Insertion des données dans la base de données
    $sql = "INSERT INTO louer (date_heure, adresse, duree, email, voiture_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssisi', $date_heure, $adresse, $duree, $email, $voiture_id);

    if ($stmt->execute()) {
        // Mise à jour de la disponibilité de la voiture
        $update_sql = "UPDATE voiture SET disponible = 1 WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('i', $voiture_id);
        $update_stmt->execute();

        // Envoi de l'email de confirmation
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
            $mail->addAddress($email); // L'adresse email du client

            // Contenu de l'email
            $mail->CharSet = 'UTF-8'; // Définit l'encodage des caractères
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de location de voiture - TheDriver';
            $mail->Body = "
                <div style='font-family: Arial, sans-serif;'>
                    <img src='img/logo_thedriver.png' alt='Logo The Driver' style='max-width: 200px;'><br><br>
                    Bonjour,<br><br>
                    Félicitations ! Votre location chez The Driver a été confirmée avec succès.<br><br>
                    Voici les détails de votre location :<br><br>
                    - Date et Heure de Location : $date_heure<br>
                    - Adresse de Livraison : $adresse<br>
                    - Durée de Location : $duree jours<br><br>
                    Vous pouvez à tout moment consulter vos locations dans votre espace personnel sur notre site.<br><br>
                    Merci de votre confiance,<br>
                    L'équipe de The Driver<br><br>
                    <small>Cet e-mail a été généré automatiquement. Merci de ne pas y répondre.</small>
                </div>";
            $mail->AltBody = "Bonjour,\n\nVotre location chez The Driver a été confirmée avec succès.\n\nVoici les détails de votre location :\n\n- Date et Heure de Location : $date_heure\n- Adresse de Livraison : $adresse\n- Durée de Location : $duree jours\n\nMerci de votre confiance,\nL'équipe de The Driver\n\n(Cet e-mail a été généré automatiquement. Merci de ne pas y répondre.)";
            
            $mail->send();
        } catch (Exception $e) {
            echo "Le message n'a pas pu être envoyé. Erreur de Mailer: {$mail->ErrorInfo}";
        }

        // Redirection ou message de succès
        header('Location: confirmation_louer.php');
        exit;
    } else {
        echo "Erreur lors de la location. Veuillez réessayer.";
    }

    $stmt->close();
    $conn->close();
}
?>



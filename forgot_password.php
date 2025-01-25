<?php
session_start();
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Masquer les erreurs PHP
ini_set('display_errors', 0);
error_reporting(0);

$pdo = new PDO('mysql:host=localhost;dbname=thedriver', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM client WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        
        $token = bin2hex(random_bytes(50));
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $stmt->execute([$email, $token]);

        $resetLink = "http://localhost/thedriver/reset_password.php?token=" . $token;
        $message = "<p>Bonjour,</p>";
        $message .= "<p>Vous avez demandé la réinitialisation de votre mot de passe. Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>";
        $message .= "<p><a href='" . $resetLink . "'>Réinitialiser le mot de passe</a></p>";
        $message .= "<p>Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.</p>";
        $message .= "<p>Cordialement,<br>L'équipe  The driver</p>";

        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'maxlfh4@gmail.com'; // Remplacez par votre adresse email
            $mail->Password = 'dqcl pwwh ftja llux'; // Remplacez par votre mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinataire et expéditeur
            $mail->setFrom('thedriver@gmail.com', 'The driver ');
            $mail->addAddress($email);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation du mot de passe';
            $mail->Body    = $message;

            $mail->send();
            $success = "Un lien de réinitialisation du mot de passe a été envoyé à votre adresse email.";
        } catch (Exception $e) {
            $error = "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
    } else {
        $error = "Aucun compte trouvé avec cette adresse email.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Location de Voiture - Connexion</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      color: #333;
    }
    .content-container {
      background-color: white;
      border-radius: 15px;
      margin-top: 50px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      position: relative;
      z-index: 10;
      text-align: center;
    }
    .login-form {
      margin-bottom: 20px;
    }
    .login-form input {
      margin-bottom: 10px;
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn-primary {
      padding: 10px 20px;
      font-size: 1.2rem;
    }
    .signup-link {
      font-size: 0.8rem;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<header class="header">
    <div class="container">
        <a href="index.html" class="d-flex align-items-center">
            <span class="navbar-brand"><img src="img/logo_thedriver.png" alt="Logo" class="logo mr-2"></span>
        </a>
        
    </div>
</header>
  <div class="container content-container">
  <h1 style="color: rgb(64, 165, 131);font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Mot de passe oublié</h1>
                <div class="card border-primary">
                    <div class="card-header">
                        <h6 class="text-center mb-0">Entrez votre email pour réinitialiser votre mot de passe</h6>
                    </div>
                    <div class="container"><br><br>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <form method="post" action="forgot_password.php">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer le lien de réinitialisation</button>
                        </form><br><br>
                    </div>
                </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

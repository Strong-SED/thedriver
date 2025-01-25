<?php
session_start();
error_reporting(0); // Masquer les erreurs PHP

// Paramètres de connexion à la base de données
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "thedriver";

// Connexion à la base de données
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
$email = $_POST['username']; // On suppose que le champ "username" est en fait l'email
$password = $_POST['password'];

// Préparation de la requête SQL pour récupérer l'utilisateur
$stmt = $conn->prepare("SELECT id_client, email, password FROM client WHERE email = ? ");
$stmt->bind_param("s", $email);

// Exécution de la requête
$stmt->execute();

// Stockage du résultat
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Liaison des variables de résultat
    $stmt->bind_result($id_client, $db_email, $db_password);
    $stmt->fetch();

    // Vérification du mot de passe
    if (password_verify($password, $db_password)) {
        // Mot de passe correct, démarrage de la session
        $_SESSION['email'] = $db_email;
        $_SESSION['id_client'] = $id_client;

        // Vérification du rôle pour la redirection
        if ($email === 'admin@gmail.com' && $password === 'admin') {
            // Si c'est l'admin
            header("Location: admin.php");
        } else {
            // Sinon, utilisateur normal
            header("Location: reserver.php");
        }
        exit();
    } else {
        // Mot de passe incorrect
        $error = "Email ou mot de passe incorrect.";
    }
} else {
    // Aucun utilisateur trouvé avec cet email
  //  $error = "Aucun utilisateur trouvé avec cet email.";
}

// Fermeture du statement et de la connexion
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Location de Voiture - Connexion</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" href="img/logo_thedriver.png">

  <style>
    body {
  background-color: #f8f9fa; /* Couleur de fond de secours */
  color: #333; /* Couleur du texte */
  background-image: url('img/bg.jpeg'); /* Chemin vers votre image de fond */
  background-size: cover; /* Assure que l'image de fond couvre entièrement la zone du body */
  background-position: center; /* Centre l'image de fond */
  background-repeat: no-repeat; /* Empêche la répétition de l'image de fond */
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
    <h1>Connexion</h1>
    <p>Veuillez entrer vos identifiants de connexion pour accéder aux services.</p>
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form class="login-form" action="login.php" method="post"> <div class="form-group">
        <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
      </div>
      <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
    <a href="forgot_password.php">Mot de passe oublié ?</a>


    <h4 class="signup-link">Pas encore client ? <a href="inscription.php">Inscrivez-vous ici</a></h4>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

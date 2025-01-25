<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de Voiture - Inscription</title>
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
        .signup-form {
            margin-bottom: 20px;
        }
        .signup-form input {
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
        .login-link {
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
    <h1>Inscription</h1>
    <p>Veuillez remplir le formulaire ci-dessous pour créer un compte.</p>

    <form class="signup-form" action="process_inscription.php" method="post">
        <div class="form-group">
            <input type="text" name="nom" id="nom" placeholder="Nom" required>
        </div>
        <div class="form-group">
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
        </div>
        <div class="form-group">
            <input type="tel" name="telephone" id="telephone" placeholder="Téléphone" required>
        </div>
        <div class="form-group">
            <input type="text" name="adresse" id="adresse" placeholder="Adresse" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>

    <p class="login-link">Déjà client ? <a href="login.php">Connectez-vous ici</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

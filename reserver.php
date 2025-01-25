<?php
session_start();
ini_set('display_errors', 0);

// Vérification de la session utilisateur
if (!isset($_SESSION['id_client'])) {
    header('Location: login.php');
    exit();
}

// reserver.php
require 'config.php';

// Récupérer les informations des voitures disponibles
$sql = "SELECT * FROM voiture WHERE disponible = 0";
$result = mysqli_query($conn, $sql);
$voitures = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <link rel="icon" href="img/logo_thedriver.png">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #ffffff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .car-info h3 {
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .car-info p {
            margin-bottom: 5px;
        }
        .price-info .price {
            font-size: 1.5rem;
            color: #ff5722;
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
            font-size: 1.5rem; /* Taille des icônes */
            color: #007bff; /* Couleur des icônes */
        }
        .social-icons a:hover {
            color: #e3e7ec; /* Couleur au survol */
        }
        .container .logo {
            position: absolute;
            top: 0px;
            left: 20px;
            width: 200px; /* Adjust the width as needed */
        }
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .button-group a {
            margin: 5px;
        }
        .price-info{
            margin-left: 53%;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="index.html" class="d-flex align-items-center">
                <span class="navbar-brand"><img src="img/logo_thedriver.png" alt="Logo" class="logo mr-2"></span>
            </a>
            <nav>
                <a href="reserver.php">Réserver</a>
                <a href="contact.php">Contact</a>
                <a href="apropos.php">À propos</a>
                <a href="verification_reservation.php">Mes reservations</a>
                
                <?php if (isset($_SESSION['id_client'])): ?>
                    <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light">Connexion</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container my-4">
        <h1 class="mb-4">Découvrir nos services</h1>
        <div class="row">
            <?php foreach ($voitures as $voiture): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= $voiture['image'] ?>" alt="<?= $voiture['marque'] ?>" class="card-img-top">
                    <div class="car-info">
                        <h3><?= $voiture['marque'] ?> <?= $voiture['modele'] ?></h3>
                        <p><i class="bi bi-gear"></i> Transmission: <?= $voiture['transmission'] ?></p>
                        <p><i class="bi bi-fuel-pump"012.></i> Carburant: <?= $voiture['carburant'] ?></p>
                        <p><i class="bi bi-people"></i> Capacité: <?= $voiture['capacite'] ?> personnes</p>
                        <p><i class="fas fa-suitcase"></i> Bagages: <?= $voiture['bagages'] ?></p>
                    </div>
                    <div class="price-info">
                        <?= $voiture['prix'] ?> FCFA <span>/ jour</span>
                    </div>
                    <div class="button-group">
                        <a href="louer.php?id=<?= $voiture['id'] ?>" class="btn btn-success">Louer</a>
                        <a href="reservation.php?id=<?= $voiture['id'] ?>" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
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

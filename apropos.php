<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de nous - TheDriver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo_thedriver.png">

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
        .about-section {
            background-color: white;
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .about-section h2 {
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        .about-section p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .about-section .team .team-member {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 250px; /* Fixed height for all team members */
            margin-bottom: 15px;
            overflow: hidden;
            width: 250px;
        }
        .about-section .team img {
            max-height: 150px;
            width: auto;
            border-radius: 50%;
        }
        .about-section .team h4 {
            margin-top: 10px;
        }
        .about-section .team p {
            margin-bottom: 0;
            color: #888;
        }
        .header .logo {
            max-width: 150px;
            height: auto;
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
        <div class="about-section">
            <h2>À propos de TheDriver</h2>
            <p>Bienvenue chez TheDriver, votre partenaire de confiance pour la location de voitures au Bénin. Depuis notre création, nous nous sommes engagés à fournir des services de location de voiture de qualité supérieure avec un large choix de véhicules adaptés à tous vos besoins de transport. Que vous ayez besoin d'une voiture pour un déplacement professionnel, des vacances en famille ou un événement spécial, nous avons le véhicule parfait pour vous.</p>
            <p>Notre mission est de rendre votre expérience de location de voiture aussi simple et agréable que possible. Nous offrons une réservation facile, un service client exceptionnel et des tarifs compétitifs pour garantir votre satisfaction totale.</p>
            
            <h2>Notre équipe</h2>
            <div class="row team">
                <div class="col-md-4 team-member">
                    <img src="img/joe1.jfif" alt="Team Member">
                    <h4>Bonfils Dhossou</h4>
                    <p>CEO & Fondateur</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="img/marie.jfif" alt="Team Member">
                    <h4>Marie Smith</h4>
                    <p>Directrice Marketing</p>
                </div>
                <div class="col-md-4 team-member">
                    <img src="img/paul.jfif" alt="Team Member">
                    <h4>Paul Brown</h4>
                    <p>Responsable des Opérations</p>
                </div>
            </div>
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
</body>
</html>

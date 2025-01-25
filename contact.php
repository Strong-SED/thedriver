<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - TheDriver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo_thedriver.png">

    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .header 
        .logo {
            max-width: 150px;
            height: auto;
        }
        .header, .footer {
            background-color: #343a40;
            color: #ffffff;
        }
        .header a, .footer a {
            color: #ffffff;
        }
        .contact-form {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .contact-info {
            padding: 30px;
            border-radius: 15px;
            background-color: #343a40;
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .contact-info h3 {
            margin-bottom: 15px;
        }
        .contact-info p {
            margin-bottom: 10px;
        }
        .contact-info .social-icons a {
            margin-right: 10px;
            color: white;
            font-size: 1.5rem;
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
        <h1 class="mb-4">Contactez-nous</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info">
                    <h3>Informations de contact</h3>
                    <p><i class="bi bi-geo-alt"></i> Adresse: Avenue de l'Industrie, Cotonou, Bénin</p>
                    <p><i class="bi bi-telephone"></i> Téléphone: +229 50 14 14 14</p>
                    <p><i class="bi bi-envelope"></i> Email: contact@thedriver.com</p>
                    <div class="social-icons">
                        <a href="https://web.facebook.com/thedriver229" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/the_driver_229/" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://web.whatsapp.com/send?autoload=1&app_absent=0&phone=22950141414&text" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form">
                    <h3>Envoyez-nous un message</h3>
                    <form action="send_message.php" method="post">
                        <input type="text" name="name" placeholder="Votre nom" required>
                        <input type="email" name="email" placeholder="Votre email" required>
                        <input type="tel" name="phone" placeholder="Votre téléphone" required>
                        <textarea name="message" rows="5" placeholder="Votre message" required></textarea>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
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

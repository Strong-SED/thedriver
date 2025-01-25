<?php
session_start();
error_reporting(0); // Masquer les erreurs PHP

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@gmail.com') {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié comme administrateur
    header("Location: login.php");
    exit();
}

// Traitement du formulaire d'ajout de voiture
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $transmission = $_POST['transmission'];
    $carburant = $_POST['carburant'];
    $capacite = $_POST['capacite'];
    $bagages = $_POST['bagages'];
    $prix = $_POST['prix'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    // Traitement de l'image
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérifier si le fichier image est une image réelle ou une fausse image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }

    // Vérifier si le fichier existe déjà
    if (file_exists($target_file)) {
        $error = "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Vérifier la taille du fichier
    if ($_FILES["image"]["size"] > 500000) {
        $error = "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifier si $uploadOk est à 0 à cause d'une erreur
    if ($uploadOk == 0) {
        $error = "Désolé, votre fichier n'a pas été téléchargé.";

    // Si tout est ok, essayer de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insertion des données dans la base de données
            $sql = "INSERT INTO voiture (marque, modele, transmission, carburant, capacite, bagages, prix, image, disponible) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssiiisi", $marque, $modele, $transmission, $carburant, $capacite, $bagages, $prix, $target_file, $disponible);
            
            if ($stmt->execute()) {
                $success = "La voiture a été ajoutée avec succès.";
            } else {
                $error = "Erreur lors de l'ajout de la voiture: " . $conn->error;
            }
            $stmt->close();
        } else {
            $error = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }

    // Fermeture de la connexion à la base de données
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Voiture - The Driver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            padding: 10px 20px;
            font-size: 1.2rem;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .success-message {
            color: green;
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
        <h1>Ajouter une Voiture</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert alert-success success-message"><?php echo $success; ?></div>
        <?php endif; ?>
        <form class="needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="marque">Marque :</label>
                <input type="text" class="form-control" id="marque" name="marque" required>
            </div>
            <div class="form-group">
                <label for="modele">Modèle :</label>
                <input type="text" class="form-control" id="modele" name="modele" required>
            </div>
            <div class="form-group">
                <label for="transmission">Transmission :</label>
                <select class="form-control" id="transmission" name="transmission" required>
                    <option value="Automatique">Automatique</option>
                    <option value="Manuelle">Manuelle</option>
                    <option value="Electrique">Electrique</option>
                </select>
            </div>
            <div class="form-group">
                <label for="carburant">Carburant :</label>
                <input type="text" class="form-control" id="carburant" name="carburant" required>
            </div>
            <div class="form-group">
                <label for="capacite">Capacité :</label>
                <input type="number" class="form-control" id="capacite" name="capacite" required>
            </div>
            <div class="form-group">
                <label for="bagages">Bagages :</label>
                <input type="number" class="form-control" id="bagages" name="bagages" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix par jour :</label>
                <input type="number" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="disponible" name="disponible" value="0" checked>
                    <label class="form-check-label" for="disponible">
                        Disponible
                    </label>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Ajouter la Voiture</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Bootstrap validation script
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>

<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@gmail.com') {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié comme administrateur
    header("Location: login.php");
    exit();
}

// Ici vous pouvez inclure le code PHP spécifique à la page d'administration si nécessaire

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 50px;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            text-align: center;
        }
        .btn-link {
            color: #007bff;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tableau de Bord Administrateur</h1>
        <p>Bienvenue, Mr Feriol !</p>
        <div class="mt-4">
            <div class="list-group">
                <a href="manage_users.php" class="list-group-item list-group-item-action">Gérer les Utilisateurs</a>
                <a href="voiture.php" class="list-group-item list-group-item-action">Gérer les Voitures</a>
                <!-- Ajoutez d'autres liens vers les fonctionnalités d'administration ici -->
            </div>
            <a href="logout.php" class="btn btn-link mt-3">Déconnexion</a>
        </div>
    </div>
</body>
</html>

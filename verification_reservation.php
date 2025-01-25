<?php
// verification_reservation.php

ini_set('display_errors', 0);

require 'config.php'; // Inclure le fichier de configuration pour la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numero_reservation'])) {
    $numero_reservation = $_POST['numero_reservation'];

    // Requête pour récupérer les détails de la réservation avec la marque et le modèle de la voiture
$sql = "SELECT r.numero_reservation, v.marque, v.modele, r.nom, r.email, r.telephone, r.date_debut, r.date_fin
FROM reservation r
INNER JOIN voiture v ON r.voiture_id = v.id
WHERE r.numero_reservation = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $numero_reservation);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
// Réservation trouvée, récupérer les détails
$reservation = mysqli_fetch_assoc($result);
} else {
// Aucune réservation trouvée avec ce numéro
$error_message = "Aucune réservation trouvée avec ce numéro de réservation.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de Réservation</title>
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
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vérification de Réservation</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="numero_reservation">Numéro de Réservation :</label>
                <input type="text" class="form-control" id="numero_reservation" name="numero_reservation" required>
            </div>
            <button type="submit" class="btn btn-primary">Vérifier</button>
        </form>

        <?php if (isset($reservation)): ?>
            <div class="mt-4">
                <h3>Réservation trouvée :</h3>
                <p><strong>Numéro de Réservation :</strong> <?= $reservation['numero_reservation'] ?></p>
                <p><strong>Voiture :</strong> <?= $reservation['marque'] ?> <?= $reservation['modele'] ?></p>
                <p><strong>Nom :</strong> <?= $reservation['nom'] ?></p>
                <p><strong>Email :</strong> <?= $reservation['email'] ?></p>
                <p><strong>Téléphone :</strong> <?= $reservation['telephone'] ?></p>
                <p><strong>Date et heure de début :</strong> <?= $reservation['date_debut'] ?></p>
                <p><strong>Date et heure de fin :</strong> <?= $reservation['date_fin'] ?></p>
            </div>
        <?php elseif (isset($error_message)): ?>
            <div class="mt-4 text-danger">
                <p><?= $error_message ?></p>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>

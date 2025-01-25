<?php
ini_set('display_errors', 0);

// confirmation.php
if (!isset($_GET['numero_reservation'])) {
    header("Location: reserver.php");
    exit();
}

$numero_reservation = $_GET['numero_reservation'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo_thedriver.png">

    <style>
        body {
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmation de Réservation</h1>
        <p>Votre réservation a été effectuée avec succès !</p>
        <p>Numéro de réservation : <strong><?= htmlspecialchars($numero_reservation) ?></strong></p>
        <a href="reserver.php" class="btn btn-primary">Retour</a>
    </div>
</body>
</html>

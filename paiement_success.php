

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Paiement</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .confirmation-container {
            background-color: #fff;
            border-radius: 0.25rem;
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.1);
            text-align: center;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
        }
        .confirmation-icon {
            color: #28a745;
            font-size: 5rem;
            margin-bottom: 1rem;
        }
        .confirmation-message {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .confirmation-details {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .btn-back {
            background-color: #4a148c;
            color: #fff;
            border: none;
            padding: 0.5rem 2rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #380c6d;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <i class="fas fa-check-circle confirmation-icon"></i>
    <div class="confirmation-message">Paiement Confirmé</div>
    <div class="confirmation-details">
        Merci pour votre paiement. Votre transaction a été effectuée avec succès.
        <br>Vous recevrez un email de confirmation sous peu.
    </div>
    <a href="reserver.php" class="btn-back">Retour à l'espace client</a>
</div>

</body>
</html>

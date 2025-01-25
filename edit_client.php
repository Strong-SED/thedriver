<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Récupérer les informations du client à modifier depuis la base de données
    $sql = "SELECT * FROM client WHERE id_client = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_client);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        echo "Client non trouvé.";
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID du client non spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client - TheDriver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Modifier Client</h1>
    <form id="clientForm" method="post" action="manage_clients.php">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id_client" value="<?php echo $client['id_client']; ?>">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $client['nom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $client['prenom']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $client['telephone']; ?>" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $client['adresse']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $client['email']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
        <a href="liste_cli.php" class="btn btn-secondary ml-2">Annuler</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>

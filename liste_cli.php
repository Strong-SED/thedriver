<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients - TheDriver</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Liste des Clients</h1>
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'config.php';

        // Récupérer tous les clients depuis la base de données
        $sql = "SELECT * FROM client";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id_client']; ?></td>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td><?php echo $row['adresse']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_client.php?id=<?php echo $row['id_client']; ?>" class="btn btn-warning">Modifier</a>
                        <button class="btn btn-danger btn-delete" data-id="<?php echo $row['id_client']; ?>">Supprimer</button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='7'>Aucun client trouvé</td></tr>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>
    <a href="manage_users.php" class="btn btn-primary">Ajouter un Nouveau Client</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Bouton Supprimer
        $(document).on('click', '.btn-delete', function() {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce client ?')) {
                var id = $(this).data('id');
                $.ajax({
                    url: 'manage_clients.php',
                    type: 'post',
                    data: {action: 'delete', id_client: id},
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        });
    });
</script>
</body>
</html>

<?php
require 'config.php';

// Vérifier si l'action est spécifiée et traiter en conséquence
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Si l'action est de mettre à jour un client
    if ($action === 'update') {
        $id_client = $_POST['id_client'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $email = $_POST['email'];

        // Préparer et exécuter la requête SQL de mise à jour
        $sql = "UPDATE client SET nom = ?, prenom = ?, telephone = ?, adresse = ?, email = ? WHERE id_client = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $nom, $prenom, $telephone, $adresse, $email, $id_client);

        if ($stmt->execute()) {
            echo "Client mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du client: " . $stmt->error;
        }

        $stmt->close();
    }

    // Si l'action est de supprimer un client
    elseif ($action === 'delete') {
        $id_client = $_POST['id_client'];

        // Préparer et exécuter la requête SQL de suppression
        $sql = "DELETE FROM client WHERE id_client = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id_client);

        if ($stmt->execute()) {
            echo "Client supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du client: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<?php
require 'config.php';

// Vérifier si le formulaire a été soumis et l'action est "add"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Préparer et exécuter la requête SQL d'insertion
    $sql = "INSERT INTO client (nom, prenom, telephone, adresse, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $nom, $prenom, $telephone, $adresse, $email, $password);

    if ($stmt->execute()) {
        echo 'Client ajouté avec succès. <a href="liste_cli.php">Cliquer ici pour consulté la liste des clients</a>';
    } else {
        echo "Erreur lors de l'ajout du client: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
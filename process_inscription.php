
<?php
error_reporting(0); // Masquer les erreurs PHP

// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thedriver";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Escape user input to prevent SQL injection
$nom = mysqli_real_escape_string($conn, $_POST['nom']);
$prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
$telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
$adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Hash password for security (using bcrypt)
$password = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);  // Replace with a strong hashing algorithm

// SQL query to insert data
$sql = "INSERT INTO client (nom, prenom, telephone, adresse, email, password)
VALUES ('$nom', '$prenom', '$telephone', '$adresse', '$email', '$password')";

// Attempt to insert data
if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie avec succès! Vous pouvez maintenant vous connecter: <a href='login.php'>Connectez-vous ici</a>";
} else {
  // echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
<?php
ini_set('display_errors', 0);

session_start();
require 'vendor/autoload.php';
$pdo = new PDO('mysql:host=localhost;dbname=thedriver', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ?");
        $stmt->execute([$token]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reset) {
            $email = $reset['email'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("UPDATE client SET password = ? WHERE email = ?");
            $stmt->execute([$hashedPassword, $email]);

            $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->execute([$token]);

            $success = "Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.";
        } else {
            $error = "Lien de réinitialisation invalide.";
        }
    } else {
        $error = "Les mots de passe ne sont pas identiques.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo_thedriver.png">

</head>
<style>
     body {
  background-color: #f8f9fa; /* Couleur de fond de secours */
  color: #333; /* Couleur du texte */
  background-image: url('img/bg.jpeg'); /* Chemin vers votre image de fond */
  background-size: cover; /* Assure que l'image de fond couvre entièrement la zone du body */
  background-position: center; /* Centre l'image de fond */
  background-repeat: no-repeat; /* Empêche la répétition de l'image de fond */
}
</style>
<body>
<?php include 'header.php'; ?>
<br><br><br>
<section class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6"><br>
                <h1 style="color: rgb(64, 165, 131);font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Réinitialiser le mot de passe</h1>
                <div class="card border-primary">
                    <div class="card-header">
                        <h6 class="text-center mb-0">Entrez votre nouveau mot de passe</h6>
                    </div>
                    <div class="container"><br><br>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <form method="post" action="reset_password.php">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                            <div class="form-group">
                                <label for="password">Nouveau mot de passe:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirmez le mot de passe:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
                        </form><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<br><br><br>
<?php include 'footer.php'; ?>

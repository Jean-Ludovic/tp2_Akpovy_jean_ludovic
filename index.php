<?php
require_once('config/connexion.php');
require_once('config/functions.php');
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num_addresses'])) {
        $_SESSION['num_addresses'] = (int)$_POST['num_addresses'];
        header("Location: index.php");
        exit();
    } else {
        displayNumAddressesForm();
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- ... (le début du fichier reste inchangé) -->
    </head>
    <body>
        <h1>Bienvenue sur notre page</h1>
        <br><br>
        <a href="pages/signup.php">Signup</a>
        <br><br>
        <a href="pages/login.php">Login</a>
    </body>
    </html>
    <?php
}
?>

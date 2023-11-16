<?php
require_once("../config/connexion.php");
require_once("../config/functions.php");

session_start();

if (isset($_POST)) {
    unset($_SESSION);
    $_SESSION["signup-form"] = $_POST;
    // Vous pouvez ajouter des vérifications supplémentaires ici
    // par exemple, vérifier si l'email est unique avant de rediriger
    header("Location: ../pages/signup.php");
    exit();
}
?>

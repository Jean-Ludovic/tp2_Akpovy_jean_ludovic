<?php
require_once("../config/connexion.php");
require_once("../config/functions.php");

session_start();

if (isset($_POST['user_name'], $_POST['pwd'])) {
    $user_name = $_POST['user_name'];
    $pwd = $_POST['pwd'];

    $user = getUserByName($user_name);

    if ($user && password_verify($pwd, $user['password'])) {
        session_regenerate_id();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['user_name'];
        header("Location: ../index.php");
        exit();
    } else {
        echo "Erreur : Nom d'utilisateur ou mot de passe incorrect !";
    }
} else {
    echo "Erreur : Données du formulaire introuvables dans la requête !";
}
?>

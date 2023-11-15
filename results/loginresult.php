<?php
// Inclusion des fichiers nécessaires
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
session_start();

// Vérification de la présence des données du formulaire dans la requête POST
if (isset($_POST['user_name'], $_POST['pwd'])) {
    // Validation et nettoyage des données du formulaire
    $user_name = usernameIsValid($_POST['user_name']);
   

   

    if ($user) {
        // Configuration de la session utilisateur
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['user_name'];

        // Redirection de l'utilisateur vers la page d'accueil ou toute autre page sécurisée
        header("Location: ../index.php");
        exit();
    } else {
        //message d'erreur
        echo "Erreur : Nom d'utilisateur ou mot de passe incorrect !";
        
    }
} else {
    // si les data ne sont pas présentes dans la requête POST
    echo "Erreur : Données du formulaire introuvables dans la requête !";
}
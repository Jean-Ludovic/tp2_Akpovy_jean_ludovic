<?php

//  les informations de connexion de votre base de données
$host = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$database = "votre_base_de_donnees";

// Création de la connexion
$conn = mysqli_connect($host, $username, $password, $database);

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

?>

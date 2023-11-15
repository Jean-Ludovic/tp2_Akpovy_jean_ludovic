<?php

//  les informations de connexion de votre base de données
$host = "localhost";
$username = "Julien_Dussollier";
$password = "groupe433";
$database = "Ecom1_tp2";

// Création de la connexion
$conn = mysqli_connect($host, $username, $password, $database);

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

?>

<?php
function getUserByName(string $user_name)
{
    global $conn;
    $query = "SELECT * FROM user WHERE user.user_name = '" . $user_name."';";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

//afficher le formulaire de saisie du nombre d'adresses
function displayNumAddressesForm() {
    include 'num_addresses_form.php';
}

//afficher le formulaire d'adresse en fonction du nombre spécifié
function displayAddressForm($num_addresses) {
    for ($i = 1; $i <= $num_addresses; $i++) {
        include 'address_fields.php';
    }
}

// afficher les adresses confirmées
function displayConfirmedAddresses() {
    for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
        include 'confirmed_address.php';
    }
}

// sauvegarder les données du formulaire dans la session
function saveFormDataToSession() {
    $_SESSION['form_data'] = $_POST;
}

// Fonction pour sauvegarder les données confirmées dans la base de données
function saveConfirmedDataToDatabase() {
    // Inclure le fichier de connexion à la base de données
    include 'connexion.php';

    // Récupération des données confirmées à partir de la session
    $form_data = $_SESSION['form_data'];

    // Boucle pour insérer chaque adresse dans la base de données
    for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
        $street = mysqli_real_escape_string($conn, $form_data['street' . $i]);
        $street_nb = (int)$form_data['street_nb' . $i];
        $type = mysqli_real_escape_string($conn, $form_data['type' . $i]);
        $city = mysqli_real_escape_string($conn, $form_data['city' . $i]);
        $zipcode = mysqli_real_escape_string($conn, $form_data['zipcode' . $i]);

        // Requête SQL pour insérer les données dans la table 'addresses'
        $sql = "INSERT INTO addresses (street, street_nb, type, city, zipcode) 
                VALUES ('$street', $street_nb, '$type', '$city', '$zipcode')";

        // Exécution de la requête
        if (!mysqli_query($conn, $sql)) {
            die("Erreur lors de l'insertion des données : " . mysqli_error($conn));
        }
    }

    // Fermeture de la connexion
    mysqli_close($conn);
}

?>


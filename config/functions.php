<?php


require_once("connexion.php");

function getUserByName(string $user_name)
{
    global $conn;
    $query = "SELECT * FROM address WHERE user_name = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Erreur lors de la préparation de la requête : " . mysqli_error($conn));
    }

    if (!mysqli_stmt_bind_param($stmt, "s", $user_name)) {
        die("Erreur lors de la liaison des paramètres : " . mysqli_error($conn));
    }

    if (!mysqli_stmt_execute($stmt)) {
        die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
    }

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Erreur lors de l'obtention du jeu de résultats : " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $data;
}



// Afficher le formulaire de saisie du nombre d'adresses
function displayNumAddressesForm() {
    include 'num_addresses_form.php';
}

// Afficher le formulaire d'adresse en fonction du nombre spécifié
function displayAddressForm($num_addresses) {
    for ($i = 1; $i <= $num_addresses; $i++) {
        include 'address_fields.php';
    }
}

// Afficher les adresses confirmées
function displayConfirmedAddresses() {
    for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
        include 'confirmed_address.php';
    }
}

// Sauvegarder les données du formulaire dans la session
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

function usernameIsValid(string $username): array
{
    global $conn;

    $result = [
        'isValid' => true,
        'msg' => ''
    ];

    $userInDB = getUserByName($username);

    if (strlen($username) < 2) {
        // Si le username est trop court
        $result = [
            'isValid' => false,
            'msg' => '<h2><center>ERROR!</center></H2>Le nom utilisé est trop court'
        ];
    } elseif (strlen($username) > 20) {
        // Si le username est trop long
        $result = [
            'isValid' => false,
            'msg' => '<h2><center>ERROR!</center></H2>Le nom utilisé est trop long'
        ];
    } elseif ($userInDB) {
        // Si le username est déjà utilisé dans la BDD
        $result = [
            'isValid' => false,
            'msg' => '<h2><center>ERROR!</center></H2>Le nom est déjà utilisé!'
        ];
    }

    return $result;
}

?>
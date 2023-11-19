<?php
require_once("../config/connexion.php");
require_once("../config/functions.php");

// Initialisation du tableau des données des itérations
$data_iterations = [];

// Vérifier si les données du formulaire sont disponibles
if (isset($_GET['num_formulaires']) && isset($_GET['current_iteration'])) {
    $num_formulaires = $_GET['num_formulaires'];
    $current_iteration = $_GET['current_iteration'];

    // Vérifier si le formulaire actuel a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['envoyer'])) {
        // Traiter les données du formulaire actuel
        $street = $_POST['street'];
        $street_nb = $_POST['street_nb'];
        $type = $_POST['type'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];

        // Ajouter les données de l'itération actuelle au tableau 
        $data_iteration = [
            'street' => $street,
            'street_nb' => $street_nb,
            'type' => $type,
            'city' => $city,
            'zipcode' => $zipcode,
        ];
        $data_iterations[] = $data_iteration;

        // Si ce n'est pas la dernière itération, rediriger vers la prochaine itération
        $current_iteration++;
        if ($current_iteration <= $num_formulaires) {
            // Construisez l'URL avec les données du formulaire
            $url = "adresse.php?num_formulaires=$num_formulaires&current_iteration=$current_iteration";
            $url .= "&street=" . urlencode($street);
            $url .= "&street_nb=" . urlencode($street_nb);
            $url .= "&type=" . urlencode($type);
            $url .= "&city=" . urlencode($city);
            $url .= "&zipcode=" . urlencode($zipcode);

            header("Location: $url");
            exit();
        } else {
            // Si c'est la dernière itération, ne faites pas la redirection ici
            // La redirection et l'insertion dans la base de données seront effectuées après la boucle
        }
    }

    // Récupérer les données actuelles du formulaire depuis la base de données
    $donneesActuelles = getFormDataFromDatabase($num_formulaires, $current_iteration);

    // Vérifier si le formulaire a déjà été soumis
    if (!empty($donneesActuelles)) {
        // Les données existent, afficher le formulaire pré-rempli avec les données actuelles
        afficherFormulaireAvecDonnees($donneesActuelles);
    } else {
        // Les données n'existent pas, afficher le formulaire vide
        afficherFormulaire();
    }

    // Si c'est la dernière itération, insérer les données dans la base de données
    if ($current_iteration > $num_formulaires) {
        insererDonneesDansLaBase($num_formulaires, $current_iteration, $data_iterations);
        // Rediriger vers la page de confirmation
        header("Location: confirmation.php?num_formulaires=$num_formulaires&current_iteration=$current_iteration");
        exit();
    }
} else {
    // Si les paramètres nécessaires ne sont pas présents, rediriger l'utilisateur
    header("Location: ../index.php");
    exit();
}
?>

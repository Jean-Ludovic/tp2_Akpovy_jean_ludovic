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

        // Supprimer la dernière donnée de la base de données
        supprimerDerniereDonnee($num_formulaires);

        // Insérer les nouvelles données dans la base de données
        insertFormDataIntoDatabase($num_formulaires, $current_iteration, $data_iteration);

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
            // Si c'est la dernière itération, rediriger vers la page de confirmation
            header("Location: confirmation.php?num_formulaires=$num_formulaires&current_iteration=$current_iteration");
            exit();
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
} else {
    // Si les paramètres nécessaires ne sont pas présents, rediriger l'utilisateur
    header("Location: ../index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresses </title>
    <link rel="stylesheet" type="text/css" href=".">
</head>
<body>
    <h2>Adresses<?php echo $current_iteration; ?></h2>

    <<form action="confirmation.php?num_formulaires=<?php echo $num_formulaires; ?>&current_iteration=<?php echo $current_iteration; ?>" method="post">

        <input type="hidden" name="num_formulaires" value="<?php echo $num_formulaires; ?>">
        <input type="hidden" name="current_iteration" value="<?php echo $current_iteration; ?>">

        <label for="street">Rue:</label>
        <input type="text" id="street" name="street" maxlength="50" required>
        <br>

        <label for="street_nb">Numéro de Rue:</label>
        <input type="number" id="street_nb" name="street_nb" required>
        <br>

        <label for="type">Type:</label>
        <select id="type" name="type" maxlength="20" required>
            <option value="livraison">Livraison</option>
            <option value="facturation">Facturation</option>
            <option value="autre">Autre</option>
        </select>
        <br>

        <label for="city">Ville:</label>
        <select id="city" name="city" required>
            <option value="Montreal">Montréal</option>
            <option value="Laval">Laval</option>
            <option value="Toronto">Toronto</option>
            <option value="Quebec">Québec</option>
        </select>
        <br>

        <label for="zipcode">Code postal:</label>
        <input type="text" id="zipcode" name="zipcode" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" maxlength="7" required>
        <small>Format: A1A 1A1</small>
        <br><br>

        <input type="submit" value="Soumettre" name="envoyer">
    </form>
</body>
</html>

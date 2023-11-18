<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adresses </title>
    <link rel="stylesheet" type="text/css" href="../styles/styleaddresse.css">

</head>
<body>
<?php
require_once("../config/connexion.php");
require_once("../config/functions.php");

// Vérifier si les données du formulaire sont disponibles
if (isset($_GET['num_formulaires']) && isset($_GET['current_iteration'])) {
    $num_formulaires = $_GET['num_formulaires'];
    $current_iteration = $_GET['current_iteration'];

    // Récupérer les données actuelles du formulaire depuis la base de données
    $donneesActuelles = getFormDataFromDatabase($num_formulaires, $current_iteration);

    // Vérifier si le formulaire a déjà été soumis
    if (!empty($donneesActuelles)) {
        // Les données existent, afficher le formulaire pré-rempli avec les données actuelles
        afficherFormulaireAvecDonnees($donneesActuelles);
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les nouvelles données du formulaire soumises
    $nouvellesDonnees = array(
        // Récupérer les données du formulaire depuis $_POST
        // Exemple: 'nom' => $_POST['nom'],
        // ...
    );

    // Mettre à jour les données du formulaire dans la base de données
    mettreAJourDonneesDansLaBase($num_formulaires, $current_iteration, $nouvellesDonnees);

    // Rediriger vers la page de confirmation
    header("Location: confirmation.php?num_formulaires=$num_formulaires&current_iteration=$current_iteration");
    exit();
}

?>



    <h2>Adresses<?php echo $current_iteration; ?></h2>

    <form action="adresse.php?num_formulaires=<?php echo $num_formulaires; ?>&current_iteration=<?php echo $current_iteration; ?>" method="post">
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
        <input type="submit" value="Soumettre" name="envoyer" >
    </form>


    <form action="confirmation.php" method="post">
        <input type="hidden" name="num_formulaires" value="<?php echo $num_formulaires; ?>">
        <input type="hidden" name="current_iteration" value="<?php echo $current_iteration; ?>">

    </form>
</body>
</html>
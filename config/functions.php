<?php
// config/functions.php

// Assurer la connexion à la base de données
require_once(__DIR__ . "/connexion.php");

// Fonction pour récupérer les données depuis la base de données
function getFormDataFromDatabase() {
  
    global $conn;

    // récupérer toutes les données depuis la table 'address'
    $sql = "SELECT * FROM address";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Récupérez les résultats dans un tableau associatif
    $data_iterations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data_iterations;
}


// Fonction pour afficher les données sous forme de tableau HTML
function displayFormDataAsTable($data_iterations) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Itération</th>";
    echo "<th>Rue</th>";
    echo "<th>Numéro de Rue</th>";
    echo "<th>Type</th>";
    echo "<th>Ville</th>";
    echo "<th>Code postal</th>";
    echo "</tr>";

    foreach ($data_iterations as $iteration => $data_iteration) {
        echo "<tr>";
        echo "<td>$iteration</td>";
        echo "<td>" . htmlspecialchars($data_iteration['street']) . "</td>";
        echo "<td>" . htmlspecialchars($data_iteration['street_nb']) . "</td>";
        echo "<td>" . htmlspecialchars($data_iteration['type']) . "</td>";
        echo "<td>" . htmlspecialchars($data_iteration['city']) . "</td>";
        echo "<td>" . htmlspecialchars($data_iteration['zipcode']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Récupérez les données depuis la base de données
$data_iterations = getFormDataFromDatabase();
// Supposez que $current_iteration contient les données actuelles du formulaire
function afficherFormulaireAvecDonnees($current_iteration) {
    // Afficher le formulaire pré-rempli avec les données existantes
    echo '<form action="adresse.php?num_formulaires=' . $current_iteration['num_formulaires'] . '&current_iteration=' . $current_iteration['current_iteration'] . '" method="post">';
    echo '<input type="hidden" name="num_formulaires" value="' . $current_iteration['num_formulaires'] . '">';
    echo '<input type="hidden" name="current_iteration" value="' . $current_iteration['current_iteration'] . '">';

    echo '<label for="street">Rue:</label>';
    echo '<input type="text" id="street" name="street" maxlength="50" value="' . $current_iteration['street'] . '" required>';
    echo '<br>';

    echo'<label for="street_nb">Numéro de Rue:</label>
    <input type="number" id="street_nb" name="street_nb" required>
    <br>';
    echo'label for="type">Type:</label>
    <select id="type" name="type" maxlength="20" required>
        <option value="livraison">Livraison</option>
        <option value="facturation">Facturation</option>
        <option value="autre">Autre</option>
    </select>
    <br>';
    echo'<label for="city">Ville:</label>
    <select id="city" name="city" required>
        <option value="Montreal">Montréal</option>
        <option value="Laval">Laval</option>
        <option value="Toronto">Toronto</option>
        <option value="Quebec">Québec</option>
    </select>
    <br>';
    echo' <label for="zipcode">Code postal:</label>
    <input type="text" id="zipcode" name="zipcode" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" maxlength="7" required>
    <small>Format: A1A 1A1</small>
    <br><br>
    <input type="submit" value="Soumettre" name="envoyer" >
</form>';
    echo'';
    



    echo '<input type="submit" value="Soumettre" name="envoyer">';
    echo '</form>';
}

?>

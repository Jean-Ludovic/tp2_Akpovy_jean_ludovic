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
function afficherFormulaireAvecDonnees($donneesActuelles) {
    global $num_formulaires, $current_iteration;
    // Utilisez les données actuelles pour pré-remplir le formulaire
    // ...
    ?>
    <form action="adresse.php?num_formulaires=<?php echo $num_formulaires; ?>&current_iteration=<?php echo $current_iteration; ?>" method="post">
        <!-- ... Vos champs de formulaire pré-remplis ... -->
        <input type="submit" value="Modifier" name="modifier">
    </form>
    <?php
}
function afficherFormulaire() {
    global $num_formulaires, $current_iteration;
    ?>
    <form action="adresse.php?num_formulaires=<?php echo $num_formulaires; ?>&current_iteration=<?php echo $current_iteration; ?>" method="post">
        <!-- ... Vos champs de formulaire vides ... -->
        <input type="submit" value="Soumettre" name="envoyer">
    </form>
    <?php
}
function insererDonneesDansLaBase($num_formulaires, $current_iteration, $data_iterations) {
    global $conn;

    try {
        // Commencer une transaction
        $conn->beginTransaction();

        // Boucler à travers les itérations et insérer les données dans la base de données
        foreach ($data_iterations as $data_iteration) {
            // Vérifier si les données existent déjà dans la base de données
            if (!donneesExistantsDansLaBase($data_iteration)) {
                $street = $data_iteration['street'];
                $street_nb = $data_iteration['street_nb'];
                $type = $data_iteration['type'];
                $city = $data_iteration['city'];
                $zipcode = $data_iteration['zipcode'];

                // Insérer les données dans la table appropriée (ajustez cela en fonction de votre structure de base de données)
                $sql = "INSERT INTO `address` (`street`, `street_nb`, `type`, `city`, `zipcode`) VALUES (:street, :street_nb, :type, :city, :zipcode)";
                
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':street', $street);
                $stmt->bindParam(':street_nb', $street_nb);
                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':zipcode', $zipcode);

                $stmt->execute();
            }
        }

        // Valider la transaction
        $conn->commit();
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollBack();
        echo "Erreur d'insertion dans la base de données: " . $e->getMessage();
    }
}
function donneesExistantsDansLaBase($data_iteration) {
    global $conn;

    $street = $data_iteration['street'];
    $street_nb = $data_iteration['street_nb'];
    $type = $data_iteration['type'];
    $city = $data_iteration['city'];
    $zipcode = $data_iteration['zipcode'];

    $sql = "SELECT COUNT(*) FROM `address` WHERE `street` = :street AND `street_nb` = :street_nb AND `type` = :type AND `city` = :city AND `zipcode` = :zipcode";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':street_nb', $street_nb);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':zipcode', $zipcode);

    $stmt->execute();

    return $stmt->fetchColumn() > 0;
}

?>


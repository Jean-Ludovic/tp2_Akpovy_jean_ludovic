<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" type="text/css" href="../styles/boss.css">
</head>
<body>
    
</body>
</html>

<?php
require_once("../config/connexion.php");
require_once("../config/functions.php");

// Initialiser les variables
$num_formulaires = $current_iteration = 0;

// Vérifier si les données du formulaire sont disponibles
if (isset($_GET['num_formulaires']) && isset($_GET['current_iteration'])) {
    $num_formulaires = $_GET['num_formulaires'];
    $current_iteration = $_GET['current_iteration'];
}



// Maintenant, vous pouvez utiliser $num_formulaires et $current_iteration sans avertissements
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
</head>
<body>
    <h2>Confirmation</h2>

    <?php
    // Afficher les données du formulaire ou un message
    if (!empty($data_iterations)) {
        displayFormDataAsTable($data_iterations);
    } else {
        echo "<p>Aucune donnée soumise.</p>";
    }
    ?>
    <p>Merci pour votre soumission!</p><br>
    <p>Cela vous convient-il ?</p><br>
    
 
 <form action="modification.php" method="get">
    <input type="hidden" name="num_formulaires" value="<?php echo $num_formulaires; ?>">
    <input type="hidden" name="current_iteration" value="<?php echo $current_iteration; ?>">
    <input type="submit" name="modifier" value="Modifier">
</form>

<form action="affichage.php" method="post">
    <input type="submit" name="confirmer" value="Confirmer">
</form>


    
</body>
</html>

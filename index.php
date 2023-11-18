<?php
// index.php
require_once("config/connexion.php");

if (isset($_POST['num_formulaires'])) {
    $num_formulaires = $_POST['num_formulaires'];

    // Rediriger l'utilisateur vers la page adresse.php avec le nombre d'itérations
    header("Location: pages/adresse.php?num_formulaires=$num_formulaires&current_iteration=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h2>Bienvenue sur notre site</h2>

    <!-- Formulaire pour demander combien de fois l'utilisateur veut remplir le formulaire -->
    <form action="index.php" method="post">
        <label for="num_formulaires">Combien de fois souhaitez-vous remplir le formulaire ?</label>
        <input type="number" id="num_formulaires" name="num_formulaires" min="1" required>
        <input type="submit" value="Continuer">
    </form>
</body>
</html>

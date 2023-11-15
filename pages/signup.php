
<h2>Enregistrement </h2>
<a href="../index.php">Retour Acceuil</a>

<?php 
session_start();
// intialise ou reprend une session , permettant le stockage et la recuperation de valeurs a travers plusieurs pages
?>

<form method="post" action="../results/signupResult.php">

        <label for="user_name">Nom d'utilisateur :</label>
        <input type="text" id="user_name" name="user_name" 
        value="<?php echo isset($_SESSION["signup-form"] ["user_name"])? $_SESSION["signup-form"] ["user_name"]:"";  ?>">
        <br>
        <label for="email">Email   :  </label>
        <input type="email" id="email" name="email">
        <br>
        <label for="pwd">Mot de Passe :    </label>
        <input type="password" id="pwd" name="pwd">
        <br>
        <input type="submit" value="signup">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>
        <link rel="stylesheet" href="../styles/stylelogin.css">
</head>
<h2>Connexion</h2>
    <a href="../index.php">Retour Accueil</a>
    <br><br>
    <form method="post" action="../results/loginResult.php">
        <label for="user_name">Nom d'utilisateur :</label>
        <input type="text" id="user_name" name="user_name" required>
        <br><br>
        <label for="pwd">Mot de Passe :</label>
        <input type="password" id="pwd" name="pwd" >
        <br><br>
        <input type="submit" value="log in">
    </form>
</body>

</html>
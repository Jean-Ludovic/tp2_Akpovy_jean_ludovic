<!-- address_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Formulaire d'Adresse</title>
</head>
<body>
<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num_addresses'])) {
        $_SESSION['num_addresses'] = (int)$_POST['num_addresses'];
    }
    ?>

    <h2>Formulaire d'Adresse</h2>
    <form action="../pages/confirmation.php" method="post">
        <?php
        for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
            include 'address_fields.php';
        }
        ?>
        <button type="submit">Confirmer</button>
    </form>
</body>
</html>

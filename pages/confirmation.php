<!-- confirmation.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Confirmation</title>
</head>
<body>
<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num_addresses'])) {
        $_SESSION['num_addresses'] = (int)$_POST['num_addresses'];
    }
    ?>

    <h2>Confirmation des Adresses</h2>
    <ul>
        <?php
        for ($i = 1; $i <= $_SESSION['num_addresses']; $i++) {
            include 'confirmed_address.php';
        }
        ?>
    </ul>
    <a href="../pages/address_form.php">Modifier les informations</a>
</body>
</body>
</html>

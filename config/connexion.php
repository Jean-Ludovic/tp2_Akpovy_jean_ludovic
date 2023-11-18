<?php

//  les informations de connexion de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom1_tp2";
try{
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo"YOU ARE CONNECTED WITH ecom1_tp2 DATABASE";
}
catch(PDOException $e){
    echo"La connexion a echoue".$e->getMessage();
}
if(isset($_POST['envoyer'])) {
    $street = $_POST['street'];
    $street_nb = $_POST['street_nb'];
    $type = $_POST['type'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    $sql = "INSERT INTO `address` (`street`, `street_nb`, `type`, `city`, `zipcode`) VALUES (:street, :street_nb, :type, :city, :zipcode)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':street_nb', $street_nb);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':zipcode', $zipcode);

    $stmt->execute();
}



?>

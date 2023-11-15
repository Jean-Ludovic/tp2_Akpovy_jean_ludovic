<?php
require_once("../config/connexion.php");
require_once("../functions/validation.php");
require_once("../functions/userCrud.php");
session_start();



//Pour verifier que $_POST existe
if (isset($_POST)) {
    var_dump($_POST);
    unset($_SESSION );
    $_SESSION["signup-form"] = $_POST;
    echo"<br><br><br><br>";
    var_dump($_SESSION);
 
}
?>
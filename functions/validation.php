<?php
require_once("userCrud.php");
require_once("connexion.php");

function usernameIsValid(string $username): array
{
    $result = [
        'isValid' => true,
        'msg' => ''

    ];
    $userInDB = getUserByName($username);
    if (strlen($username) < 2) {
        //si le username est trop court
        $result = [
            'isValid' => false,
            'msg' => '<h2><center>ERROR!</center></H2>Le nom utilisé est trop court'

        ];
    } elseif (strlen($username) > 20) {
        //si le username est trop long

        echo '<br><br> Dans mon if strlen >20';
        echo strlen($username);  
        $result = [
            'isValid' => false,
            'msg' => '<h2><center>ERROR!</center></H2>Le nom utilisé est trop long'

        ];
    } elseif ($userInDB) {
        // si le username est deja utilise dans la bdd
        $result = [
            'isValid' => false,
            'msg' => '<h2><center>ERROR!</center></H2>Le nom est déjà utilisé!'

        ];
    }
    return $result;
}




?>
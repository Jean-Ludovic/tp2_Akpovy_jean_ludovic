<?php
function getUserByName(string $user_name)
{
    global $conn;
    $query = "SELECT * FROM user WHERE user.user_name = '" . $user_name."';";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

?>
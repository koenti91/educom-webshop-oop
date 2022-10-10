<?php

function findUserByEmail($email) {
    $file = fopen("users/users.txt", "r");
    $user = NULL;
    $line = fgets($file);

    while (!feof($file)) {
        $line = fgets($file);
        $parts = explode("|", $line);
        if ($parts[0] === $email) {
            $user = array("email" => trim($parts[0]), "name" => trim($parts[1]), "password" => trim($parts[2]));
        }
    }
    fclose($file);
    return $user;
}

function saveUser($name, $email, $password) {
    $file = fopen("users/users.txt", "a");
    $newUser = $email . '|' . $name . '|' . $password;
    fwrite($file, PHP_EOL . $newUser); 
    fclose($file);
}

?>
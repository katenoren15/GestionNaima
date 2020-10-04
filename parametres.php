<?php

    include_once "includes/login-class.php";
    $user = new Utilisateur();
    $uid = $_SESSION["uid"];

    if (isset($_POST["editname"])){
        $name = $user->escape_string($_POST["name"]);
        $user->updateName($name, $uid);
    }

    if (isset($_POST["edituser"])){
        $username = $user->escape_string($_POST["user"]);

        $user->updateUser($username,$uid);
    }

    if (isset($_POST["editpass"])){
        $newpass1 = $user->escape_string($_POST["newpass1"]);
        $newpass2 = $user->escape_string($_POST["newpass2"]);

        $user->updatePassword($newpass1, $newpass2, $uid);
    }

    if (isset($_POST["adduser"])){
        $nom = $user->escape_string($_POST["nom"]);
        $username = $user->escape_string($_POST["username"]);
        $password = $user->escape_string($_POST["password"]);
        $access = $user->escape_string($_POST["access"]);
        $user->addUser($nom, $username, $password, $access);

       
    }
    
?>

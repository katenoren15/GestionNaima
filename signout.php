<?php
    session_start();
    include "includes/login-class.php";
    $user = new Utilisateur();
    $user->user_logout();
    header('location:login.php');
?>
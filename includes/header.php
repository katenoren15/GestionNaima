<?php
/* Development and Debugging
error_reporting(E_ALL);
ini_set('display_errors', TRUE); */

include_once "login-class.php";
$user = new Utilisateur();
$uid = $_SESSION['uid'];
if (!$user->get_session()) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Naya Holding</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/iconic-bootstrap.css">
    <script src="jquery/jquery-3.4.1.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

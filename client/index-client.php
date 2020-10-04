<?php
session_start();

@$page = $_GET["page"];

include ('header.php');
switch (@$page){
    case "":
        include("home-client.php");
        break;
    case "tableau":
        include("home-client.php");
        break;
    case "clients":
        include ("clients.php");
        break;
    case "categories":
        include ("categories.php");
        break;
    case "rapports":
        include ("rapports.php");
        break; 
    case "parametres":
        include ("parametres.php");
        break;
}   


include ('../includes/footer.php');
?>
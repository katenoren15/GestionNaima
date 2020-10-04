<?php
session_start();

@$page = $_GET["page"];
include ('header.php');
switch (@$page){
    case "":
        include("home-prospect.php");
        break;
    case "tableau":
        include("home-prospect.php");
        break;
    case "prospects":
        include ("prospect.php");
        break;
    case "pipeline":
        include ("pipeline.php");
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
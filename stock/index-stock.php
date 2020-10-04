<?php
session_start();

@$page = $_GET["page"];

include ('header.php');
switch (@$page){
    case "":
        include("home-stock.php");
        break;
    case "tableau":
        include("home-stock.php");
        break;
    case "produits":
        include ("produits.php");
        break;
    case "marques-et-categories":
        include ("marques-categories.php");
        break;
    case "mouvements-produit":
        include ("mouvements.php");
        break;
    case "rapports":
        include ("rapports.php");
        break; 
}   


include ('includes/footer.php');
?>
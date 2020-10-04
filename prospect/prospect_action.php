<?php

    include_once "../includes/config.php";
    $crud2 = new Dbcon();
    include "classProspect.php";
    $prosp = new Prospect();

    if(isset($_POST["add"])){
        $nom = $crud2->escape_string($_POST["nom"]);
        $prenoms = $crud2->escape_string($_POST["prenoms"]);
        $email = $crud2->escape_string($_POST["email"]);
        $telephone = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $activite = $crud2->escape_string($_POST["activite"]);
        $exigence = $crud2->escape_string($_POST["exigence"]);
        $connaissance = $crud2->escape_string($_POST["connaissance"]);
        $achat = $crud2->escape_string($_POST["achat"]);
        $besoins = $crud2->escape_string($_POST["besoins"]);
        $prosp->addProspect($nom, $prenoms, $email, $telephone, $adresse, $activite, $exigence, 
        $connaissance, $achat, $besoins);
    }

    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $prosp->deleteProspect($id);
    }

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $nom = $crud2->escape_string($_POST["nom"]);
        $prenoms = $crud2->escape_string($_POST["prenoms"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $prosp->updateProspect($id, $nom, $prenoms, $email, $tel, $adresse);
    }

    if(isset($_POST["addo"])){
        $id = $_POST["id"];
        $date_obs = $_POST["date-obs"];
        $obs = $_POST["observation"];
        $prosp->addObservation($id, $date_obs, $obs);
    }

    if(isset($_POST["addv"])){
        $pid = $_POST["pid"];
        $vid = $_POST["id"];
        $date_visite = $_POST["date_visite"];
        $objet = $_POST["objet"];
        $resultats = $_POST["resultats"];
        $relance = $_POST["relance"];
        $date_relance = $_POST["date_relance"];
        $prosp->addVisite($vid, $pid, $date_visite, $objet, $resultats, $relance, $date_relance);
    }

    if(isset($_POST["edito"])){
        
    }
?>
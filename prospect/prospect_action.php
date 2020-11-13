<?php

    include_once "../includes/config.php";
    $crud2 = new Dbcon();
    include "classProspect.php";
    $prosp = new Prospect();

    if(isset($_POST["add"])){
        $nom = $crud2->escape_string($_POST["nom"]);
        $categorie = $crud2->escape_string($_POST["categorie"]);
        $email = $crud2->escape_string($_POST["email"]);
        $telephone = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $activite = $crud2->escape_string($_POST["activite"]);
        $exigence = $crud2->escape_string($_POST["exigence"]);
        $connaissance = $crud2->escape_string($_POST["connaissance"]);
        $achat = $crud2->escape_string($_POST["achat"]);
        $besoins = $crud2->escape_string($_POST["besoins"]);
        $prosp->addProspect($nom, $email, $telephone, $adresse, $categorie, $activite, $exigence, 
        $connaissance, $achat, $besoins);
    }

    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $prosp->deleteProspect($id);
    }

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $nom = $crud2->escape_string($_POST["nom"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $prosp->updateProspect($id, $nom, $email, $tel, $adresse);
    }

    if(isset($_POST["editprosp"])){
        $id = $crud2->escape_string($_POST["p_id"]);
        $nom = $crud2->escape_string($_POST["nom"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $cat = $crud2->escape_string($_POST["categorie"]);
        $conn = $crud2->escape_string($_POST["connaissance"]);
        $activite = $crud2->escape_string($_POST["activite"]);
        $achat = $crud2->escape_string($_POST["achat"]);
        $exigence = $crud2->escape_string($_POST["exigence"]);
        $besoins = $crud2->escape_string($_POST["besoins"]);
        $prosp->updateFullProspect($id, $nom, $email, $tel, $adresse, $cat, $activite, $exigence,
        $conn, $achat, $besoins);
    }

    if(isset($_POST["addo"])){
        $id = $_POST["id"];
        $date_obs = $_POST["date-obs"];
        $obs = $_POST["observation"];
        $prosp->addObservation($id, $date_obs, $obs);
    }

    if(isset($_POST["edito"])){
        $obs_id = $_POST["obsid"];
        $pid = $_POST["pid"];
        $date = $_POST["date_obs"];
        $obs = $_POST["observation"];
        $prosp->editObservation($date, $obs, $obs_id, $pid);
    }

    if(isset($_GET["deleteo"]) && isset($_GET["p"])){
        $oid = $_GET["deleteo"];
        $pid = $_GET["p"];
        $prosp->deleteObservation($oid, $pid);
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

    if(isset($_POST["editv"])){
        $pid = $_POST["pid"];
        $vid = $_POST["vid"];
        $date_visite = $_POST["date_visite"];
        $objet = $_POST["objet"];
        $resultats = $_POST["resultats"];
        $relance = $_POST["relance"];
        $date_relance = $_POST["date_relance"];
        $prosp->editVisite($vid, $pid, $date_visite, $objet, $resultats, $relance, $date_relance);
    }

    if(isset($_GET["deletev"]) && isset($_GET["p"])){
        $vid = $_GET["deletev"];
        $pid = $_GET["p"];
        $prosp->deleteVisite($vid, $pid);
    }

    if(isset($_GET["makeclient"])){
        $pid = $_GET["makeclient"];
        $prosp->makeClient($pid);
    }

?>
<?php

    include_once "../includes/config.php";
    $crud2 = new Dbcon();
    include "classClient.php";
    $client = new Client();

    if(isset($_POST["add"])){
        $nom = $crud2->escape_string($_POST["nom"]);
        $email = $crud2->escape_string($_POST["email"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $telephone = $crud2->escape_string($_POST["tel"]);
        $exigence = $crud2->escape_string($_POST["exigence"]);
        $besoin = $crud2->escape_string($_POST["besoins"]);
        $sit_fin = $crud2->escape_string($_POST["sit_fin"]);
        $pref = $crud2->escape_string($_POST["preference"]);
        $categorie = $crud2->escape_string($_POST["category"]);
        $client->addClient($nom, $email, $adresse, $telephone, $exigence, $besoin, $sit_fin, $pref, $categorie);
    }

    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $client->deleteClient($id);
    }

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $nom = $crud2->escape_string($_POST["nom"]);
        $prenoms = $crud2->escape_string($_POST["prenoms"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $client->updateClient($id, $nom, $prenoms, $email, $tel, $adresse);
    }

?>
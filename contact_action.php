<?php

    include_once "includes/config.php";
    $crud2 = new Dbcon();
    include "classContact.php";
    $contact = new Contact();

    if(isset($_POST["add"])){
        $nom = $crud2->escape_string($_POST["nom"]);
        $fonction = $crud2->escape_string($_POST["fonc"]);
        $email = $crud2->escape_string($_POST["email"]);
        $telephone = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $contact->addContact($nom, $fonction, $email, $telephone, $adresse);
    }

    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $contact->deleteContact($id);
    }

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $nom = $crud2->escape_string($_POST["nom"]);
        $fonction = $crud2->escape_string($_POST["fonc"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $contact->updateContact($id, $nom, $fonction, $email, $tel, $adresse);
    }

?>
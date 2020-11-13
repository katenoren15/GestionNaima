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
        $client->addClient($nom, $email, $telephone, $adresse, $categorie, $exigence, $besoin, $sit_fin, $pref);
    }

    if(isset($_GET["delete"])){
        $id = $_GET["delete"];
        $client->deleteClient($id);
    }

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $nom = $crud2->escape_string($_POST["nom"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $client->updateClient($nom, $email, $tel, $adresse, $id);
    }

    if(isset($_POST["editclient"])){
        $id = $crud2->escape_string($_POST["c_id"]);
        $nom = $crud2->escape_string($_POST["nom"]);
        $categorie = $crud2->escape_string($_POST["categorie"]);
        $email = $crud2->escape_string($_POST["email"]);
        $tel = $crud2->escape_string($_POST["tel"]);
        $adresse = $crud2->escape_string($_POST["adresse"]);
        $activite = $crud2->escape_string($_POST["activite"]);
        $sit_fin = $crud2->escape_string($_POST["sit_fin"]);
        $pref = $crud2->escape_string($_POST["pref"]);
        $exigence = $crud2->escape_string($_POST["exigence"]);
        $besoins = $crud2->escape_string($_POST["besoins"]);
        $client->updateFullClient($nom, $categorie, $email, $tel, $adresse, $activite, $exigence, $besoins, $pref, $sit_fin, $id);

    }

    if(isset($_POST["addcat"])){
        $catname = $_POST["catname"];
        $client->addClientCat($catname);
    }

    if(isset($_POST["updatecat"])){
        $id = $_POST["id"];
        $catname = $_POST["catname"];
        $client->updateClientCat($catname, $id);
    }

    if(isset($_GET["deletecat"])){
        $id = $_GET["deletecat"];
        $client->deleteClientCat($id);
    }

    if(isset($_GET["makeprospect"])){
        $pid = $_GET["makeprospect"];
        $client->makeProspect($pid);
    }

    if(isset($_POST["addo"])){
        $id = $crud2->escape_string($_POST["id"]);
        $date_obs = $crud2->escape_string($_POST["date-obs"]);
        $obs = $crud2->escape_string($_POST["observation"]);
        $client->addObservation($id, $date_obs, $obs);
    }

    if(isset($_POST["edito"])){
        $obs_id = $crud2->escape_string($_POST["obsid"]);
        $pid = $crud2->escape_string($_POST["pid"]);
        $date = $crud2->escape_string($_POST["date_obs"]);
        $obs = $crud2->escape_string($_POST["observation"]);
        $client->editObservation($date, $obs, $obs_id, $pid);
    }

    if(isset($_GET["deleteo"]) && isset($_GET["p"])){
        $oid = $_GET["deleteo"];
        $pid = $_GET["p"];
        $client->deleteObservation($oid, $pid);
    }

    if(isset($_POST["addachat"])){
        $cid = $crud2->escape_string($_POST["cid"]);
        $num_trans = $crud2->escape_string($_POST["num_trans"]);
        $date_trans = $crud2->escape_string($_POST["date_trans"]);
        $desc = $crud2->escape_string($_POST["desc"]);
        $total = $crud2->escape_string($_POST["total"]);
        $paye = $crud2->escape_string($_POST["paye"]);
        $restant = $crud2->escape_string($_POST["restant"]);
        $client->addAchat($num_trans, $cid, $date_trans, $desc, $total, $paye);
    }

    if(isset($_POST["editachat"])){
        $cid = $crud2->escape_string($_POST["cid"]);
        $num_trans = $crud2->escape_string($_POST["num_trans"]);
        $date_trans = $crud2->escape_string($_POST["date_trans"]);
        $desc = $crud2->escape_string($_POST["desc"]);
        $total = $crud2->escape_string($_POST["total"]);
        $paye = $crud2->escape_string($_POST["paye"]);
        $restant = $crud2->escape_string($_POST["restant"]);
        $client->updateAchat($num_trans, $cid, $date_trans, $desc, $total, $paye);
    }

    if(isset($_GET["deletea"]) && isset($_GET["c"])){
        $tid = $_GET["deletea"];
        $cid = $_GET["c"];
        $client->deleteAchat($tid, $cid);
    }

?>
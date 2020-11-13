<?php

    class Prospect {

        private $conn;

        function __construct(){
            include_once "../includes/config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addProspect($nom, $email, $telephone, $adresse, $categorie, $activite, $exigence, 
        $connaissance, $achat, $besoins){
            $crud = new Dbcon();
            $sql = "INSERT INTO `customer` (`nom`, `email`, `telephone`, `adresse`, `categorie`, `activite`, `exigence`, `connaissance`, `potentiel_achat`, `nature_besoins`, `customer_type`) VALUES ('$nom', '$email', '$telephone', '$adresse', '$categorie', '$activite',
            '$exigence', '$connaissance', '$achat', '$besoins', 'Prospect')";
            echo $sql;
            if($crud->run_query($sql)){
                header("location:index-prospect.php?page=prospects");
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:index-prospect.php?page=prospects");
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function deleteProspect($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM customer WHERE customer_id = '$id'";

            if($crud->run_query($sql)){
                header("location:index-prospect.php?page=prospects");
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index-prospect.php?page=prospects");
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function updateProspect($id, $nom, $email, $tel, $adresse){
            $crud = new Dbcon();

            $sql = "UPDATE customer SET nom= '$nom', email= '$email', telephone= '$tel', adresse= '$adresse' WHERE customer_id = '$id'";

            if($crud->run_query($sql)){
               $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
               $_SESSION["res_type"]="success";
               header("location:index-prospect.php?page=prospects");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:index-prospect.php?page=prospects");
            }
        }

        function updateFullProspect($id, $nom, $email, $telephone, $adresse, $categorie, $activite, $exigence,
        $connaissance, $achat, $besoins){
            $crud = new Dbcon();

            $sql = "UPDATE customer SET nom= '$nom', email= '$email', telephone= '$telephone', adresse= '$adresse', categorie = '$categorie', activite = '$activite', exigence = '$exigence', connaissance =
            '$connaissance', potentiel_achat = '$achat', nature_besoins = '$besoins' WHERE customer_id = '$id'";

            //echo $sql;
            if($crud->run_query($sql)){
               $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
               $_SESSION["res_type"]="success";
               header("location:viewprospect.php?id=" . $id);
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:viewprospect.php?id=" . $id);
            } 
        }

        function addObservation($id, $date_obs, $obs){
            $crud = new Dbcon();
            $sql = "INSERT INTO `customer_observation` (`customer_id`, `date_observation`, `observation`) VALUES ('$id', '$date_obs', '$obs')";
            if($crud->run_query($sql)){
                header("location:viewprospect.php?id=" . $id);
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:viewprospect.php?id=" . $id);
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function editObservation($date, $obs, $obs_id, $pid){
            $crud = new Dbcon();
            $sql = "UPDATE customer_observation SET date_observation = '$date', observation = '$obs' WHERE obs_id = $obs_id";
            if($crud->run_query($sql)){
                $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
                $_SESSION["res_type"]="success";
                header("location:viewprospect.php?id=" . $pid);
             }else{
                 $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                 $_SESSION["res_type"]="danger";
                 header("location:viewprospect.php?id=" . $pid);
             }
        }

        function deleteObservation($oid, $pid){
            $crud = new Dbcon();
            $sql = "DELETE FROM customer_observation WHERE obs_id = '$oid' AND customer_id = '$pid'";

            if($crud->run_query($sql)){
                header("location:viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function addVisite($vid, $pid, $date_visite, $objet, $resultats, $relance, $date_relance){
            $crud = new Dbcon();
            if(empty($date_relance)){
                $sql = "INSERT INTO visite (`visite_id`, `customer_id`, `date_de_visite`, `objet_visite`, `resultats`, `a_relancer`, `date_de_relance`) VALUES ('$vid', '$pid', '$date_visite', '$objet', '$resultats', '$relance', NULL)";
            }else{
                $sql = "INSERT INTO visite (`visite_id`, `customer_id`, `date_de_visite`, `objet_visite`, `resultats`, `a_relancer`, `date_de_relance`) VALUES ('$vid', '$pid', '$date_visite', '$objet', '$resultats', '$relance', '$date_relance')";
            }
            if($crud->run_query($sql)){
                header("location:viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function editVisite($vid, $pid, $date_visite, $objet, $resultats, $relance, $date_relance){
            $crud = new Dbcon();
            if(empty($date_relance)){
                $sql = "UPDATE visite SET visite_id = '$vid', date_de_visite = '$date_visite', objet_visite = '$objet', resultats = '$resultats', a_relancer = '$relance', date_de_relance =  NULL WHERE customer_id = '$pid' AND visite_id = '$vid' ";
            }else{
                $sql = "UPDATE visite SET visite_id = '$vid', date_de_visite = '$date_visite', objet_visite = '$objet', resultats = '$resultats', a_relancer = '$relance', date_de_relance =  '$date_relance' WHERE customer_id = '$pid' AND visite_id = '$vid' ";
            }
           
            //echo $sql;
            if($crud->run_query($sql)){
                $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
                $_SESSION["res_type"]="success";
                header("location:viewprospect.php?id=" . $pid);
             }else{
                 $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                 $_SESSION["res_type"]="danger";
                 header("location:viewprospect.php?id=" . $pid);
             }
        }

        function deleteVisite($vid, $pid){
            $crud = new Dbcon();
            $sql = "DELETE FROM visite WHERE visite_id = '$vid' AND customer_id = '$pid'";

            if($crud->run_query($sql)){
                header("location:viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function makeClient($pid){
            $crud = new Dbcon();
            $sql = "UPDATE customer SET customer_type = 'Client' WHERE customer_id = '$pid'";
            if($crud->run_query($sql)){
                header("location:../client/viewclient.php?id=" . $pid);
                $_SESSION["response"] = "Transform&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:../client/viewclient.php?id=" . $pid);
                $_SESSION["response"] = "La transformation a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }
    }

?>
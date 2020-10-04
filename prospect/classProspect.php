<?php

    class Prospect {

        private $conn;

        function __construct(){
            include_once "../includes/config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addProspect($nom, $prenoms, $email, $telephone, $adresse, $activite, $exigence, 
        $connaissance, $achat, $besoins){
            $crud = new Dbcon();
            $sql = "INSERT INTO `prospect` (`nom`, `prenoms`, `email`, `telephone`, `adresse`, `activite`, `exigence`, `connaissance`, `potentiel_achat`, `nature_besoins`) VALUES('$nom', '$prenoms', '$email', '$telephone', '$adresse', '$activite',
            '$exigence', '$connaissance', '$achat', '$besoins')";
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
            $sql = "DELETE FROM prospect Where prospect_id = '$id'";
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

        function updateProspect($id, $nom, $prenoms, $email, $tel, $adresse){
            $crud = new Dbcon();

            $sql = "UPDATE prospect SET nom= '$nom', prenoms= '$prenoms', email= '$email', telephone= '$tel', adresse= '$adresse' WHERE prospect_id = '$id'";

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

        function addObservation($id, $date_obs, $obs){
            $crud = new Dbcon();
            $sql = "INSERT INTO `prospect_observation` (`prospect_id`, `date_observation`, `observation`) VALUES ('$id', '$date_obs', '$obs')";
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

        function updateObservation($vid, $date_obs, $obs){
            $crud = new Dbcon();
            $sql = "UPDATE prospect_observation SET date_observation = '$vid', observation = '$date_obs' WHERE visite_id = $vid";
            
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

        function addVisite($vid, $pid, $date_visite, $objet, $resultats, $relance, $date_relance){
            $crud = new Dbcon();
            if(empty($date_relance)){
                $sql = "INSERT INTO visite (`visite_id`, `prospect_id`, `date_de_visite`, `objet_visite`, `resultats`, `a_relancer`, `date_de_relance`) VALUES ('$vid', '$pid', '$date_visite', '$objet', '$resultats', '$relance', NULL)";
            }else{
                $sql = "INSERT INTO visite (`visite_id`, `prospect_id`, `date_de_visite`, `objet_visite`, `resultats`, `a_relancer`, `date_de_relance`) VALUES ('$vid', '$pid', '$date_visite', '$objet', '$resultats', '$relance', '$date_relance')";
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
    }

?>
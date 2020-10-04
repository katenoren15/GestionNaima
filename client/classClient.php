<?php

    class Client {

        private $conn;

        function __construct(){
            include_once "../includes/config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addClient($nom, $email, $adresse, $telephone, $exigence, $besoin, $sit_fin, $pref, $categorie){
            $crud = new Dbcon();
            $sql = "INSERT INTO `client` (`nom`, `email`, `adresse`, `telephone`, `exigence`, `besoin`, `situation_financiere`, `preferences`, `client_cat_id`) VALUES ('$nom', '$email', '$adresse', '$telephone', '$exigence', '$besoin', '$sit_fin', '$pref', '$categorie')";
            echo $sql;
            if($crud->run_query($sql)){
                header("location:index-client.php?page=clients");
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:index-client.php?page=clients");
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function deleteClient($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM client WHERE client_id = '$id'";
            if($crud->run_query($sql)){
                header("location:index-client.php?page=clients");
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index-client.php?page=clients");
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
               header("location:index-client.php?page=clients");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:index-client.php?page=clients");
            }
            }
    }

?>
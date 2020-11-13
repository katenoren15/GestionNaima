<?php

    class Client {

        private $conn;

        function __construct(){
            include_once "../includes/config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addClient($nom, $email, $telephone, $adresse, $categorie, $exigence, $besoin, $sit_fin, $pref){
            $crud = new Dbcon();
            $sql = "INSERT INTO `customer`(`nom`, `email`, `telephone`, `adresse`, `categorie`, `exigence`, `nature_besoins`, `preferences`, `situation_financiere`, `customer_type`) VALUES  ('$nom', '$email', '$telephone', '$adresse', '$categorie', '$exigence', '$besoin', '$pref', '$sit_fin', 'Client')";
            //echo $sql;
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
            $sql = "DELETE FROM customer WHERE customer_id = '$id'";
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

        function updateClient($nom, $email, $tel, $adresse, $id){
            $crud = new Dbcon();

            $sql = "UPDATE customer SET nom = '$nom', email = '$email', telephone = '$tel', adresse = '$adresse'  WHERE customer_id = '$id'";

            //echo $sql;
            if($crud->run_query($sql)){
               $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
               $_SESSION["res_type"]="success";
               header("location:index-client.php?page=clients");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("index-client.php?page=clients");
            }
        }

        function updateFullClient($nom, $categorie, $email, $tel, $adresse, $activite, $exigence, $besoins, $pref, $sit_fin, $id){
            $crud = new Dbcon();

            $sql = "UPDATE customer SET nom= '$nom', email= '$email', telephone= '$tel', adresse= '$adresse', categorie = '$categorie', activite = '$activite', exigence = '$exigence', nature_besoins = '$besoins', preferences = '$pref', situation_financiere = '$sit_fin'  WHERE customer_id = '$id'";

            //echo $sql;
            if($crud->run_query($sql)){
               $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
               $_SESSION["res_type"]="success";
               header("location:viewclient.php?id=" . $id);
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:viewclient.php?id=" . $id);
            }
        }

        function addClientCat($catname){
            $crud = new Dbcon();
            $sql = "INSERT INTO `client_cat` (`client_cat_name`) VALUES ('$catname')";
            //echo $sql;
            if($crud->run_query($sql)){
                header("location:index-client.php?page=categories");
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:index-client.php?page=categories");
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function updateClientCat($catname, $id){
            $crud = new Dbcon();
            $sql = "UPDATE client_cat SET client_cat_name = '$catname' WHERE client_cat_id = '$id'";
            if($crud->run_query($sql)){
               $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
               $_SESSION["res_type"]="success";
               header("location:index-client.php?page=categories");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:index-client.php?page=categories");
            }
        }

        function deleteClientCat($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM client_cat WHERE client_cat_id = '$id'";
            if($crud->run_query($sql)){
                header("location:index-client.php?page=categories");
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index-client.php?page=categories");
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function makeProspect($pid){
            $crud = new Dbcon();
            $sql = "UPDATE customer SET customer_type = 'Prospect' WHERE customer_id = '$pid'";
            if($crud->run_query($sql)){
                header("location:../prospect/viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "Transform&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:../prospect/viewprospect.php?id=" . $pid);
                $_SESSION["response"] = "La transformation a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function addObservation($id, $date_obs, $obs){
            $crud = new Dbcon();
            $sql = "INSERT INTO `customer_observation` (`customer_id`, `date_observation`, `observation`) VALUES ('$id', '$date_obs', '$obs')";
            if($crud->run_query($sql)){
                header("location:viewclient.php?id=" . $id);
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:viewclient.php?id=" . $id);
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
                header("location:viewclient.php?id=" . $pid);
             }else{
                 $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                 $_SESSION["res_type"]="danger";
                 header("location:viewclient.php?id=" . $pid);
             }
        }

        function deleteObservation($oid, $pid){
            $crud = new Dbcon();
            $sql = "DELETE FROM customer_observation WHERE obs_id = '$oid' AND customer_id = '$pid'";

            if($crud->run_query($sql)){
                header("location:viewclient.php?id=" . $pid);
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:viewclient.php?id=" . $pid);
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function addAchat($num_trans, $cid, $date_trans, $desc, $total, $paye){
            $crud = new Dbcon();
            $restant = $total - $paye;
            $sql = "INSERT INTO client_account (transaction_id, customer_id, transaction_date, trans_desc, total, amount_paid, amount_left) VALUES 
            ('$num_trans', '$cid', '$date_trans', '$desc', '$total', '$paye', $restant)";

            if($crud->run_query($sql)){
                header("location:viewclient.php?id=" . $cid);
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:viewclient.php?id=" . $cid);
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function updateAchat($num_trans, $cid, $date_trans, $desc, $total, $paye){
            $crud = new Dbcon();
            $restant = $total - $paye;
            $sql = "UPDATE client_account SET transaction_date = '$date_trans', trans_desc = '$desc', total = '$total', amount_paid = '$paye', amount_left = '$restant' WHERE transaction_id = '$num_trans'";

            echo $sql;
            if($crud->run_query($sql)){
                header("location:viewclient.php?id=" . $cid);
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:viewclient.php?id=" . $cid);
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function deleteAchat($tid, $pid){
            $crud = new Dbcon();
            $sql = "DELETE FROM client_account WHERE transaction_id = '$tid'";

            if($crud->run_query($sql)){
                header("location:viewclient.php?id=" . $pid);
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:viewclient.php?id=" . $pid);
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }
    }

?>
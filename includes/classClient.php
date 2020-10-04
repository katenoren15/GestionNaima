<?php

    class Client{
        private $conn;

        function __construct(){
            include_once "config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function deleteClient($id){
            $crud = new Dbcon();

            $sql = "DELETE FROM client Where clientID = '$id'";
            if($crud->run_query($sql)){
                header("location:index1.php?page=clients");
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:index1.php?page=clients");
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function updateClient($fname, $lname, $phone, $email, $id){
            $crud = new Dbcon();

            $sql ="UPDATE client SET firstName= '$fname', lastName= '$lname', phoneNumber= '$phone', email= '$email' WHERE clientID = '$id'";

            if($crud->run_query($sql)){
                $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
                $_SESSION["res_type"]="success";
                header("location:index1.php?page=clients");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:index1.php?page=clients");
            }
        }
    }

?>
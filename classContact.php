<?php

    class Contact {

        private $conn;

        function __construct(){
            include_once "includes/config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addContact($nom, $fonction, $email, $telephone, $adresse){
            $crud = new Dbcon();
            $sql = "INSERT INTO `contact` (`nom_complet`, `fonction`, `email`, `telephone`, `adresse`) VALUES('$nom', '$fonction', '$email', '$telephone', '$adresse')";
            if($crud->run_query($sql)){
                header("location:contacts.php");
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:contacts.php");
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }

        function deleteContact($id){
            $crud = new Dbcon();
            $sql = "DELETE FROM contact WHERE id = '$id'";
            if($crud->run_query($sql)){
                header("location:contacts.php");
                $_SESSION["response"] = "Supprim&eacute; avec succès!";
                $_SESSION["res_type"] = "success";
            } else {
                header("location:contacts.php");
                $_SESSION["response"] = "La suppression a &eacute;chou&eacute;!";
                $_SESSION["res_type"] = "danger";
            }
        }

        function updateContact($id, $nom, $fonction, $email, $tel, $adresse){
            $crud = new Dbcon();

            $sql = "UPDATE contact SET nom_complet= '$nom', fonction= '$fonction', email= '$email', telephone= '$tel', adresse= '$adresse' WHERE id = '$id'";

            if($crud->run_query($sql)){
               $_SESSION["response"]= "Modifi&eacute; avec succ&egrave;s!";
               $_SESSION["res_type"]="success";
               header("location:contacts.php");
            }else{
                $_SESSION["response"]= "La modification a &eacute;chou&eacute;!";
                $_SESSION["res_type"]="danger";
                header("location:contacts.php");
            }
            }
    }

?>
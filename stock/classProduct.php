<?php

    class Product{

        private $conn;

        function __construct(){
            include_once "../includes/config.php";

            $crud = new Dbcon();

            $this->conn = $crud->connect();
        }

        function addProduct($codebarre, $category, $marque, $des, $prixvente, $refint, $refext, $collisage){
            $crud = new Dbcon();

            $sql = "INSERT INTO product (code_barre, product_cat_id, brand_id, designation, prix_de_vente, reference_interne, reference_externe, collisage) VALUES ('$codebarre', '$category', '$marque', '$des', '$prixvente', '$refint', '$refext', '$collisage')";
            if($crud->run_query($sql)){
                header("location:index-stock.php?page=produits");
                $_SESSION["response"] = "Ins&eacute;r&eacute; avec succ&egrave;s dans la base de donn&eacute;es";
                $_SESSION["res_type"] = "success";
            } else {
                $err = $crud->error($sql);
                header("location:index-stock.php?page=produits");
                $_SESSION["response"] = "&Eacute;chec de l&apos;insertion dans la base de donn&eacute;es " . $err;
                $_SESSION["res_type"] = "danger";
            }
        }
    }

?>
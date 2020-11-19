<?php

    include_once "../includes/config.php";
    $crud = new Dbcon();
    include "classProduct.php";
    $product = new Product();

    if(isset($_POST["addproduct"])){
        $codebarre = $crud->escape_string($_POST["code_barre"]);
        $category = $crud->escape_string($_POST["category"]);
        $des = $crud->escape_string($_POST["des"]);
        $marque = $crud->escape_string($_POST["marque"]);
        $prixvente = $crud->escape_string($_POST["prix_vente"]);
        $refint = $crud->escape_string($_POST["refint"]);
        $refext = $crud->escape_string($_POST["refext"]);
        $collisage = $crud->escape_string($_POST["collisage"]);
        $product->addProduct($codebarre, $category, $marque, $des, $prixvente, $refint, $refext, $collisage);
    }
?>
<?php
/* error_reporting (E_ALL);
ini_set('display_errors', TRUE); */
@$page = $_GET["page"];
    switch(@$page){
        case "":
            $index = "";
            $prospects = "";
            $pipeline = "";
            $rapports = "";
            $parametres = "";
            break;
        case "tableau":
            $index = "current";
            $prospects = "";
            $pipeline = "";
            $rapports = "";
            $parametres = "";
            break;
        case "prospects":
            $index = "";
            $prospects = "current";
            $pipeline = "";
            $rapports = "";
            $parametres = "";
            break;
        case "pipeline":
            $index = "";
            $prospects = "";
            $pipeline = "current";
            $rapports = "";
            $parametres = "";
            break;
        case "rapports":
            $index = "";
            $prospects = "";
            $pipeline = "";
            $rapports = "current";
            $parametres = "";
            break;
        case "parametres":
            $index = "";
            $prospects = "";
            $pipeline = "";
            $rapports = "";
            $parametres = "current";
            break;
    }
?>
<?php
include_once "../includes/login-class.php";
$user = new Utilisateur();
$uid = $_SESSION['uid'];
if (!$user->get_session()) {
    header('location:../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Prospects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/iconic-bootstrap.css">
    <script src="../jquery/jquery-3.4.1.js"></script>
    <script src="../jquery/jquery-ui.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
        .sidebar {
    height: 100vh;
    width: 230px;
    background-color:#FFB6C1;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: black;
}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <div class="container-fluid">
            <div class="row">
                <!--Side bar-->
                <!--Top Nav-->
                <div class="col-md-11 ml-auto top-bar fixed-top py-2 top-nav">
                    <div class="row align-item-center">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-2">
                            
                        </div>
                    </div>
                </div>
                <!--End of Top Nav-->
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                    <a href="index1.php?page=tableau" class="navbar-brand text-white font-weight-bold py-3 mb-4">Gestion des Prospects</a>
                    <div class="bottom-border">
                        <ul class="navbar navbar-nav justify-content-center">
                            <img src="../icons/person-fill.svg" width="30" class="rounded-circle"> 
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbardrop" data-toggle="dropdown">
                                    <?php $user->get_fullname($uid); ?>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../myaccount.php">Mon Compte</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#sign-out">Deconnexion</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav flex-column mt-4">
                        <li class="nav-item">
                            <a href="index-prospect.php?page=tableau" class="nav-link text-dark p-3 mb-2 <?php echo $index ?>"><img src="../icons/house.svg" width="25" class="text-white mr-3">Tableau de Bord</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-prospect.php?page=prospects" class="nav-link p-3 mb-2 text-dark sidebar-link <?php echo $prospects ?>"><img src="../icons/people-fill.svg" width="25" class="text-white mr-3">Prospects</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-prospect.php?page=pipeline" class="nav-link p-3 mb-2 text-dark sidebar-link <?php echo $pipeline ?>"><img src="../icons/funnel-fill.svg" width="25" class="text-white mr-3">Pipeline</a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="index-prospect.php?page=rapports" class="nav-link p-3 mb-2 text-dark sidebar-link <?php echo $rapports ?>"><img src="../icons/graph-up.svg" width="25" class="text-white mr-3">Rapports</a>
                        </li>-->
                        <li class="nav-item">
                        
                        </li>
                    </ul>
                        <a href="../modules.php" class="btn btn-danger mx-auto d-block"><img src="../icons/box-arrow-left.svg" width="25" class="text-white mr-3" class="text-danger"/>Page Module</a>
                </div>
                <!--End of side bar-->
                
            </div>
        </div>
    </div>
</nav>
   

                
<!--Signout Modal-->
<div class="modal fade" id="sign-out">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Déconnexion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Voulez-vous vous d&eacute;connecter?
            </div>
            <div class="modal-footer">
                <a href="../signout.php"><button type="button" class="btn btn-success">D&eacute;connexion</button></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

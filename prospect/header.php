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
            $reglages = "";
            break;
        case "tableau":
            $index = "current";
            $prospects = "";
            $pipeline = "";
            $rapports = "";
            $reglages = "";
            break;
        case "prospects":
            $index = "";
            $prospects = "current";
            $pipeline = "";
            $rapports = "";
            $reglages = "";
            break;
        case "pipeline":
            $index = "";
            $prospects = "";
            $pipeline = "current";
            $rapports = "";
            $reglages = "";
            break;
        case "rapports":
            $index = "";
            $prospects = "";
            $pipeline = "";
            $rapports = "current";
            $reglages = "";
            break;
        case "reglages":
            $index = "";
            $prospects = "";
            $pipeline = "";
            $rapports = "";
            $reglages = "current";
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
    <link href="../css/all.css" rel="stylesheet">
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
    background-color:#e3614d;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: black;
}
body {
    background-color:#FAF8F8;
}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light" >
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <div class="container-fluid">
            <div class="row">
                <!--Side bar-->
                <!--Top Nav-->
                <div class="col-md-11 ml-auto top-bar fixed-top top-nav" style="background-color:#e1998b; min-height:20px;">
                    <div class="row align-item-center">
                        <div class="col-md-4">
                        <a href="index-prospect.php?page=tableau" class="navbar-brand text-white font-weight-bold py-3">Gestion des Prospects</a>
                        </div>
                        <div class="col-md-6">
                        
                        </div>
                        <div class="col-md-2">
                        <ul class="navbar navbar-nav justify-content-center">
                            <img src="../icons/person-fill.svg" width="30" class="rounded-circle"> 
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
                                    <?php $user->get_fullname($uid); ?>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../myaccount.php">Mon Compte</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#sign-out">Deconnexion</a>
                                </div>
                            </li>
                        </ul> 
                        </div>
                    </div>
                </div>
                <!--End of Top Nav-->
                <div class="col-xl-1 col-lg-3 col-md-4 sidebar fixed-top">
                <a href="../modules.php" class="btn btn-warning text-center mt-3 mx-auto d-block"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                    <ul class="navbar-nav flex-column mt-5">
                        <li class="nav-item">
                            <a href="index-prospect.php?page=tableau" class="nav-link text-white text-center p-2 mb-4 <?php echo $index ?>"><i class="fas fa-clipboard" style="font-size:35px; color:black;"></i><br>Tableau de Bord</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-prospect.php?page=prospects" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $prospects ?>"><i class="fas fa-users" style="font-size:35px; color:black;"></i><br>Prospects</a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="index-prospect.php?page=pipeline" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $pipeline ?>"><i class="fas fa-filter" style="font-size:35px; color:black;"></i>Pipeline</a>
                        </li>-->
                        <li class="nav-item">
                            <a href="index-prospect.php?page=reglages" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $reglages ?>"><i class="fas fa-cog" style="font-size:35px; color:black;"></i>R&eacute;glages</a>
                        </li>
                        <!--<li class="nav-item">
                            <a href="index-prospect.php?page=rapports" class="nav-link p-3 mb-2 text-dark sidebar-link <?php echo $rapports ?>"><img src="../icons/graph-up.svg" width="25" class="text-white mr-3">Rapports</a>
                        </li>-->
                    </ul>
                      
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

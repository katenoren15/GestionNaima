<?php
/* Development and Debugging
error_reporting(E_ALL);
ini_set('display_errors', TRUE); */
@$page = $_GET["page"];
    switch(@$page){
        case "":
            $index = "";
            $produits = "";
            $marques = "";
            $mouvement = "";
            $rapports = "";
            break;
        case "tableau":
            $index = "current";
            $produits = "";
            $marques = "";
            $mouvement = "";
            $rapports = "";
            break;
        case "produits":
            $index = "";
            $produits = "current";
            $marques = "";
            $mouvement = "";
            $rapports = "";
            break;
        case "marques-et-categories":
            $index = "";
            $produits = "";
            $marques = "current";
            $mouvement = "";
            $rapports = "";
            break;
        case "mouvements-produits":
            $index = "";
            $produits = "";
            $marques = "";
            $mouvement = "current";
            $rapports = "";
            break;
        case "rapports":
            $index = "";
            $produits = "";
            $marques = "";
            $mouvement = "";
            $rapports = "current";
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
    <title>Stock | Naya Holding</title>
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
    background-color:#8ac063;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: black;
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
                <div class="col-md-11 ml-auto top-bar fixed-top top-nav" style="background-color:#abcf93; min-height:20px;">
                    <div class="row align-item-center">
                        <div class="col-md-4">
                        <a href="index-prospect.php?page=tableau" class="navbar-brand text-white font-weight-bold py-3">Gestion de Stock</a>
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
                            <a href="index-stock.php?page=tableau" class="nav-link text-white text-center p-2 mb-4 <?php echo $index ?>"><i class="fas fa-clipboard" style="font-size:35px; color:black;"></i><br>Tableau de Bord</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-stock.php?page=produits" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $produits ?>"><i class="fas fa-boxes" style="font-size:45px; color:black;"></i><br>Produits</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-stock.php?page=marques-et-categories" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $marques ?>"><i class="fas fa-tags" style="font-size:35px; color:black;"></i>Marques</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-stock.php?page=mouvements-produits" class="nav-link p-2 mb-4 text-white text-center sidebar-link <?php echo $mouvement ?>"><i class="fas fa-truck-loading" style="font-size:40px; color:black;"></i>Bons</a>
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


<!--<nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <div class="container-fluid">
            <div class="row">
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
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                    <div class="bottom-border pb-3">
                        <img src="icons/person-fill.svg" width="50" class="rounded-circle mr-3 ">
                        <a href="myaccount.php" class="text-white"><?php $user->get_fullname($uid); ?></a>
                    </div>
                    <nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <div class="container-fluid">
            <div class="row">
        
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                    <a href="index1.php?page=tableau" class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4">Gestion de Stock</a>
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
                            <a href="index-stock.php?page=tableau" class="nav-link text-dark p-3 mb-2 <?php echo $index ?>"><img src="../icons/house.svg" width="25" class="text-white mr-3">Tableau de Bord</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-stock.php?page=produits" class="nav-link text-dark p-3 mb-2 sidebar-link <?php echo $produits ?>"><img src="../icons/box-seam.svg" width="25" class="text-white mr-3">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a href="index-stock.php?page=marques" class="nav-link text-dark p-3 mb-2 sidebar-link <?php echo $marques ?>"><img src="../icons/patch-check-fll.svg" width="25" class="text-white mr-3">Marques</a>
                        </li>
                        <li class="nav-item">
                            <a href="index1.php?page=mouvements-produits" class="nav-link text-dark p-3 mb-2 sidebar-link <?php echo $mouvement ?>"><img src="../icons/arrows-move.svg" width="25" class="text-white mr-3">Bons</a>
                        </li>
                        <li class="nav-item">
                            <a href="index1.php?page=rapports" class="nav-link text-dark p-3 mb-2 sidebar-link <?php echo $rapport ?>"><img src="../icons/graph-up.svg" width="25" class="text-white mr-3">Rapports</a>
                        </li>
                    </ul>
                        <a href="../modules.php" class="btn btn-danger mx-auto d-block"><img src="../icons/box-arrow-left.svg" width="25" class="text-white mr-3" class="text-danger"/>Page Module</a>
                </div>
                End of side bar
            </div>
        </div>
    </div>
</nav>-->
<!-- end of nav bar -->
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
<!-- End of SignOut modal -->
<?php
include_once "config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM reservation";
$result = $crud2->read($sql);

$sql1 = "SELECT * FROM client";
$result1 = $crud2->read($sql1);

$sql2 = "SELECT * FROM apartment";
$result2 = $crud2->read($sql2);

?>
<!-- Add reservation modal -->
<script>
    $( document ).ready( function () {
        var oldNew = $('#live_form input:radio[name=old_new]');

        var clientID = $('#live_form select[name=clientid]');
        var info = $('#live_form #clientInfo');
        var all  = clientID.add(info);

        oldNew.change(function(){
            var value = this.value;
            all.addClass('d-none');

            if (value == "Oui)"{
                info.removeClass('d-none');
            } else {
                clientID.removeClass('d-none');
            }

        });
    });
</script>
<div class="modal fade" id="addres">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une R&eacute;servation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="reservation_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-group">
                        <label for="aptno">Choisissez l'appartement <span class="text-danger">*</span></label>
                        <select name="aptno" class="form-control" required>
                            <option value=" "> - - </option>
                            <?php
                            foreach($result2 as $key => $row){
                                echo "<option value='" . $row["apartmentNo"] ."'>Appartement ". $row["apartmentNo"]. "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Date d&apos;Arriv&eacute;e <span class="text-danger">*</span></label>
                        <input type="text" name="checkin" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="checkout">Date de D&eacute;part <span class="text-danger">*</span></label>
                        <input type="text" name="checkout" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="guests">Nombre de Personnes <span class="text-danger">*</span></label>
                        <input type="number" name="guests" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="doorcode">Code de la Porte <span class="text-danger">*</span></label>
                        <input type="text" name="doorcode" class="form-control" required/>
                    </div>
                        <div class="form-group">
                            <label class="control-label">
                                Est-ce un nouveau client? <span class="text-danger">*</span>
                            </label>
                            <div class="">
                                <div class="radio">
                                    <label class="radio">
                                        <input name="old-new" type="radio" value="Oui" required/>
                                        Oui
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="radio">
                                        <input name="old-new" type="radio" value="Non" />
                                        Non
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <div id="feedback_bad">
                                <div class="form-group ">
                                    <label for="fname">Pr&eacute;nom du Client <span class="text-danger">*</span></label>
                                    <input type="text" name="fname" class="form-control re"/>
                                </div>
                                <div class="form-group">
                                    <label for="lname">Nom de Famille du Client <span class="text-danger">*</span></label>
                                    <input type="text" name="lname" class="form-control re"/>
                                </div>
                                <div class="form-group">
                                    <label for="tel">Numéro de Téléphone du client <span class="text-danger">*</span></label>
                                    <input type="text" name="tel" class="form-control re"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail du Client</label>
                                    <input type="email" name="email" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label for="clientid">Choisissez le client <span class="text-danger">*</span></label>
                            <select class="form-control" name="clientid">
                                <option value=" "> - - </option>
                                <?php
                                foreach($result1 as $key => $row){
                                    echo "<option value='" . $row["clientID"] ."'>". $row["firstName"] . " ". $row["lastName"]. "</option>";
                                }
                                ?>
                            </select>
                        </div>

                    <script>
                        $( document ).ready(function() {
                            var rating = $('#live_form input:radio[name=old-new]');

                            //Wrappers for all fields
                            var bad = $('#live_form select[name="clientid"]').parent();
                            var ok = $('#live_form #feedback_bad').parent();
                            var great = $('#live_form textarea[name="feedback_great"]').parent();
                            var field = $('.re')
                            var all=bad.add(ok).add(great);

                            rating.change(function(){
                                var value=this.value;
                                all.addClass('d-none'); //hide everything and reveal as needed

                                if (value == 'Oui'){
                                    ok.removeClass('d-none');
                                    field.attr("required","required");
                                }
                                else if (value == 'Non'){
                                    bad.removeClass('d-none');
                                    field.removeAttr("required","required");
                                }
                            });

                        });

                    </script>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="add" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End -->

<script>
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        firstDay: 1,
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
            'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    });
</script>


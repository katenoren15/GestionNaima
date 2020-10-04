<?php
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();

    $client_id = $_GET["id"];
    $sql = "SELECT * FROM client WHERE client_id = $client_id";
    $result = $crud->get($sql);

    $sql1 = "SELECT * FROM client_account WHERE client_id = $client_id";
    $result1 = $crud->get($sql1);

    $sql2 = "SELECT * FROM client_observation WHERE client_id = $client_id";
    $result2 = $crud->get($sql2);


?>
<section>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-10 ml-auto">
                <div class="jumbotron pt-2 pb-2">
                    <h1><?php echo $result["nom"]; ?></h1> 
                    <p>Code Client: <?php echo $result["client_id"];?></p>
                    <p>Email: <?php echo $result["email"];?></p>
                    <p>Telephone: <?php echo $result["telephone"];?></p>
                    <p>Adresse: <?php echo $result["adresse"];?></p>
                    <p>Situation Financiere: <?php echo $result["situation_financiere"];?></p>
                    <a href="client_action.php?delete=<?= $result["client_id"]; ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce prospect?');">Supprimer</a>
                    <a href="client_action.php?update=<?= $prospect_id; ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce prospect?');">Modifier</a>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-5 ml-auto">
                <table class="table table-bordered">
                    <tr>
                        <td><h2>Exigences</h2></td>
                    </tr>
                    <tr>
                        <td><?php echo $result["exigence"];?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-5">
                <table class="table table-bordered">
                    <tr>
                        <td><h2>Besoins</h2></td>
                    </tr>
                    <tr>
                        <td><?php echo $result["besoins"];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-10 ml-auto">
                <h2>Observations</h2>
                <div class="text-right"><button type="button" class="button btn btn-primary" data-toggle="modal" data-modal="#addv">&plus; Observation</button></div>
            <table class="table table-bordered">
                    <tr>
                        <td>N&deg; Observation</td>
                        <td>Date d'Observation</td>
                        <td>Observation</td>
                        <td colspan="2">Actions</td>
                    </tr>
                    <?php foreach($result2 as $key => $row){ ?>
                    <tr>
                        <td><?php echo $result2["obs_id"];?></td>
                        <td><?php echo $result2["date_observation"];?></td>
                        <td><?php echo $result1["observation"];?></td>
                        <td><a href="viewclient.php?id=<?= $row["visite_id"]; ?>" class="btn btn-outline-info">Modifier</a></td>
                        <td><a href="viewclient.php?id=<?= $row["visite_id"]; ?>" class="btn btn-outline-danger">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-10 ml-auto">
                <h2>Historique d'achats</h2>
                <div class="text-right"><button type="button" class="button btn btn-primary" data-toggle="modal" data-modal="#addv">&plus; Achat</button></div>
            <table class="table table-bordered">
                    <tr>
                        <td>Visite</td>
                        <td>Date de Visite</td>
                        <td>Objet de Visite</td>
                        <td>Resultats</td>
                        <td>&Agrave; R&eacute;lancer</td>
                        <td>Date de R&eacute;lance</td>
                        <td colspan="2">Actions</td>
                    </tr>
                    <?php foreach($result1 as $key => $row){ ?>
                    <tr>
                        <td><?php echo $result1["visite_id"];?></td>
                        <td><?php echo $result1["date_de_visite"];?></td>
                        <td><?php echo $result1["objet_de_visite"];?></td>
                        <td><?php echo $result1["resultats"];?></td>
                        <td><?php echo $result1["a_relancer"];?></td>
                        <td><?php echo $result1["date_de_relance"];?></td>
                        <td><a href="viewclient.php?id=<?= $row["visite_id"]; ?>" class="btn btn-outline-info">Modifier</a></td>
                        <td><a href="viewclient.php?id=<?= $row["visite_id"]; ?>" class="btn btn-outline-danger">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</secion>
<div class="modal fade" id="addv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter une Visite</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
    
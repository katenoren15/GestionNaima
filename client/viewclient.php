<?php
session_start();
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();

    $client_id = $_GET["id"];
   // $_SESSION["prospect"] = $prospect_id;
    //$p_id = $_SESSION["p_id"];
    $sql = "SELECT * FROM customer, client_cat WHERE customer.categorie = client_cat.client_cat_id AND customer_id = $client_id";
    $result = $crud->get($sql);

    $sql1 = "SELECT * FROM client_account WHERE customer_id = $client_id ORDER BY transaction_date desc";
    $result1 = $crud->read($sql1);

    $sql2 = "SELECT * FROM customer_observation WHERE customer_id = $client_id ORDER BY date_observation desc";
    $result2 = $crud->read($sql2);


?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-11 ml-auto">
            <h2 class="text-center mt-2"><?php echo $result["nom"] . " " . $result["prenoms"] ?></h2> 
                <div class="jumbotron p-2 mt-3">
                    <div class="d-flex">
                        <div class="p-2"><img src="../images/avatar.jpg" class="float-left align-self-center"/></div>
                        <div class="p-2 flex-grow-1">
                            <table class="table table-sm">
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Code Client: </p></td><td class=""><?php echo $result["customer_id"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold"><p>Cat&eacute;gorie: </p></td><td class=""><?php echo $result["client_cat_name"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Email:</td><td class=""><?php echo $result["email"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>T&eacute;l&eacute;phone: </p></td><td class=""><?php echo $result["telephone"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Adresse: </p></td><td class=""><?php echo $result["adresse"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold col-4"><p>Activit&eacute;: </p></td><td class=""><?php echo $result["activite"];?></td>
                                </tr>  
                            </table>
                        </div>
                        <div class="p-2 flex-grow-1">
                            <table class="table table-sm">
                                <tr class="">
                                    <td class="font-weight-bold"><p>Situation Financi&egrave;re: </p></td><td class=""><?php echo $result["situation_financiere"];?></td>
                                </tr>
                            </table>
                            <div class="text-center">
                                <a class="btn btn-warning" href="edit.php?type=modifyclient&client=<?php echo $client_id; ?>">Modifier</a></br></br>
                                <a class="btn btn-success" href="client_action.php?makeprospect=<?= $result['customer_id']; ?>">Transformer en prospect</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <div class="d-flex flex-row ml-auto">
                    <div class="p-2 col-md-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-dark"><h2>Exigences</h2></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $result["exigence"];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-2 col-md-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-dark"><h2>Besoins</h2></th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $result["nature_besoins"];?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="p-2 col-md-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-dark"><h2>Pr&eacute;f&eacute;rences</h2></th>
                            </tr>
                        </thead>
                            <tr>
                                <td><?php echo $result["preferences"];?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-11 ml-auto">
            <nav class="navbar">
                <h3 class="">Observations</h3>
                <button class="btn btn-warning mt-1" data-toggle="modal" data-target="#addobs">&plus;&nbsp;Observation</button>
            </nav>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr class="d-flex">
                            <th class="col-2 text-dark">Date d'observation</th>
                            <th class="col-7 text-dark">Observation</th>
                            <th class="col-3 text-dark text-center" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <?php foreach($result2 as $key => $row){ ?>
                    <tr class="d-flex">
                        <td class="col-2"><?php echo $row["date_observation"];?></td>
                        <td class="col-7"><?php echo $row["observation"];?></td>
                        <td class="col"><a href="edit.php?type=modifyobs&obs=<?php echo $row["obs_id"];?>&p=<?= $client_id; ?>" class="btn btn-outline-primary">Modifier</a></td>
                        <td class="col"><a href="client_action.php?deleteo=<?php echo $row["obs_id"];?>&p=<?= $client_id; ?>" class="btn btn-outline-danger mx-auto d-block" onclick="return confirm('Voulez-vous supprimer cette observation?');">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table>
                    </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-md-11 ml-auto">
                <nav class="navbar">
                    <h3 class="">Historique d'achats</h3>
                    <form class="form-inline">
                        <input class="form-control border-warning mr-sm-2" type="search" id="tinput" placeholder="Recherche" aria-label="Search">
                    </form>
                    <button class="btn btn-warning mt-1" data-toggle="modal" data-target="#addachat">&plus;&nbsp;Achat</button>
                </nav>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-dark">N&deg; Transaction</th>
                            <th class="text-dark">Date de Transaction</th>
                            <th class="text-dark">Description</th>
                            <th class="text-dark">Total</th>
                            <th class="text-dark">Montant Pay&eacute;</th>
                            <th class="text-dark">Montant Restant</th>
                            <th class="text-dark text-center" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="transTable">
                    <?php foreach($result1 as $key => $row){ ?>
                        
                    <tr>
                        <td><?php echo $row["transaction_id"];?></td>
                        <td><?php echo $row["transaction_date"];?></td>
                        <td><?php echo $row["trans_desc"];?></td>
                        <td><?php echo $row["total"];?></td>
                        <td><?php echo $row["amount_paid"];?></td>
                        <td><?php echo $row["amount_left"];?></td>
                        <td><a href="edit.php?type=modifyachat&achat=<?= $row["transaction_id"];?>&client=<?php echo $client_id; ?>" class="btn btn-outline-primary editv">Modifier</a></td>
                        <td><a href="client_action.php?deletea=<?= $row["transaction_id"];?>&c=<?= $client_id; ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette transaction?');">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table> 
                <div class="text-center">
                    <a href="client_action.php?delete=<?= $result["customer_id"]; ?>" class="btn btn-danger mt-5 justify-content-center" onclick="return confirm('Voulez-vous supprimer ce client?');">Supprimer</a>
                </div>
            </div>
            
        </div>
       
    </div>
</secion>

<div class="modal fade" id="addobs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter une observation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                <input type="text" name="id" value="<?= $prospect_id;?>" hidden/>
                    <div class="form-group">
                        <label for="date-obs">Date d'Observation<span class="text-danger">*</span></label>
                        <input type="text" name="date-obs" class="form-control border-primary datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="observation">Observations<span class="text-danger">*</span></label>
                        <textarea type="text" name="observation" class="form-control border-primary" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="addo" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editobs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Modifier l'observation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="prospect_action.php" method="POST" id="live_form">
                <input type="text" value/>
                    <div class="form-group">
                        <label for="date-obs">Date d'Observation<span class="text-danger">*</span></label>
                        <input type="text" name="date-obs" id="date-obs" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="observation">Observations<span class="text-danger">*</span></label>
                        <textarea type="text" name="observation" id="observation" class="form-control" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="edito" class="btn btn-primary" value="Modifier"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addachat">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter un achat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                <input type="text" name="cid" id="cid" value="<?= $client_id;?>" hidden/>
                    <div class="form-row">
                        <div class="col">
                            <label for="num_trans">N&deg; Transaction <span class="text-danger">*</span></label>
                            <input type="number" name="num_trans" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="date_trans">Date de Transaction<span class="text-danger">*</span></label>
                            <input type="text" name="date_trans" class="form-control datepicker" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control"></textarea>
                        </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="total">Total<span class="text-danger">*</span></label>
                            <input type="text" name="total" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="paye">Montant Pay&eacute;<span class="text-danger">*</span></label>
                            <input type="text" name="paye" class="form-control" required/>
                        </div>
                    </div>
                    <br>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="addachat" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#tinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#transTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        firstDay: 1,
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
            'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    });
</script>
<script>
    $(document).ready( function() {
        $('.editobs').on('click', function () {

            $('#editobs').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#date-obs').val(data[0]);
            $('#observation').val(data[1]);
        });
    });
</script>
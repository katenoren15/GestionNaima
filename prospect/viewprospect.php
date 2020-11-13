<?php
session_start();
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();

    $prospect_id = $_GET["id"];
   // $_SESSION["prospect"] = $prospect_id;
    //$p_id = $_SESSION["p_id"];
    $sql = "SELECT * FROM customer, client_cat WHERE customer.categorie = client_cat.client_cat_id AND customer_id = $prospect_id";
    $result = $crud->get($sql);

    $sql1 = "SELECT * FROM visite WHERE customer_id = $prospect_id";
    $result1 = $crud->read($sql1);

    $sql2 = "SELECT * FROM customer_observation WHERE customer_id = $prospect_id ORDER BY date_observation";
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
                                    <td class="font-weight-bold col-4"><p>Code Prospect: </p></td><td class=""><?php echo $result["customer_id"];?></td>
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
                                    <td class="font-weight-bold"><p>Connaisance des Produits: </p></td><td class=""><?php echo $result["connaissance"];?></td>
                                </tr>
                                <tr class="">
                                    <td class="font-weight-bold"><p>Potentiel d'achat: </p></td><td class=""><?php echo $result["potentiel_achat"];?></td>
                                </tr>
                            </table>
                            <div class="text-center">
                                <a class="btn btn-warning" href="edit.php?type=modifyprosp&prospect=<?php echo $prospect_id; ?>">Modifier</a></br></br>
                                <a class="btn btn-success" href="prospect_action.php?makeclient=<?= $result['customer_id']; ?>">Transformer en client</a>
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
            <div class="col-md-6 ml-auto">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <td class="text-dark"><h2>Exigences</h2></td>
                        </tr>
                    </thead>
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
                        <td><?php echo $result["nature_besoins"];?></td>
                    </tr>
                </table>
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
                        <td class="col"><a href="edit.php?type=modifyobs&obs=<?php echo $row["obs_id"];?>&p=<?= $prospect_id; ?>" class="btn btn-outline-primary">Modifier</a></td>
                        <td class="col"><a href="prospect_action.php?deleteo=<?php echo $row["obs_id"];?>&p=<?= $prospect_id; ?>" class="btn btn-outline-danger mx-auto d-block" onclick="return confirm('Voulez-vous supprimer cette observation?');">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table>
                    </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-md-11 ml-auto">
                <nav class="navbar">
                    <h3 class="">Visites</h3>
                    <button class="btn btn-warning mt-1" data-toggle="modal" data-target="#addv">&plus;&nbsp;Visite</button>
                </nav>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-dark">N&deg; Visite</th>
                            <th class="text-dark">Date de Visite</th>
                            <th class="text-dark">Objet de Visite</th>
                            <th class="text-dark">Resultats</th>
                            <th class="text-dark">&Agrave; R&eacute;lancer</th>
                            <th class="text-dark">Date de R&eacute;lance</th>
                            <th class="text-dark text-center" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <?php foreach($result1 as $key => $row){ ?>
                    <tr>
                        <td><?php echo $row["visite_id"];?></td>
                        <td><?php echo $row["date_de_visite"];?></td>
                        <td><?php echo $row["objet_visite"];?></td>
                        <td><?php echo $row["resultats"];?></td>
                        <td><?php echo $row["a_relancer"];?></td>
                        <td><?php echo $row["date_de_relance"];?></td>
                        <td><a href="edit.php?type=modifyvisite&visite=<?= $row["visite_id"];?>&prospect=<?php echo $prospect_id; ?>" class="btn btn-outline-primary editv">Modifier</a></td>
                        <td><a href="prospect_action.php?deletev=<?= $row["visite_id"];?>&p=<?= $prospect_id; ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette visite?');">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table> 
                <div class="text-center">
                    <a href="prospect_action.php?delete=<?= $result["customer_id"]; ?>" class="btn btn-danger mt-5 justify-content-center" onclick="return confirm('Voulez-vous supprimer ce prospect?');">Supprimer</a>
                </div>
            </div>
            
        </div>
       
    </div>
</secion>
<div class="modal fade" id="editprosp">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Modifier un Prospect</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="prospect_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-row">
                        <div class="col">
                            <label for="nom">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control datepicker" required/>
                        </div>
                        <div class="col">
                            <label for="prenoms">Prenoms<span class="text-danger">*</span></label>
                            <input type="text" name="prenoms" class="form-control datepicker" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control"/>
                        </div>
                        <div class="col">
                            <label for="tel">T&eacute;l&eacute;phone<span class="text-danger">*</span></label>
                            <input type="text" name="tel" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" name="adresse" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="activite">Activit&eacute;<span class="text-danger">*</span></label>
                        <input type="text" name="activite" class="form-control" required/>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="control-label">
                                Connaissance des Produits <span class="text-danger">*</span>
                            </label>
                            <div class="">
                                <div class="radio">
                                    <label class="radio">
                                        <input name="connaissance" type="radio" value="Oui" required/>
                                        Oui
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="radio">
                                        <input name="connaissance" type="radio" value="Non" />
                                        Non
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label class="control-label">
                                Potentiel d'achat: <span class="text-danger">*</span>
                            </label>
                            <div class="">
                                <div class="radio">
                                    <label class="radio">
                                        <input name="achat" type="radio" value="Oui" required/>
                                        Oui
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="radio">
                                        <input name="achat" type="radio" value="Non" />
                                        Non
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="form-group">
                        <label for="besoins">Nature des Besoins</label>
                        <textarea name="besoins" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exigence">Exigences Particuli&egrave;res<span class="text-danger">*</span></label>
                        <textarea name="exigence" class="form-control" required></textarea>
                    </div>
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
<div class="modal fade" id="addobs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter une observation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="prospect_action.php" method="POST" id="live_form">
                <input type="text" name="id" value="<?= $prospect_id;?>" hidden/>
                    <div class="form-group">
                        <label for="date-obs">Date d'Observation<span class="text-danger">*</span></label>
                        <input type="text" name="date-obs" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="observation">Observations<span class="text-danger">*</span></label>
                        <textarea type="text" name="observation" class="form-control" required></textarea>
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
<div class="modal fade" id="addv">

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter une visite</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="prospect_action.php" method="POST" id="live_form">
                <input type="text" name="pid" id="pid" value="<?= $prospect_id;?>" hidden/>
                    <div class="form-group">
                        <label for="id">N&deg; Visite<span class="text-danger">*</span></label>
                        <input type="number" name="id" id="id" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="date_visite">Date de Visite<span class="text-danger">*</span></label>
                        <input type="text" name="date_visite" id="date_visite" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="objet">Objet de Visite<span class="text-danger">*</span></label>
                        <input type="text" name="objet" id="objet" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="resultats">R&eacute;sultats<span class="text-danger">*</span></label>
                        <textarea name="resultats" id="resultats" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="relance">&Agrave; R&eacute;lancer<span class="text-danger">*</span></label>
                        <div class="">
                                <div class="radio">
                                    <label class="radio">
                                        <input name="relance" type="radio" value="Oui" required/>
                                        Oui
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="radio">
                                        <input name="relance" type="radio" value="Non" />
                                        Non
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="date_relance">Date de R&eacute;lance</label>
                        <input type="date" name="date_relance" id="date_relance" class="form-control datepicker"/>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="addv" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
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
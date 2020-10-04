<?php
session_start();
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();

    $prospect_id = $_GET["id"];
    $_SESSION["prospect"] = $prospect_id;
    $p_id = $_SESSION["p_id"];
    $sql = "SELECT * FROM prospect, client_cat WHERE prospect.categorie = client_cat.client_cat_id AND prospect_id = $prospect_id";
    $result = $crud->get($sql);

    $sql1 = "SELECT * FROM visite WHERE prospect_id = $prospect_id";
    $result1 = $crud->read($sql1);

    $sql2 = "SELECT * FROM prospect_observation WHERE prospect_id = $prospect_id";
    $result2 = $crud->read($sql2);


?>
<section>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-10 ml-auto">
                <div class="jumbotron pt-2 pb-2">
                    <h1><?php echo $result["nom"] . " " . $result["prenoms"] ?></h1> 
                    <p>Code Prospect: <?php echo $result["prospect_id"];?></p>
                    <p>Cat&eacute;gorie: <?php echo $result["client_cat_name"];?></p>
                    <p>Email: <?php echo $result["email"];?></p>
                    <p>Telephone: <?php echo $result["telephone"];?></p>
                    <p>Adresse: <?php echo $result["adresse"];?></p>
                    <p>Activit&eacute;: <?php echo $result["activite"];?></p>
                    <p>Connaissance du produit: <?php echo $result["connaissance"];?></p>
                    <p>Potentiel d'achat: <?php echo $result["potentiel_achat"];?></p>
                    <button type="button" class="btn btn-outline-primary editbtn" value="<?= $row["prospect_id"]; ?>" data-toggle="modal" data-target="#editprosp">Modifier</button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
        <div class="row mt-3">
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
        <div class="row mt-3">
            <div class="col-md-10 ml-auto">
            <nav class="navbar">
                <h2 class="">Observations</h2>
                <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#addobs">&plus;&nbsp;Observation</button>
            </nav>
            <div class="table-responsive">
            <table class="table table-bordered">
                    <tr class="d-flex">
                        <th class="col-2">Date d'observation</th>
                        <th class="col-7">Observation</th>
                        <th class="col-3 text-center" colspan="2">Actions</th>
                    </tr>
                    <?php foreach($result2 as $key => $row){ ?>
                    <tr class="d-flex">
                        <td class="col-2"><?php echo $row["date_observation"];?></td>
                        <td class="col-7"><?php echo $row["observation"];?></td>
                        <td class="col"><button class="btn btn-outline-primary mx-auto d-block editobs" data-toggle="modal" data-target="#editobs">Modifier</button></td>
                        <td class="col"><a href="viewprospect.php?delete=<?= $p_id; ?>" class="btn btn-outline-danger mx-auto d-block" onclick="return confirm('Voulez-vous supprimer cette observation?');">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table>
                    </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-md-10 ml-auto">
                <nav class="navbar">
                    <h2 class="">Visites</h2>
                    <button class="btn btn-primary mt-1" data-toggle="modal" data-target="#addv">&plus;&nbsp;Visite</button>
                </nav>
                <table class="table table-bordered">
                    <tr>
                        <th>N&deg; Visite</th>
                        <th>Date de Visite</th>
                        <th>Objet de Visite</th>
                        <th>Resultats</th>
                        <th>&Agrave; R&eacute;lancer</th>
                        <th>Date de R&eacute;lance</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php foreach($result1 as $key => $row){ ?>
                    <tr>
                        <td><?php echo $row["visite_id"];?></td>
                        <td><?php echo $row["date_de_visite"];?></td>
                        <td><?php echo $row["objet_visite"];?></td>
                        <td><?php echo $row["resultats"];?></td>
                        <td><?php echo $row["a_relancer"];?></td>
                        <td><?php echo $row["date_de_relance"];?></td>
                        <td><a href="viewprospect.php?id=<?= $row["visite_id"]; ?>" class="btn btn-outline-info editv">Modifier</a></td>
                        <td><a href="viewprospect.php?id=<?= $row["visite_id"]; ?>" class="btn btn-outline-danger">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </table> <a href="prospect_action.php?delete=<?= $result["prospect_id"]; ?>" class="btn btn-outline-danger mt-5 mx-auto d-block" onclick="return confirm('Voulez-vous supprimer ce prospect?');">Supprimer</a>

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

    <div class="modal-dialog">
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
                        <input type="text" name="resultats" id="resultats" class="form-control" required/>
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
<?php
session_start();
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();


    if($_GET["type"] == "modifyprosp"){
        $prospect_id = $_GET["prospect"];
        $sql = "SELECT * FROM customer, client_cat WHERE customer.categorie = client_cat.client_cat_id AND customer_id = $prospect_id";
        $result = $crud->get($sql);
        $sql3 = "SELECT * FROM client_cat";
        $result3 = $crud->read($sql3);

?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3 mr-auto text-center">
            <a href="viewprospect.php?id=<?php echo $prospect_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
            </div>
            <div class="col-md-7 ml-auto">
                <h4 class="text-center mt-3">Modifier un Prospect</h4>
                <form action="prospect_action.php" method="POST">
                <input type="text" name="p_id" hidden value="<?php echo $result["customer_id"];?>"/>
                    <div class="form-row">
                        <div class="col">
                            <label for="nom">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $result['nom'];?>" required/>
                        </div>
                        <div class="col">
                            <label for="categorie">Cat&eacute;gorie <span class="text-danger">*</span></label>
                            <select class="form-control" name="categorie" required>
                                <?php 
                                    foreach ($result3 as $key => $row){
                                        if ($row["client_cat_id"] == $result["client_cat_id"]){
                                            echo "<option selected='selected' value='". $row["client_cat_id"]. "'>" . $row["client_cat_name"] . "</option>";
                                        } else{
                                            echo "<option value='". $row["client_cat_id"]. "'>" . $row["client_cat_name"] . "</option>";
                                        }
                                    }
                                ?>   
                            </select>
                           
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $result['email'];?>"/>
                        </div>
                        <div class="col">
                            <label for="tel">T&eacute;l&eacute;phone<span class="text-danger">*</span></label>
                            <input type="text" name="tel" class="form-control" value="<?php echo $result['telephone'];?>" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" name="adresse" class="form-control" value="<?php echo $result['adresse'];?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="activite">Activit&eacute;<span class="text-danger">*</span></label>
                        <input type="text" name="activite" class="form-control" value="<?php echo $result['activite'];?>" required/>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="control-label">
                                Connaissance des Produits <span class="text-danger">*</span>
                            </label>
                            <div>
                                <select class="form-control" name="connaissance">
                                    <?php 
                                        if($result['connaissance'] == "Oui"){
                                            echo "<option name='connaissance' value='Oui' selected>Oui</option> <option name='connaissance' value='Non'>Non</option>";
                                        }else{
                                            echo "<option name='connaissance' value='Non' selected>Non</option> <option name='connaissance' value='Oui'>Oui</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label class="control-label" for="achat">
                                Potentiel d'achat: <span class="text-danger">*</span>
                            </label>
                            <div class="">
                            <select class="form-control" name="achat">
                                    <?php 
                                        if($result['potentiel_achat'] == "Oui"){
                                            echo "<option name='achat' value='Oui' selected>Oui</option> <option name='achat' value='Non'>Non</option>";
                                        }else{
                                            echo "<option name='achat' value='Non' selected>Non</option> <option name='achat' value='Oui'>Oui</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exigence">Exigences Particuli&egrave;res<span class="text-danger">*</span></label>
                        <textarea name="exigence" class="form-control" required><?php echo $result['exigence'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="besoins">Nature des Besoins</label>
                        <textarea name="besoins" class="form-control"><?php echo $result['nature_besoins'];?></textarea>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
               
                <div class="form-group text-center">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editprosp" class="btn btn-primary" value="Modifier"/>
                </div>
                </form>
        </div>
            <div class="col-md-2 ml-auto"></div>
        </div>
    </div>
</section>

    <?php } 
     if($_GET["type"] == "modifyobs"){
        $prospect_id = $_GET["p"];
        $obs = $_GET["obs"];
        $sql = "SELECT * FROM customer_observation WHERE customer_id = '$prospect_id' AND obs_id = '$obs'";
        $result = $crud->get($sql);
    ?>
    <section>
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-3 mr-auto text-center">
                <a href="viewprospect.php?id=<?php echo $prospect_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                </div>
                <div class="col-md-7 mt-3 ml-auto">
                    <h4 class="text-center">Modifier l'observation</h4>
                    <form action="prospect_action.php" method="POST">
                        <input type="text" name="obsid" value="<?php echo $result['obs_id'];?>" hidden/>
                        <input type="text" name="pid" value="<?php echo $result['customer_id'];?>" hidden/>
                        <div class="form-group">
                            <label for="date_obs">Date d'Observation<span class="text-danger">*</span></label>
                            <input type="text" name="date_obs" id="date_obs" class="form-control datepicker" value="<?php echo $result['date_observation'];?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="observation">Observations<span class="text-danger">*</span></label>
                            <textarea type="text" name="observation" id="observation" class="form-control" required><?php echo $result['observation'];?></textarea>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <input type="reset" class="btn btn-danger" value="Annuler"/>
                                <input type="submit" name="edito" class="btn btn-primary" value="Modifier"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ml-auto"></div>
            </div>
        </div>
    </section>

    <?php }
    
    if($_GET["type"] == "modifyvisite"){ 
        $prospect_id = $_GET["prospect"];
        $visite = $_GET["visite"];
        $sql = "SELECT * FROM visite WHERE customer_id = $prospect_id AND visite_id = '$visite'";
        $result = $crud->get($sql);
        ?>
        <section>
            <div class="container-fluid">
                <div class="row mt-5">
                <div class="col-md-3 mr-auto text-center">
                    <a href="viewprospect.php?id=<?php echo $prospect_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                </div>
                <div class="col-md-7 mt-3 ml-auto">
                    <h4 class="text-center">Modifier une visite</h4>
                    <form action="prospect_action.php" method="POST">
                    <input type="text" name="pid" value="<?php echo $result['customer_id'];?>" hidden/>
                    <div class="form-group">
                        <label for="id">N&deg; Visite<span class="text-danger">*</span></label>
                        <input type="number" name="vid" id="vid" value="<?php echo $result['visite_id'];?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="date_visite">Date de Visite<span class="text-danger">*</span></label>
                        <input type="text" name="date_visite" id="date_visite" value="<?php echo $result['date_de_visite'];?>" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="objet">Objet de Visite<span class="text-danger">*</span></label>
                        <input type="text" name="objet" id="objet" class="form-control" value="<?php echo $result['objet_visite'];?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="resultats">R&eacute;sultats<span class="text-danger">*</span></label>
                        <textarea name="resultats" id="resultats" class="form-control" required><?php echo $result['resultats'];?>" required</textarea>
                    </div>
                    <div class="form-group">
                        <label for="relance">&Agrave; R&eacute;lancer<span class="text-danger">*</span></label>
                        <select class="form-control" name="relance">
                        <?php 
                            if($result['a_relancer'] == "Oui"){
                                echo "<option name='relance' value='Oui' selected>Oui</option> <option name='relance' value='Non'>Non</option>";
                            }else{
                                echo "<option name='relance' value='Non' selected>Non</option> <option name='relance' value='Oui'>Oui</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_relance">Date de R&eacute;lance</label>
                        <input type="date" name="date_relance" id="date_relance" value="<?php echo $result['date_de_relance'];?>" class="form-control datepicker"/>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
                    <div class="form-group text-center">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editv" class="btn btn-primary" value="Modifier"/>
                </div>
                </div>
                <div class="col-md-2"></div>
                
    </div>
            </div>
        </section>

    <?php } ?>

    <script>
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        firstDay: 1,
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
            'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    });
</script>
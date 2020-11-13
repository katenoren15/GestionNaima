<?php
session_start();
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();


    if($_GET["type"] == "modifyclient"){
        $client_id = $_GET["client"];
        $sql = "SELECT * FROM customer, client_cat WHERE customer.categorie = client_cat.client_cat_id AND customer_id = $client_id";
        $result = $crud->get($sql);
        $sql3 = "SELECT * FROM client_cat";
        $result3 = $crud->read($sql3);

?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3 mr-auto text-center">
            <a href="viewclient.php?id=<?php echo $client_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
            </div>
            <div class="col-md-7 ml-auto">
                <h4 class="text-center mt-3">Modifier un Client</h4>
                <form action="client_action.php" method="POST">
                <input type="text" name="c_id" hidden value="<?php echo $result["customer_id"];?>"/>
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
                            <label class="control-label" for="sit_fin">
                                Situation Financi&egrave;re<span class="text-danger">*</span>
                            </label>
                            <div>
                                <input type="text" name="sit_fin" class="form-control" value="<?php echo $result['situation_financiere'];?>" required/>
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
                    <div class="form-group">
                        <label for="pref">Preferences</label>
                        <textarea name="pref" class="form-control"><?php echo $result['nature_besoins'];?></textarea>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
               
                <div class="form-group text-center">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editclient" class="btn btn-primary" value="Modifier"/>
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
                <a href="viewclient.php?id=<?php echo $prospect_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                </div>
                <div class="col-md-7 mt-3 ml-auto">
                    <h4 class="text-center">Modifier l'observation</h4>
                    <form action="client_action.php" method="POST">
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
    
    if($_GET["type"] == "modifyachat"){ 
        $client_id = $_GET["client"];
        $achat = $_GET["achat"];
        $sql = "SELECT * FROM client_account WHERE customer_id = $client_id AND transaction_id = '$achat'";
        $result = $crud->get($sql);
        ?>
        <section>
            <div class="container-fluid">
                <div class="row mt-5">
                <div class="col-md-3 mr-auto text-center">
                    <a href="viewclient.php?id=<?php echo $client_id; ?>" class="btn btn-warning text-center mt-3"><i class="fas fa-arrow-alt-circle-left"></i><br></a>
                </div>
                <div class="col-md-7 mt-4 ml-auto">
                    <h4 class="text-center">Modifier un achat</h4>
                    <form action="client_action.php" method="POST">
                    <input type="text" name="cid" id="cid" value="<?= $client_id;?>" hidden/>
                    <div class="form-row">
                        <div class="col">
                            <label for="num_trans">N&deg; Transaction </label>
                            <input type="text" name="num_trans" class="form-control" value="<?php echo $result["transaction_id"];?>" readonly/>
                        </div>
                        <div class="col">
                            <label for="date_trans">Date de Transaction<span class="text-danger">*</span></label>
                            <input type="text" name="date_trans" class="form-control datepicker" value="<?php echo $result["transaction_date"];?>" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                            <label for="desc">Description</label>
                            <textarea name="desc" class="form-control"><?php echo $result["trans_desc"];?></textarea>
                        </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="total">Total<span class="text-danger">*</span></label>
                            <input type="text" name="total" class="form-control" value="<?php echo $result["total"];?>" required/>
                        </div>
                        <div class="col">
                            <label for="paye">Montant Pay&eacute;<span class="text-danger">*</span></label>
                            <input type="text" name="paye" class="form-control" value="<?php echo $result["amount_paid"];?>" required/>
                        </div>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
                    <div class="form-group text-center">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editachat" class="btn btn-primary" value="Modifier"/>
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
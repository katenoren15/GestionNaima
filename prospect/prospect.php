<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM customer, client_cat WHERE customer_type = 'Prospect' AND customer.categorie = client_cat.client_cat_id";
$result = $crud2->read($sql);
$results_per_page = 10;

$numRet = $crud2->numRows($sql);
$number_f_pages = ceil($numRet / $results_per_page);




$starting_limit_num = ($_GET["p"]-1)*$results_per_page;
$sql2 = "SELECT * FROM customer, client_cat WHERE customer.categorie = client_cat.client_cat_id LIMIT " . $starting_limit_num .',' . $results_per_page;
$result2 = $crud2->read($sql2);

$sql3 = "SELECT * FROM client_cat";
$result3 = $crud2->read($sql3);

?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <div class="jumbotron card-common pt-4 pb-4 mt-2" >
                    <h2>Prospects</h2>
                    <nav class="navbar">
                    <button class="btn btn-warning mt-1 navbar-brand" data-toggle="modal" data-target="#addprosp">&plus;&nbsp;Prospect</button>
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" style="border:1px solid #e3614d;" type="search" id="pinput" placeholder="Recherche" aria-label="Search">
                    </form>
                </nav>
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
        <div class="row mb-5">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">Code Prospect</th>
                                <th class="text-dark">Nom</th>
                                <th class="text-dark">Catégorie</th>
                                <th class="text-dark">Email</th>
                                <th class="text-dark">Téléphone</th>
                                <th class="text-dark">Adresse</th>
                                <th class="text-dark text-center" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="prospectTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["customer_id"];?></td>
                                <td><?= $row["nom"];?></td>
                                <td><?= $row["client_cat_name"];?></td>
                                <td><?= $row["email"];?></td>
                                <td><?= $row["telephone"];?></td>
                                <td><?= $row["adresse"];?></td>
                                <td class="text-center">
                                    <a href="viewprospect.php?id=<?= $row["customer_id"]; ?>" class="btn btn-warning">Voir</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning editbtn" value="<?= $row["customer_id"]; ?>" data-toggle="modal" data-target="#editprosp">Modifier</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <ul class="pagination">
        <?php
            for($b=1; $b<=$number_f_pages; $b++){
        ?>
        
            <li class="page-item"><a class="page-link" href=" "><?php echo $b ;?></a></li>
        <?php } ?>
            </ul>

    </div>
</section>
<div class="modal fade" id="addprosp">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter un Prospect</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="prospect_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-row">
                        <div class="col">
                            <label for="nom">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="categorie">Cat&eacute;gorie <span class="text-danger">*</span></label>
                            <select class="form-control" name="categorie" required>
                                <?php 
                                    foreach ($result3 as $key => $row){
                                        echo "<option value='". $row["client_cat_id"]. "'>" . $row["client_cat_name"] . "</option>";
                                    }
                                ?>   
                            </select>
                           
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control"/>
                        </div>
                        <div class="col">
                            <label for="tel">T&eacute;l&eacute;phone<span class="text-danger">*</span></label>
                            <input type="text" name="tel" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
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
<div class="modal fade" id="editprosp">

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Modifier le Prospect</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="prospect_action.php" method="POST" id="live_form">
                    <div class="form-group">
                        <label for="id">Code Propect<span class="text-danger">*</span></label>
                        <input type="text" name="id" id="id" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Cat&eacute;gorie<span class="text-danger">*</span></label>
                        <select class="form-control" name="categorie" id="categorie" required>
                            <?php 
                                foreach ($result3 as $key => $row){
                                    echo "<option value='". $row["client_cat_id"]. "'>". $row["client_cat_name"] . "</option>";
                                }
                            ?>  
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="tel">T&eacute;l&eacute;phone<span class="text-danger">*</span></label>
                        <input type="text" name="tel" id="tel" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" name="adresse" id="adresse" class="form-control" required/>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="update" class="btn btn-primary" value="Modifier"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#pinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#prospectTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function() {
        $('.editbtn').on('click', function () {

            $('#editprosp').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#nom').val(data[1]);
            $('#categorie').val(data[2]);
            $('#email').val(data[3]);
            $('#tel').val(data[4]);
            $('#adresse').val(data[5]);

        });
    });
</script>
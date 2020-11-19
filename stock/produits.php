<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM product, brand, product_cat WHERE brand.brand_id = product.product_id AND product_cat.product_cat_id = product.product_cat_id";
$result = $crud2->read($sql);

$sql2 = "SELECT * FROM product_cat";
$result2 = $crud2->read($sql2);

$sql3 = "SELECT * FROM brand";
$result3 = $crud2->read($sql3);

?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h1>Produits</h1>
                    <nav class="navbar">
                    <button class="btn btn-primary mt-1 navbar-brand" data-toggle="modal" data-target="#addclient">&plus;&nbsp;Produit</button>
                    <form class="form-inline">
                        <input class="form-control border-primary mr-sm-2" type="search" id="pinput" placeholder="Recherche" aria-label="Search">
                    </form>
                </nav>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">Code Barre</th>
                                <th class="text-dark">D&eacute;signation</a></th>
                                <th class="text-dark">Cat&eacute;gorie</th>
                                <th class="text-dark">Marque</th>
                                <th class="text-dark">Prix de vente</th>
                                <th class="text-dark">Reference Interne</th>
                                <th class="text-dark">Reference Externe</th>
                                <th class="text-dark">Collisage</th>
                                <th class="text-dark">Quantit&eacute;</th>
                                <th class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["code_barre"];?></td>
                                <td><?= $row["designation"];?></td>
                                <td><?= $row["product_cat_name"];?></td>
                                <td><?= $row["brand_name"];?></td>
                                <td><?= $row["prix_de_vente"];?></td>
                                <td><?= $row["reference_interne"];?></td>
                                <td><?= $row["reference_externe"];?></td>
                                <td><?= $row["collisage"];?></td>
                                <td><?= $row["quantite"];?></td>
                                <td class="text-center">
                                    <a href="viewclient.php?id=<?= $row["customer_id"]; ?>" class="btn btn-primary">Voir</a>
                        </br>
                                    <button type="button" class="btn btn-primary editbtn" value="<?= $row["customer_id"]; ?>" data-toggle="modal" data-target="#editclient">Modifier</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

    </div>
</section>
<div class="modal fade" id="addclient">

    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter un Produit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="product_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-row">
                        <div class="col">
                        <label for="code_barre">Code Barre<span class="text-danger">*</span></label>
                            <input type="text" name="code_barre" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="category">Cat&eacute;gorie <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required/>
                                <?php 
                                    foreach ($result2 as $key => $row){
                                        echo "<option value='". $row["product_cat_id"]. "'>" . $row["product_cat_name"] . "</option>";
                                    }
                                ?>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="des">D&eacute;signation <span class="text-danger">*</span></label>
                        <textarea name="des" class="form-control" required></textarea>
                    </div>
                    <div class="form-row mt-2">
                    <div class="col">
                            <label for="marque">Marque <span class="text-danger">*</span></label>
                            <select name="marque" class="form-control" required/>
                                <?php 
                                    foreach ($result3 as $key => $row){
                                        echo "<option value='". $row["brand_id"]. "'>" . $row["brand_name"] . "</option>";
                                    }
                                ?>   
                            </select>
                        </div>
                        <div class="col">
                            <label for="prix_vente">Prix de Vente <span class="text-danger">*</span></label>
                            <input type="text" name="prix_vente" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="ref_int">R&eacute;f&eacute;rence Interne<span class="text-danger">*</span></label>
                            <input type="text" name="ref_int" class="form-control"/>
                        </div>
                        <div class="col">
                            <label for="ref_ext">Reference Externe <span class="text-danger">*</span></label>
                            <input type="text" name="ref_ext" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="collisage">Collisage</label>
                        <input type="text" name="collisage" class="form-control"/>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="addproduct" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editproduct">

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Modifier le Client</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                    <div class="form-group">
                        <label for="id">Code Client<span class="text-danger">*</span></label>
                        <input type="text" name="id" id="id" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" required/>
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
    $("#productTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function() {
        $('.editbtn').on('click', function () {

            $('#editclient').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#nom').val(data[1]);
            $('#category').val(data[2]);
            $('#email').val(data[3]);
            $('#tel').val(data[4]);
            $('#adresse').val(data[5]);

        });
    });
</script>
<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM client_cat";
$result = $crud2->read($sql);

//$sql2 = "SELECT COUNT(*) AS num_in_cat, customer.categorie FROM customer, client_cat WHERE customer.customer_type = 'Client' AND customer.categorie = client_cat.client_cat_id GROUP BY client_cat.client_cat_id";
//$result2 = $crud2->read($sql2);
?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h2>Cat&eacute;gories Clients</h2>
                    <nav class="navbar">
                    <button class="btn btn-primary mt-1 navbar-brand" data-toggle="modal" data-target="#addclient">&plus;&nbsp;Cat&eacute;gorie</button>
                    <form class="form-inline">
                        <input class="form-control border-primary mr-sm-2" type="search" id="cinput" placeholder="Recherche" aria-label="Search">
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
                                <th class="text-dark">N&deg; Cat&eacute;gorie</th>
                                <th class="text-dark">Nom de cat&eacute;gorie</th>
                                <th class="text-dark">Nombre de Client</th>
                                <th class="text-center text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody id="clientTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td onclick="window.location='viewcategorie.php?cat=<?= $row["client_cat_id"] ?>'"><?= $row["client_cat_id"];?></td>
                                <td onclick="window.location='viewcategorie.php?cat=<?= $row["client_cat_id"] ?>'"><?= $row["client_cat_name"];?></td>
                                <td onclick="window.location='viewcategorie.php?cat=<?= $row["client_cat_id"] ?>'">
                                    <?= $row["num_in_cat"];?>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary editbtn" value="<?= $row["client_id"]; ?>" data-toggle="modal" data-target="#editclient">Modifier</button>
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

    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter une Cat&eacute;gorie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-row">
                        <div class="col">
                            <label for="catname">Nom de catégorie<span class="text-danger">*</span></label>
                            <input type="text" name="catname" class="form-control" required/>
                        </div>
                    </div>
                    <br>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="addcat" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editcat">

    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Modifier la Cat&eacute;gorie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                    <div class="form-group">
                        <label for="id">Code Cat&eacute;gorie<span class="text-danger">*</span></label>
                        <input type="text" name="id" id="id" class="form-control" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="catname">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="catname" id="catname" class="form-control" required/>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="updatecat" class="btn btn-primary" value="Modifier"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#cinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#clientTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function() {
        $('.editbtn').on('click', function () {

            $('#editcat').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#catname').val(data[1]);

        });
    });
</script>
<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM client_cat";
$result = $crud2->read($sql);
?>
<section>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4">
                    <h1>Cat&eacute;gories Clients</h1>
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
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><a class="column_sort" id="billNo" data-order="desc" href="#">N&deg; Cat&eacute;gorie</a></th>
                            <th><a class="column_sort" id="reservationNo" data-order="desc" href="#">Nom de cat&eacute;gorie</a></th>
                            <th><a class="column_sort" id="reservationNo" data-order="desc" href="#">Nombre de Client dans la categorie</a></th>
                            <th colspan="2" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="clientTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["client_cat_id"];?></td>
                                <td><?= $row["client_cat_name"];?></td>
                                <td class="text-center">
                                    <a href="viewclient.php?id=<?= $row["client_id"]; ?>" class="btn btn-outline-info">Voir</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-primary editbtn" value="<?= $row["client_id"]; ?>" data-toggle="modal" data-target="#editclient">Modifier</button>
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
                <h4 class="modal-title text-center">Ajouter un Client</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="client_action.php" method="POST" id="live_form">
                    <input type="hidden" name="id" />
                    <div class="form-row">
                        <div class="col">
                        <label for="nom">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="category">Cat&eacute;gorie <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required/>
                                <?php 
                                    foreach ($result2 as $key => $row){
                                        echo "<option value='". $row["client_cat_id"]. "'>" . $row["client_cat_name"] . "</option>";
                                    }
                                ?>   
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="tel">T&eacute;l&eacute;phone <span class="text-danger">*</span></label>
                            <input type="text" name="tel" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="adresse">Adresse <span class="text-danger">*</span></label>
                            <input type="text" name="adresse" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="sit_fin">Situation Financi&egrave;re <span class="text-danger">*</span></label>
                            <input type="text" name="sit_fin" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="preference">Pr&eacute;f&eacute;rences</label>
                        <textarea name="preference" class="form-control"></textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="besoins">Nature des Besoins</label>
                        <textarea name="besoins" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exigence">Exigences <span class="text-danger">*</span></label>
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
<div class="modal fade" id="editclient">

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
                        <label for="category">Cat&eacute;gorie <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control" required/>
                            <?php 
                                foreach ($result2 as $key => $row){
                                    echo "<option value='". $row["client_cat_id"]. "'>" . $row["client_cat_name"] . "</option>";
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
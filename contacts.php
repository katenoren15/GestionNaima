<?php
    include_once "includes/header.php";
    include_once "includes/config.php";
    $crud = new Dbcon();

    $sql = "SELECT * FROM contact";
    $result = $crud->read($sql);


?>
<section>
    <div class="container-fluid">
        
        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="jumbotron pt-4 pb-4">
                <a href="modules.php" class="btn text-white" style="background-color:#9370DB;"><img src="icons/box-arrow-left.svg" width="30" class="text-white mr-3" class="text-danger"/>Page Module</a>
                    <h1 class="text-center">Contacts</h1>
                    <nav class="navbar">
                        <button class="btn btn-primary mt-1 navbar-brand" data-toggle="modal" data-target="#addcontact">&plus;&nbsp;Contact</button>
                        <form class="form-inline">
                            <input class="form-control border-primary mr-sm-2" type="search" id="cinput" placeholder="Recherche" aria-label="Search">
                        </form>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-12 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
    <div class="row mb-5">
            <div class="col-sm-12">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>N&deg; Contact</th>
                            <th>Nom Complet</th>
                            <th>Fonction</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="contactTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["id"];?></td>
                                <td><?= $row["nom_complet"];?></td>
                                <td><?= $row["fonction"];?></td>
                                <td><a href="mailto:<?= $row["email"];?>"><?= $row["email"];?></a></td>
                                <td><?= $row["telephone"];?></td>
                                <td><?= $row["adresse"];?></td>
                                <td class="text-center">
                                <a href="contact_action.php?delete=<?= $row["id"]; ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce contact?');">Supprimer</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-primary editbtn" value="<?= $row["id"]; ?>" data-toggle="modal" data-target="#editcontact">Modifier</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
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
<div class="modal fade" id="addcontact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Ajouter un Contact</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="contact_action.php" method="POST" id="live_form">
                    <div class="form-group">
                        <label for="nom">Nom Complet<span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="fonc">Fonction<span class="text-danger">*</span></label>
                        <input type="text" name="fonc" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control datepicker" required/>
                    </div>
                    <div class="form-group">
                        <label for="tel">T&eacute;l&eacute;phone<span class="text-danger">*</span></label>
                        <input type="text" name="tel" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse<span class="text-danger">*</span></label>
                        <input type="text" name="adresse" class="form-control" required/>
                    </div>
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
</div>
<div class="modal fade" id="editcontact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Modifier un Contact</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="contact_action.php" method="POST" id="live_form">
                    <input type="text" name="id" id="id" class="form-control" hidden/>
                    <div class="form-group">
                        <label for="nom">Nom Complet<span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="fonc">Fonction<span class="text-danger">*</span></label>
                        <input type="text" name="fonc" id="fonc" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" required/>
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
</div>
<script>
$(document).ready(function(){
  $("#cinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#contactTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
    $(document).ready( function() {
        $('.editbtn').on('click', function () {

            $('#editcontact').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id').val(data[0]);
            $('#nom').val(data[1]);
            $('#fonc').val(data[2]);
            $('#email').val(data[3]);
            $('#tel').val(data[4]);
            $('#adresse').val(data[5]);

        });
    });
</script>
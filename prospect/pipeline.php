<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM prospect";
$result = $crud2->read($sql);
?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <h1 class="text-center">Pipeline</h1>
                <h4 class="text-center">(vue d'ensemble des prospection)</h4>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <div class="row">
                    <div class="col-xl-3 col-12 mb-4 mb-xl-0">
                        <div class="card card-commons" style="background-color: #ffd570">
                            <div class="card-body">
                                <h3 class="text-dark text-center mb-3">First Contact <span class="badge badge-secondary"><?= $numr; ?></span></h3>
                                <ul class="list-group">
                                    <?php
                                    if ($result6) {
                                        foreach($result6 as $key => $row){ ?>
                                            <a href="index1.php?page=reservations#<?= $row["reservationNo"];?>"><li class="list-group-item card-common">
                                                <img src="icons/person-fill.svg" class="float-left" width="50"/>
                                                <?php echo $row["lastName"] . " " . $row["firstName"] . "<br>Appartement " . $row["apartmentNo"];?>
                                                </li></a>
                                        <?php }
                                    } else { ?>
                                        <li class="list-group-item">Aucune arriv&eacute;es aujourd&apos;hui</li>
                                    <?php  }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12 mb-4 mb-xl-0">
                        <div class="card card-commons" style="background-color: #ffd570">
                            <div class="card-body">
                                <h3 class="text-dark text-center mb-3">Clients Enregistr&eacute;s <span class="badge badge-secondary"><?= $numq; ?></span></h3>
                                <ul class="list-group">
                                    <?php
                                    if ($result8) {
                                        foreach($result8 as $key => $row){ ?>
                                            <a href="index1.php?page=reservations#<?= $row["reservationNo"];?>"><li class="list-group-item card-common">
                                                <img src="icons/person-fill.svg" class="float-left" width="50"/>
                                                <?php echo $row["lastName"] . " " . $row["firstName"] . "<br>Appartement " . $row["apartmentNo"] ?>
                                            </li></a>
                                        <?php }
                                    } else { ?>
                                        <li class="list-group-item">Aucun client enregistr&eacute; aujourd&apos;hui</li>
                                    <?php  }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12 mb-4 mb-xl-0">
                        <div class="card card-commons" style="background-color: #ffd570">
                            <div class="card-body">
                                <h3 class="text-dark text-center mb-3">D&eacute;parts <span class="badge badge-secondary"><?= $num; ?></span></h3>
                                <ul class="list-group">
                                    <?php
                                    if ($result5) {
                                        foreach($result5 as $key => $row){ ?>
                                    <a href="index1.php?page=reservations#<?= $row["reservationNo"];?>"><li class="list-group-item card-common">
                                                <img src="icons/person-fill.svg" class="float-left" width="50"/>
                                                <?php echo $row["lastName"] . " " . $row["firstName"] . "<br>Appartement " . $row["apartmentNo"] ?>
                                        </li></a>
                                        <?php }
                                    } else { ?>
                                        <li class="list-group-item">Aucun d&eacute;parts aujourd&apos;hui</li>
                                    <?php  }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12 mb-4 mb-xl-0">
                        <div class="card card-commons" style="background-color: #ffd570">
                            <div class="card-body">
                                <h3 class="text-dark text-center mb-3">Placed order<span class="badge badge-secondary"><?= $num; ?></span></h3>
                                <ul class="list-group">
                                    <?php
                                    if ($result5) {
                                        foreach($result5 as $key => $row){ ?>
                                    <a href="index1.php?page=reservations#<?= $row["reservationNo"];?>"><li class="list-group-item card-common">
                                                <img src="icons/person-fill.svg" class="float-left" width="50"/>
                                                <?php echo $row["lastName"] . " " . $row["firstName"] . "<br>Appartement " . $row["apartmentNo"] ?>
                                        </li></a>
                                        <?php }
                                    } else { ?>
                                        <li class="list-group-item">Aucun d&eacute;parts aujourd&apos;hui</li>
                                    <?php  }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="addprosp">

    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="editprosp">

    <div class="modal-dialog">
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
                        <label for="prenoms">Prenoms<span class="text-danger">*</span></label>
                        <input type="text" name="prenoms" id="prenoms" class="form-control" required/>
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
            $('#prenoms').val(data[2]);
            $('#email').val(data[3]);
            $('#tel').val(data[4]);
            $('#adresse').val(data[5]);

        });
    });
</script>
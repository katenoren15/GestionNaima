<?php

    session_start();
    include_once "header.php";
    include_once "../includes/config.php";
    $crud = new Dbcon();

    $catid = $_GET["cat"];
    $sql = "SELECT * FROM customer, client_cat WHERE customer.categorie = '$catid' AND customer.categorie = client_cat.client_cat_id";
    $result = $crud->read($sql);
    $sql2 = "SELECT * FROM client_cat WHERE client_cat_id = '$catid'";
    $result2 = $crud->get($sql2);


?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h2><?= $result2["client_cat_name"]?></h2>
                    <nav class="navbar">

                        <form class="form-inline">
                            <input class="form-control border-primary mr-sm-2 float-right" type="search" id="cinput" placeholder="Recherche" aria-label="Search">
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
                                <th class="text-dark">Code Client</th>
                                <th class="text-dark">Nom</a></th>
                                <th class="text-dark">Email</th>
                                <th class="text-dark">Téléphone</th>
                                <th class="text-dark">Adresse</th>
                                <th colspan="2" class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="clientTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["customer_id"];?></td>
                                <td><?= $row["nom"];?></td>
                                <td><?= $row["email"];?></td>
                                <td><?= $row["telephone"];?></td>
                                <td><?= $row["adresse"];?></td>
                                <td class="text-center">
                                    <a href="viewclient.php?id=<?= $row["customer_id"]; ?>" class="btn btn-primary">Voir</a>
                                </td>
                                <td class="text-center">
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

        <div class="text-center">
            <a href="client_action.php?deletecat=<?= $result2["client_cat_id"]; ?>" class="btn btn-danger mt-5 justify-content-center" onclick="return confirm('Voulez-vous supprimer cette categorie?');">Supprimer</a>
        </div>
    </div>
</section>
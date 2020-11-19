<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();

$sql = "SELECT * FROM product_cat";
$result = $crud2->read($sql);

$sql2 = "SELECT * FROM brand";
$result2 = $crud2->read($sql2);

?>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-9 col-md-8 ml-auto">
                <div class="jumbotron pt-4 pb-4 mt-3">
                    <h1>Marques et Cat&eacute;gories</h1>
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
            <div class="col-5 ml-auto">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">Code Barre</th>
                                <th class="text-dark">D&eacute;signation</a></th>
                                <th class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["code_barre"];?></td>
                                <td><?= $row["designation"];?></td>
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
            <div class="col-md-5">
                <div class="table-responsive" id="result">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-dark">Code Barre</th>
                                <th class="text-dark">D&eacute;signation</a></th>
                                <th class="text-center text-dark">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                        <?php foreach($result as $key => $row){ ?>
                            <tr>
                                <td><?= $row["code_barre"];?></td>
                                <td><?= $row["designation"];?></td>
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
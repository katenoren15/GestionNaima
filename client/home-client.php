<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();


$sql = "SELECT COUNT(*) as clients FROM customer WHERE customer_type = 'Client'";
$result = $crud2->get($sql);

$sql2 = "SELECT COUNT(*) as visite FROM visite WHERE date_de_visite = CURRENT_DATE()";
$result2 = $crud2->get($sql2);

?>
<section>
    <div class="container-fluid">
    <div class="row mt-5">
            <div class="col-md-11 ml-auto">
                <br>
                <h2 class="text-dark text-sm-center">Tableau de Bord</h2>
                <div class="text-right"></div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-11 ml-auto">
                <div class="card-deck">
                    <div class="card bg-primary">
                        <div class="card-body text-center">
                        <img src="../icons/people-fill.svg" width="70"/>
                            <div class="text-dark">
                                <h5>Nombre de Client</h5>
                                <h2><?= $result["clients"]; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-warning">
                        <div class="card-body text-center">
                        <p class="card-text">Commande a traiter</p>
                        </div>
                    </div>
                    <div class="card bg-success">
                        <div class="card-body text-center">
                        <p class="card-text">Total amount of transactions made in the last week</p>
                        </div>
                    </div>
                    <div class="card bg-danger">
                        <div class="card-body text-center">
                        <p class="card-text">Some text inside the fourth card</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
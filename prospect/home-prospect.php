<?php
include_once "../includes/config.php";
$crud2 = new Dbcon();


$sql = "SELECT COUNT(*) as prospects FROM customer WHERE customer_type = 'Prospect'";
$result = $crud2->get($sql);

$sql2 = "SELECT COUNT(*) as visite FROM visite WHERE date_de_visite = CURRENT_DATE()";
$result2 = $crud2->get($sql2);

$sql3 = "SELECT COUNT(*) as new_prosp FROM customer WHERE customer_type = 'Prospect' AND MONTH(insert_date) = MONTH(CURRENT_DATE())";
$result3 = $crud2->get($sql3);

?>
<style>
    #calendar{
        table-layout: fixed;
    }
    td{
        width: 33%;
    }
    .today{
        background: rgba(172, 172, 172, 0.49);
    }

</style>
<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-11 ml-auto">
                <br>
                <h2 class="text-dark">Tableau de Bord</h2>
                <div class="text-right"></div>
            </div>
        </div>
        <div class="row mt-2">
        <div class="col-xl-1 col-sm-1 col-md-1"></div>
            <div class="col-xl-7 col-sm-7 col-md-7 ml-4">
                 <div class="card card-common">
                    <div class="card-body" >
                        <div class="">
                            <?php
                                    include_once ("../includes/calendar.php");
                                    $cal = new Calendar();
                                    $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year'])){
                                $month = $_GET['month'];
                                $year = $_GET['year'];
                            }else{
                                $month = $dateComponents['mon'];
                                $year = $dateComponents['year'];
                            }
                                    echo $cal->build_calendar($month, $year);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" d-flex flex-md-fill flex-column col-xl-3 col-sm-3 col-md-3">
            <div class="mx-auto d-block">
                    <div class="card bg-primary mb-4 card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <img src="../icons/people-fill.svg" width="70" class="float-left"/>
                                <div class="text-right text-dark">
                                    <h5>Nombre de Prospects</h5>
                                    <h2><?= $result["prospects"]; ?></h2>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="card bg-warning mb-3 card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i style="font-size:70px;" class="fas fa-car"></i>
                                <div class="text-right text-dark">
                                    <h5>Nombre de Visites aujourd'hui </h5>
                                    <h2><?= $result2["visite"]; ?></h2>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="card bg-success card-common">
                    <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i style="font-size:70px;" class="fas fa-dollar-sign"></i>
                                <div class="text-right text-dark">
                                    <h5>Nombre de prospect gagn&eacute; dans le mois</h5>
                                    <h2><?= $result3["new_prosp"]; ?></h2>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        
</section>
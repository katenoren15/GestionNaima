
<style>
    #settings{
        font-size: 14pt;
    }
    body {
                background:url("images/17580.jpg") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
</style>

<section>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-11 col-lg-11 col-md-11 ml-auto">
                <div class="pb-4 mt-4" >
                    <h2 class="text-center">R&eacute;glages</h2>
                </nav>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-11 ml-auto">
                <?php if(isset($_SESSION["response"])){ ?>
                    <div class="alert text-center alert-<?= $_SESSION["res_type"]; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b><?= $_SESSION["response"];?></b>
                    </div>
                <?php } unset($_SESSION["response"]); ?>
            </div>
        </div>
            <br><br>
            <div class="row mb-5">
                <div class="col-md-2 ml-auto"></div>
                <div class="col-md-8 ml-auto">
                    <div class="border rounded shadow-lg p-4 mb-4 bg-white">
                        <h4>Profil</h4><br>
                        <table class="table border-bottom">
                            <tr>
                                <td class="text-muted">Nom Complet</td><td id="settings"><?php $user->get_fullname($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#editname">Modifier</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nom d&apos;Utilisateur</td><td id="settings"><?php $user->get_username($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#edituser">Modifier</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Mot de Passe</td><td id="settings"><?php $user->get_password($uid); ?></td> <td><button class="btn btn-warning" data-toggle="modal" data-target="#editpass">Modifier</button></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Niveau d'Acc&egrave;s</td><td id="settings"><?php $user->get_access_level($uid); ?></td> <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-2 ml-auto"></div>
            </div>
            <div class="row mb-5">
                <div class="col-md-2 ml-auto"></div>
                <div class="col-md-8 ml-auto">
                    <div class="border rounded shadow-lg p-4 mb-4 bg-white">
                        <h4 class="text-center">Actions</h4><br><hr>
                        <button class="btn btn-success" data-toggle="modal" data-target="#addu">Ajouter un Utilisateur</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#">Add an access level</button>
                    </div>
                </div>
                <div class="col-md-2 ml-auto"></div>
            </div>
        </div>
    </section>
<div class="modal fade" id="editname">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier ton nom</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="parametres.php" method="POST">
                    <div class="form-group">
                        <label for="name">Entrez le nouveau nom <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editname" class="btn btn-primary" value="Modifier"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edituser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier ton nom d'utilisateur</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="parametres.php" method="post">
                    <div class="form-group">
                        <label for="user">Entrez le nouveau nom d'utilisateur <span class="text-danger">*</span></label>
                        <input type="text" name="user" class="form-control">
                    </div>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="edituser" class="btn btn-primary" value="Modifier"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editpass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier ton mot de passe</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="parametres.php" method="post">
                    <div class="form-group">
                        <label for="newpass1">Entrez le nouveau mot de passe<span class="text-danger">*</span></label>
                        <input type="password" name="newpass1" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="newpass2">Re-entrez le nouveau mot de passe <span class="text-danger">*</span></label>
                        <input type="password" name="newpass2" class="form-control">
                    </div>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="editpass" class="btn btn-primary" value="Modifier"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un Utilisateur</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="parametres.php" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom complet<span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur<span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="access">Choisissez le niveau d'accès<span class="text-danger">*</span></label>
                        <select class="custom-select" name="access">
                            <option value="Administrator">Administrator</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Responsable Stock">Responsable Stock</option>
                        </select>
                    </div>
                    <span class="text-danger">* Obligatoire</span>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="reset" class="btn btn-danger" value="Annuler"/>
                    <input type="submit" name="adduser" class="btn btn-primary" value="Ajouter"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
    include("includes/footer.php");
?>


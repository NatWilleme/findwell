<?php
    $title = "Profil";
    ob_start();	
?>



<div class="container mt-4">
    <?php if(isset($alert)){ ?>
    <div class="mt-4 alert alert-<?php echo $alert['color']; ?> alert-dismissible fade show" role="alert">
        <?php
            if($alert['color'] == "danger"){echo "<i class=\"bi bi-exclamation-triangle me-2 fs-4\"></i>";}
            else echo "<i class=\"bi bi-check-square me-2 fs-4\"></i>";
            echo $alert['message']; 
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    <form action="../controllers/controller_editProfil.php" method="post">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="<?php echo $user->image; ?>" alt="<?php echo $user->username; ?>">
                                </div>
                                <h5 class="user-name"><?php echo $user->username; ?></h5>
                                <h6 class="user-email"><?php echo $user->mail; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Mes informations</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="username">Nom complet</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>" placeholder="Votre nom complet">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mail">Adresse-mail</label>
                                    <p id="mail"><?php echo $user->mail; ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $user->phone; ?>" placeholder="Votre numéro">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="street">Rue</label>
                                    <input type="text" name="street" class="form-control" id="street" value="<?php echo $user->street; ?>" placeholder="Votre rue">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">Ville</label>
                                    <input type="name" class="form-control" name="city" id="city" value="<?php echo $user->city; ?>" placeholder="Votre ville">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">Pays</label>
                                    <select name="state" class="form-control" id="state">
                                        <option value="Belgique" <?php if($user->state == "Belgique") echo "selected" ?> >Belgique</option>
                                        <option value="France" <?php if($user->state == "France") echo "selected" ?>>France</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zip">Code Postal</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $user->zip; ?>" placeholder="Votre code postal">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters mt-2 mb-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" value="cancel" class="btn btn-secondary">Annuler</button>
                                    <button type="submit" id="submit" name="submit" value="update" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
    $content = ob_get_clean();
    require_once("../templates/templateConnected.php");
?>
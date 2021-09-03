<?php
    $title = "Profil";
    $scripts = "<script src=\"../js/checkEntries/checkEntries_editProfil.js\"></script>";
    ob_start();	
?>



<div class="container mt-4">
    <?php if(isset($alert['color'])){ ?>
    <div class="mt-4 alert alert-<?php echo $alert['color']; ?> alert-dismissible fade show" role="alert">
        <?php
            if($alert['color'] == "danger"){echo "<i class=\"bi bi-exclamation-triangle me-2 fs-4\"></i>";}
            else echo "<i class=\"bi bi-check-square me-2 fs-4\"></i>";
            echo $alert['message']; 
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    <?php if($user->type == "user" || $user->type == "admin") { ?>
    <form action="index.php?viewToDisplay=displayEditProfil" method="post" enctype='multipart/form-data'>
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="<?php if($user->image != ""){ echo $user->image;} else { echo "../images/default-profil.jpg"; } ?>" alt="<?php echo $user->username; ?>">
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
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo de profil</label>
                                    <input type="file" class="form-control" name="image" id="image" accept=".jpg, .png">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
                                <div class="form-group">
                                    <label for="number">Numéro</label>
                                    <input type="text" name="number" class="form-control" id="number" value="<?php echo $user->number; ?>" placeholder="Numéro">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                <div class="form-group">
                                    <label for="street">Rue</label>
                                    <input type="text" name="street" class="form-control" id="street" value="<?php echo $user->street; ?>" placeholder="Rue">
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
                        <input style="display: none;" type="text" name="imageOld" id="imageOld" value="<?php if($user->image != "") echo $user->image; else echo "../images/default-profil.jpg";?>">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php } else if($user->type == "company"){ ?>
    
        <form id="formEditCompany" action="index.php?viewToDisplay=displayEditProfil" method="post" enctype='multipart/form-data'>
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="<?php if($user->image != ""){ echo $user->image;} else { echo "../images/upload/photos_profils/default-profil.jpg"; } ?>" alt="<?php echo $user->username; ?>">
                                </div>
                                <h5 class="user-name"><?php echo $company->name; ?></h5>
                                <h6 class="user-email"><?php echo $company->mail; ?></h6>
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
                                    <label for="username">Nom de l'entreprise</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $company->name; ?>" placeholder="Nom de l'entreprise" required>
                                    <p id="errorName"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mail">Adresse-mail</label>
                                    <p id="mail"><?php echo $company->mail; ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $company->phone; ?>" placeholder="Votre numéro" required>
                                    <p id="errorPhone"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo de profil</label>
                                    <input type="file" class="form-control" name="image" id="image" accept=".jpg, .png">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description de l'entreprise..." required><?php echo $company->description; ?></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="hours">Heures d'ouverture</label>
                                    <textarea class="form-control" name="hours" id="hours" cols="30" rows="10" placeholder="Heures d'ouverture de l'entreprise..." required><?php echo $company->hours; ?></textarea>
                                    <p id="errorHours"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
                                <div class="form-group">
                                    <label for="number">Numéro</label>
                                    <input type="text" name="number" class="form-control" id="number" value="<?php echo $company->number; ?>" placeholder="Numéro"  required>
                                    <p id="errorNumber"></p>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                <div class="form-group">
                                    <label for="street">Rue</label>
                                    <input type="text" name="street" class="form-control" id="street" value="<?php echo $company->street; ?>" placeholder="Rue"  required>
                                    <p id="errorStreet"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">Ville</label>
                                    <input type="name" class="form-control" name="city" id="city" value="<?php echo $company->city; ?>" placeholder="Votre ville"  required>
                                    <p id="errorCity"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">Pays</label>
                                    <select name="state" class="form-control" id="state"  required>
                                        <option value="Belgique" <?php if($company->state == "Belgique") echo "selected" ?> >Belgique</option>
                                        <option value="France" <?php if($company->state == "France") echo "selected" ?>>France</option>
                                    </select>
                                    <p id="errorState"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zip">Code Postal</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $company->postalCode; ?>" placeholder="Votre code postal"  required>
                                    <p id="errorZip"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters mt-2 mb-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" value="cancelCompany" class="btn btn-secondary">Annuler</button>
                                    <button type="submit" id="submit" name="submit" value="updateCompany" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                        </div>
                        <input style="display: none;" type="text" name="imageOld" id="imageOld" value="<?php if($user->image != "") echo $user->image; else echo "../images/default-profil.jpg";?>">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php } ?>
</div>

<?php
    $content = ob_get_clean();
    displayTemplateConnected($title, $content, $notification, $scripts);
?>
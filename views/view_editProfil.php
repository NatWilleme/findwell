<?php
    $title = "Profil";
    ob_start();	
?>


<div class="container mt-4">
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
                            <label for="fullName">Nom complet</label>
                            <input type="text" class="form-control" id="fullName" value="<?php echo $user->username; ?>" placeholder="Votre nom complet">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="eMail">Adresse-mail</label>
                            <p id="eMail"><?php echo $user->mail; ?></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="text" class="form-control" id="phone" value="<?php echo $user->phone; ?>" placeholder="Votre numéro">
                        </div>
                    </div>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="Street">Rue</label>
                            <input type="name" class="form-control" id="Street" value="<?php echo $user->street; ?>" placeholder="Votre rue">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="ciTy">Ville</label>
                            <input type="name" class="form-control" id="ciTy" value="<?php echo $user->city; ?>" placeholder="Votre ville">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="sTate">Pays</label>
                            <select name="state" class="form-control" value="<?php echo $user->state; ?>" id="sTate">
                                <option value="Belgique">Belgique</option>
                                <option value="France">France</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="zIp">Code Postal</label>
                            <input type="text" class="form-control" id="zIp" value="<?php echo $user->zip; ?>" placeholder="Votre code postal">
                        </div>
                    </div>
                </div>
                <div class="row gutters mt-2 mb-4">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-right">
                            <button type="button" id="submit" name="submit" class="btn btn-secondary">Annuler</button>
                            <button type="button" id="submit" name="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require_once("../templates/templateConnected.php");
?>
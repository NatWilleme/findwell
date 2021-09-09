<?php
    $title = "Inscription";
    $scripts = "<script src=\"js/checkEntries/checkEntries_inscription.js\"></script><script src=\"js/checkedDomaine.js\"></script>";
    ob_start();	
?>

<div class="container text-center">
    
    <?php if(isset($alert) && $alert != ''){ ?>
    <div class="mt-4 alert alert-<?php echo $alert['color']; ?> alert-dismissible fade show" role="alert">
        <?php
            if($alert['color'] == "danger"){echo "<i class=\"bi bi-exclamation-triangle me-2 fs-4\"></i>";}
            else echo "<i class=\"bi bi-check-square me-2 fs-4\"></i>";
            echo $alert['message']; 
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>

    
    
    <!-- Deuxième écran d'inscription -->
    <?php if($choice != '') { ?>
    <main class="form-signin">
        <form method="post" action="index.php">
            <img class="mb-4" src="images/logo1.png" alt="" width="120">
            <h1 class="h3 mb-3 fw-normal">S'inscrire en tant que :</h1>

            <div class="form-floating">
                <input class="btn btn-lg btn-primary" type="submit"  name="type" value="Utilisateur">
                <input class="btn btn-lg btn-primary" type="submit" name="type" value="Entreprise">
            </div>
            <div class="form-floating mb-4">
            </div>
        </form>
    </main> 

    <!-- Premier écran d'inscription en tant qu'entreprise -->
    <?php } else if($companyForm != ''){ ?>
    <form id="formCompany" class="mb-3 mt-3" action="index.php" method="post" enctype='multipart/form-data'>
        <img class="mb-4" src="images/logo1.png" alt="" width="120">
        <h1 class="h3 mb-3 fw-normal">Enregistrement de vos informations</h1>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">

                        <div class="row gutters mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Mes informations</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Nom de l'entreprise</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de l'entreprise" required>
                                    <p id="errorName"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Entrez le numéro de téléphone de l'entreprise" required>
                                    <p id="errorPhone"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description de l'entreprise..." required></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="hours">Heures d'ouverture</label>
                                    <textarea class="form-control" name="hours" id="hours" cols="30" rows="10" placeholder="Heures d'ouverture de l'entreprise..." required></textarea>
                                    <p id="errorHours"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="tva">Numéro de TVA</label>
                                    <input type="text" class="form-control" name="tva" id="tva" placeholder="Entrez votre numéro de TVA" required>
                                    <p id="errorTva"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo de l'entreprise</label>
                                    <input type="file" class="form-control" name="image" id="image" accept=".jpg, .png">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
                                <div class="form-group">
                                    <label for="number">Numéro</label>
                                    <input type="text" name="number" class="form-control" id="number" placeholder="Numéro" required>
                                    <p id="errorNumber"></p>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                <div class="form-group">
                                    <label for="street">Rue</label>
                                    <input type="text" name="street" class="form-control" id="street" placeholder="Rue" required>
                                    <p id="errorStreet"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">Ville</label>
                                    <input type="name" class="form-control" name="city" id="city" placeholder="Ville" required>
                                    <p id="errorCity"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">Pays</label>
                                    <select name="state" class="form-select" id="state" required>
                                        <option value="">-- Choisissez le pays --</option>
                                        <option value="Belgique">Belgique</option>
                                        <option value="France">France</option>
                                    </select>
                                    <p id="errorState"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zip">Code Postal</label>
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Code postal" required>
                                    <p id="errorZip"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters mt-2 mb-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" name="submitCompany" value="submit" class="btn btn-primary">Suivant</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Deuxième écran d'inscription en tant qu'entreprise -->
    <?php } else if($domainePage != '') { ?>
        <form class="mb-3 mt-3" id="formDomaine" action="index.php" method="post">
        <img class="mb-4" src="images/logo1.png" alt="" width="120">
        <h1 class="h3 mb-3 fw-normal">Enregistrement de vos informations</h1>

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">

                            <div class="row gutters mb-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h5 class="mb-2 text-primary">Domaines</h6>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Travaux acceptés:</h6>
                                    <p id="errorDomaine"></p>
                                </div>
                                    <div class="row gutters mt-2 mb-4">
                                        <div class="col-5"></div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
                                            <div class="form-check">
                                                <label class="form-check-label" for="Gros travaux">Gros travaux</label>
                                                <input type="checkbox" name="category" class="form-check-input" id="checkGrosTravaux">
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" for="Petits travaux">Petits travaux</label>
                                                <input type="checkbox" name="category" class="form-check-input" id="checkPetitstravaux">
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label" for="Intervention d'urgence">Intervention d'urgence</label>
                                                <input type="checkbox" name="category" class="form-check-input" id="checkDepannage">
                                            </div>
                                        </div>
                                        <div class="col-5"></div>
                                    </div>

                                    <div class="row gutters mt-2 mb-4">
                                        <div class="col-2"></div>
                                        <div id="listGrosTravaux" style="display: none;"  class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <h5 class="text-primary">Gros Travaux</h5>
                                        <?php foreach ($domainePage['categoriesGrosTravaux'] as $category) { ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                                <input type="checkbox" class="form-check-input" name="checkGros[]" id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>">
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div id="listPetitsTravaux" style="display: none;"  class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <h5 class="text-primary">Petits Travaux</h5>
                                        <?php foreach ($domainePage['categoriesPetitsTravaux'] as $category) { ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                                <input type="checkbox" class="form-check-input" name="checkPetits[]"  id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>">
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div id="listDepannage" style="display: none;"  class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <h5 class="text-primary">Dépannage d'urgence</h5>
                                        <?php foreach ($domainePage['categoriesDepannage'] as $category) { ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                                <input type="checkbox" class="form-check-input" name="checkDepannage[]"  id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>">
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                            </div>
                            <div class="row gutters mt-2 mb-4">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" name="submitDomaine" value="submit" class="btn btn-primary">Finaliser inscription</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Premier écran d'inscription -->
        <?php } else { ?>
        <main class="form-signin">
        <form method="post" action="index.php" id="formRegister">
            <img class="mb-4" src="images/logo1.png" alt="" width="120">
            <h1 class="h3 mb-3 fw-normal">Inscription</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="mail" name="mail" placeholder="nom@exemple.be" required>
                <label for="mail">Adresse mail</label>
                <p id="errorMail"></p>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                <label for="password">Mot de passe</label>
                <p id="errorPwd"></p>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submitRegister">S'inscrire</button>
        </form>
        </main>  
        <?php } ?>






</div>

<?php
    $content = ob_get_clean();
    displayTemplateNotConnected($title, $content, $scripts);
?>
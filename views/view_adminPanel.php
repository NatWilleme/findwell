<?php
    $title = "Gestion du site";
    $scripts = "<script src=\"js/checkEntries/checkEntries_inscription.js\"></script><script src=\"js/checkedDomaine.js\"></script><script src=\"js/myCropper.js\"></script>";
    ob_start();	
?>

<div class="container mt-2 mb-5">
    
    <?php if(!isset($_GET['view'])) { ?>
    <div class="row d-flex mt-5 align-items-center">
        <div class="col-12 col-lg-6">
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=companies">Gérer les entreprises certifiées</a><br>
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=companiesNotCertified">Gérer les entreprises en attente de certification <?php if($notification['company'] != 0) { ?> <span class="badge bg-danger ms-1"><?php echo $notification['company']; ?></span> <?php } ?></a><br>
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=ads">Gérer les publicités</a><br>
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=popup">Gérer les pop-ups</a><br>
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=users">Gérer les utilisateurs</a><br>
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=missionsInAcceptPending">Gérer les missions en attente d'approbation<?php if($notification['mission'] != 0) { ?> <span class="badge bg-danger ms-1"><?php echo $notification['mission']; ?></span> <?php } ?></a><br>
            <a class="btn btn-warning p-3 mb-5 col-12 fw-bold" href="index.php?viewToDisplay=displayAdminPanel&view=missions">Gérer les missions en cours</a><br>
            <a class="btn btn-warning p-3 col-12 fw-bold" target="_blank" rel="noopener noreferrer" href="https://analytics.google.com/analytics/web/#/p286595337/realtime/overview?params=_u..nav%3Dmaui">Accéder aux statistiques</a>
        </div>
        <div class="col-1"></div>
        <div class="col-12 col-lg-5">
            <img src="images/settings.png" class="d-none d-lg-block" height="600" alt="">
        </div>
    </div>
    
    <?php } else { ?>
    <a class="btn btn-secondary col-12 col-lg-2 mt-3 mb-3" href="index.php?viewToDisplay=displayAdminPanel<?php if($_GET['view'] == "companies" && isset($_GET['edit'])) echo "&view=companies"; 
        else if($_GET['view'] == "ads" && (isset($_GET['edit']) || isset($_GET['action']) )) echo '&view=ads'; 
        else if($_GET['view'] == "users" && isset($_GET['edit'])) echo '&view=users';
        else if($_GET['view'] == "companiesNotCertified" && isset($companyToConfirm)) echo '&view=companiesNotCertified';
        else if($_GET['view'] == "popup" && (isset($_GET['action']) || isset($_GET['displayEdit']))) echo '&view=popup'; ?>
    ">Retour</a>
    <?php } ?>

    <?php if(isset($ads) && !isset($action)){ ?>
        <a class="btn btn-primary" href="index.php?viewToDisplay=displayAdminPanel&view=ads&action=add">Ajouter une nouvelle publicité</a>
    <?php } ?>

    <?php if(isset($companies) && !isset($action) && !isset($addNewCompany)){ ?>
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
    <a class="btn btn-primary col-12 col-lg-3" href="index.php?viewToDisplay=displayAdminPanel&view=companies&action=add">Ajouter une nouvelle entreprise</a>
    <div class="table-responsive mb-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Mail</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Note globale</th>
                <th scope="col">Nombre d'avis</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($companies as $company) { ?>
            <tr>
            <td><?php echo $company->name; ?></td>
            <td><?php echo $company->mail; ?></td>
            <td><?php echo $company->phone; ?></td>
            <td><?php for ($i=0; $i < 5; $i++) { 
                            if($i < $company->rating){
                                echo "<i class='bi bi-star-fill text-warning'></i>";
                            } else echo "<i class='bi bi-star text-warning'></i>";
                        } ?></td>
            <td><?php echo $company->countComment; ?></td>
            <td>
                <a class="btn btn-danger" href="index.php?viewToDisplay=displayAdminPanel&view=companies&delete=<?php echo $company->id; ?>"><i class="bi bi-trash-fill"></i></a> 
                <a class="btn btn-warning" href="index.php?viewToDisplay=displayAdminPanel&view=companies&edit=<?php echo $company->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>

    <?php if(isset($addNewCompany)) { ?>
    <form id="formCompanyFromAdmin" class="mb-3 mt-3" action="index.php?viewToDisplay=displayAdminPanel&view=companies" method="post" enctype='multipart/form-data'>
        <h3 class="text-center mb-3 fw-bold">Informations de l'entreprise :</h3>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Informations générales</h6>
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
                                    <label for="mail">Adresse mail</label>
                                    <input type="email" class="form-control" name="mail" id="mail" placeholder="Entrez l'adresse mail de l'entreprise" required>
                                    <p id="errorMail"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" maxlength="1999" placeholder="Description de l'entreprise..." required></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="hours">Heures d'ouverture</label>
                                    <textarea class="form-control" name="hours" id="hours" cols="30" rows="10" maxlength="999" placeholder="Heures d'ouverture de l'entreprise..." required></textarea>
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
                                    <input type="file" id="companyImage" class="form-control" name="image" id="image" accept=".png, .jpg, .jpeg">
                                    <p id="errorImage"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="web">Site web ou réseau sociaux</label>
                                    <input type="text" class="form-control" name="web" id="web" placeholder="Entrez votre URL">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters mb-3">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Adresse</h6>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="number">Numéro</label>
                                    <input type="text" name="number" class="form-control" id="number" placeholder="Numéro" required>
                                    <p id="errorNumber"></p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
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

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">

                                        <div class="row gutters mb-3">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h5 class="mb-2 text-primary">Domaines</h6>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mb-2">Travaux acceptés:</h6>
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
                                                    <button type="submit" name="submitNewCompanyByAdmin" value="submit" class="btn btn-primary">Enregistrer l'entreprise</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>   
    <?php } ?>

    <?php if(isset($companiesToBeConfirmed) && !isset($action) && !isset($companyToConfirm)){ ?>
    <div class="table-responsive mb-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Mail</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Afficher</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($companiesToBeConfirmed as $company) { ?>
            <tr>
            <td><?php echo $company->name; ?></td>
            <td><?php echo $company->mail; ?></td>
            <td><?php echo $company->phone; ?></td>
            <td>
                <a class="btn btn-primary" href="index.php?viewToDisplay=displayAdminPanel&view=companiesNotCertified&see=<?php echo $company->id; ?>"><i class="bi bi-eye-fill"></i></a> 
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>
    
    <?php if(isset($companyToConfirm)){ ?>
        <form class="mt-3" action="index.php?viewToDisplay=displayAdminPanel&view=companiesNotCertified" method="post">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Informations</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="username">Nom de l'entreprise</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $companyToConfirm->name; ?>" <?php if($companyToConfirm->name == "") echo "style=\"background-color:#FF3603;\""; ?> disabled readonly>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="mail">Adresse-mail</label><br>
                        <input type="email" name="mail" id="mail" value="<?php echo $companyToConfirm->mail; ?>" disabled readonly>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $companyToConfirm->phone; ?>" disabled readonly <?php if($companyToConfirm->phone == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="profil">Photo de profil</label><br>
                        <img class="border" style="max-height: 200px; max-width: 400px; width: auto; height: auto;" name="profil" id="profil" src="<?php echo $companyToConfirm->image; ?>" alt="">
                        <input type="file" class="form-control" name="image" id="image" accept=".png, .jpg, .jpeg">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="6" disabled readonly <?php if($companyToConfirm->description == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>><?php echo $companyToConfirm->description; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="hours">Heure d'ouverture</label>
                        <textarea class="form-control" name="hours" id="hours" rows="6" disabled readonly <?php if($companyToConfirm->hours == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>><?php echo $companyToConfirm->hours; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="domaines">Domaines</label>
                        <textarea class="form-control" name="domaines" id="domaines" rows="6" disabled readonly <?php if($companyToConfirm->domaines == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>><?php echo $companyToConfirm->domaines; ?></textarea>
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
                        <input type="text" name="street" class="form-control" id="street" value="<?php echo $companyToConfirm->street; ?>" disabled readonly <?php if($companyToConfirm->street == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="name" class="form-control" name="city" id="city" value="<?php echo $companyToConfirm->city; ?>" disabled readonly <?php if($companyToConfirm->city == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="state">Numéro de rue</label>
                        <input type="text" class="form-control" name="number" id="number" value="<?php echo $companyToConfirm->number; ?>" disabled readonly <?php if($companyToConfirm->number == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="zip">Code Postal</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $companyToConfirm->postalCode; ?>" disabled readonly <?php if($companyToConfirm->postalCode == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                        
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">TVA</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="tva">Numéro de TVA</label>
                        <input type="text" class="form-control" name="tva" id="tva" value="<?php echo $companyToConfirm->tva; ?>" disabled readonly <?php if($companyToConfirm->tva == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                        <p id="errorTva"></p>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-9 col-6"></div>

                <button type="button" class="btn btn-danger mt-4 me-3 col-xl-1 col-md-1 col-2 rounded rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-x-lg"></i>
                </button>
                <button type="submit" class="btn btn-success mt-4 me-3 col-xl-1 col-md-1 col-2 rounded rounded-pill" id="accept" name="accept" value="<?php echo $companyToConfirm->id; ?>">
                    <i class="bi bi-check-lg"></i>
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Raison du refus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="messageRefus" class="col-form-label">Indiquez ci-dessous la raison du refus:</label>
                                <textarea class="form-control" id="messageRefus" name="messageRefus" rows='5'></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" id="delete" name="delete" value="<?php echo $companyToConfirm->id; ?>">
                                Envoyer
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                
            </div>
        </form>
    <?php } ?>

    <?php if(isset($missionsToBeAccepted) ){ ?>
    <div class="table-responsive mb-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Entreprise</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col">Afficher</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($missionsToBeAccepted as $mission) { ?>
            <tr>
            <td><?php echo $mission->username; ?></td>
            <td><?php echo $mission->title; ?></td>
            <td><?php echo $mission->description; ?></td>
            <td><?php echo $mission->price; ?></td>
            <td>
                <a class="btn btn-primary" href="index.php?viewToDisplay=displayAnnonce&subcategory=mission&idMission=<?php echo $mission->id; ?>"><i class="bi bi-eye-fill"></i></a> 
                <a class="btn btn-success" href="index.php?viewToDisplay=displayAnnonce&subcategory=mission&idMission=<?php echo $mission->id; ?>&accept=true"><i class="bi bi-check-lg"></i></a> 
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>

    <?php if(isset($missionsAccepted) ){ ?>
    <div class="table-responsive mb-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Entreprise</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col">Afficher</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($missionsAccepted as $mission) { ?>
            <tr>
            <td><?php echo $mission->username; ?></td>
            <td><?php echo $mission->title; ?></td>
            <td><?php echo $mission->description; ?></td>
            <td><?php echo $mission->price; ?></td>
            <td>
                <a class="btn btn-primary" href="index.php?viewToDisplay=displayAnnonce&subcategory=mission&idMission=<?php echo $mission->id; ?>"><i class="bi bi-eye-fill"></i></a> 
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>

    <?php if(isset($users)){ ?>
    <div class="table-responsive mb-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Mail</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) { ?>
            <tr>
            <th scope="row"><?php echo $user->id; ?></th>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->mail; ?></td>
            <td><?php echo $user->phone; ?></td>
            <td><?php echo $user->type; ?></td>
            <td> 
                <a class="btn btn-warning" href="index.php?viewToDisplay=displayAdminPanel&view=users&edit=<?php echo $user->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>




    <?php if(isset($companyToEdit)){ ?>
        <form class="mt-3" action="index.php?viewToDisplay=displayAdminPanel&view=companies" method="post" enctype='multipart/form-data'>
            <div class="row gutters">
                <input type="text" name="idCompany" style='display: none;' value='<?php echo $companyToEdit->id; ?>'>
                <input type="text" name="image" style='display: none;' value='<?php echo $companyToEdit->image; ?>'>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Informations</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="name">Nom de l'entreprise</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Nom de l'entreprise" value="<?php echo $companyToEdit->name; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="mail">Adresse-mail</label><br>
                        <a href="mailto:<?php echo $companyToEdit->mail; ?>"><?php echo $companyToEdit->mail; ?></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" name="phone" id="phone"  placeholder="Numéro de téléphone" value="<?php echo $companyToEdit->phone; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="profil">Photo de profil</label><br>
                        <input type="file" class="form-control" name="image" id="image" accept=".png, .jpg, .jpeg">
                        <img class="border mt-2" style="max-height: 200px; max-width: 400px; width: auto; height: auto;" name="profil" id="profil" src="<?php echo $companyToEdit->image; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="web">Site web ou réseau sociaux</label>
                        <input type="text" class="form-control" name="web" id="web" placeholder="Entrez votre URL" value="<?php echo $companyToEdit->web; ?>">
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Description de l'entreprise" rows="6"><?php echo str_replace("<br />", "", $companyToEdit->description) ; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="hours">Heure d'ouverture</label>
                        <textarea class="form-control" name="hours" id="hours" placeholder="Heure d'ouverture" rows="6"><?php echo str_replace("<br />", "", $companyToEdit->hours) ; ?></textarea>
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
                        <input type="text" name="street" class="form-control" id="street"  placeholder="Rue" value="<?php echo $companyToEdit->street; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="name" class="form-control" name="city" id="city"  placeholder="Ville" value="<?php echo $companyToEdit->city; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="state">Numéro de rue</label>
                        <input type="text" class="form-control" name="number" id="number"  placeholder="Numéro de rue" value="<?php echo $companyToEdit->number; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="zip">Code Postal</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Code postal" value="<?php echo $companyToEdit->postalCode; ?>">
                        
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Certification</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div>
                        <input type="radio" name="certified" id="yes" value="1" <?php if($companyToEdit->certified == 1) echo 'checked'; ?>>
                        <label for="yes">Oui</label><br>
                        <input type="radio" name="certified" id="no" value="0" <?php if($companyToEdit->certified == 0) echo 'checked'; ?>>
                        <label for="no">Non</label>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Active</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div>
                        <input type="radio" name="hasPaid" id="yes" value="1" <?php if($companyToEdit->hasPaid == 1) echo 'checked'; ?>>
                        <label for="yes">Oui</label><br>
                        <input type="radio" name="hasPaid" id="no" value="0" <?php if($companyToEdit->hasPaid == 0) echo 'checked'; ?>>
                        <label for="no">Non</label>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">TVA</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="tva">Numéro de TVA</label>
                        <input type="text" class="form-control" name="tva" id="tva" value="<?php echo $companyToEdit->tva; ?>" <?php if($companyToEdit->tva == "") echo "style=\"background-color:rgb(255,0,0,0.4);\""; ?>>
                        <p id="errorTva"></p>
                    </div>
                </div>
            </div>
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
                                        <div class="col-2"></div>
                                        <div id="listGrosTravaux" class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <h5 class="text-primary">Gros Travaux</h5>
                                        <?php foreach ($domainePage['categoriesGrosTravaux'] as $category) { ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                                <input type="checkbox" class="form-check-input" name="checkGros[]" id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>" <?php if(in_array($category->id,$companyDomaines)) echo "checked"; ?>>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div id="listPetitsTravaux" class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <h5 class="text-primary">Petits Travaux</h5>
                                        <?php foreach ($domainePage['categoriesPetitsTravaux'] as $category) { ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                                <input type="checkbox" class="form-check-input" name="checkPetits[]"  id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>" <?php if(in_array($category->id,$companyDomaines)) echo "checked"; ?>>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div id="listDepannage" class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <h5 class="text-primary">Dépannage d'urgence</h5>
                                        <?php foreach ($domainePage['categoriesDepannage'] as $category) { ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                                <input type="checkbox" class="form-check-input" name="checkDepannage[]"  id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>" <?php if(in_array($category->id,$companyDomaines)) echo "checked"; ?>>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutters">
            <button class="btn btn-primary mt-4 col-2" name="submitEditCompany" type="submit">Modifier</button>
            </div>
        </form>
    <?php } ?>

    <?php if(isset($userToEdit)){ ?>
        <form class="mt-3" action="index.php?viewToDisplay=displayAdminPanel&view=users" method="post" id="formUser">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Informations</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="username">Nom de l'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nom de l'utilisateur" value="<?php echo $userToEdit->username; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="mail">Adresse-mail</label><br>
                        <a href="mailto:<?php echo $userToEdit->mail; ?>"><?php echo $userToEdit->mail; ?></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" name="phone" id="phone"  placeholder="Numéro de téléphone" value="<?php echo $userToEdit->phone; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="profil">Photo de profil</label><br>
                        <img class="border" style="max-height: 200px; max-width: 400px; width: auto; height: auto;" name="profil" id="profil" src="<?php echo $userToEdit->image; ?>" alt="">
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
                        <input type="text" name="street" class="form-control" id="street"  placeholder="Rue" value="<?php echo $userToEdit->street; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="name" class="form-control" name="city" id="city"  placeholder="Ville" value="<?php echo $userToEdit->city; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="state">Numéro de rue</label>
                        <input type="text" class="form-control" name="number" id="number"  placeholder="Numéro de rue" value="<?php echo $userToEdit->number; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="zip">Code Postal</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Code postal" value="<?php echo $userToEdit->zip; ?>">
                        
                    </div>
                </div>
                <?php if($userToEdit->type != "company"){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary">Type d'utilisateur</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div>
                        <input type="radio" name="type" id="user" value="user" <?php if($userToEdit->type == "user") echo 'checked'; ?>>
                        <label for="yes">Utilisateur</label><br>
                        <input type="radio" name="type" id="admin" value="admin" <?php if($userToEdit->type == "admin") echo 'checked'; ?>>
                        <label for="no">Administrateur</label>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="row gutters">
            <input style="display: none;" type="text" name="action" id="action" value="editUser">
            <input style="display: none;" type="text" name="idToEdit" id="idToEdit" value="<?php echo $userToEdit->id;?>">
            
            </div>
        </form>
        <button class="btn btn-primary mt-3" type="submit" form="formUser">Modifier</button>
    <?php } ?>


    <?php if(isset($ads) && !isset($action)){ ?>
    <div class="table-responsive mb-5">        
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Entreprise</th>
                <th scope="col">Image PC</th>
                <th scope="col">Image Mobile</th>
                <th scope="col">Affichée ?</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ads as $ad) { ?>
            <tr>
            <th scope="row"><?php echo $ad->id; ?></th>
            <td><?php echo $ad->name_comp; ?></td>
            <td><img src="<?php echo $ad->imagePC; ?>" width="300" alt=""></td>
            <td><img src="<?php echo $ad->imageMobile; ?>" width="300" alt=""></td>
            <td><?php if($ad->display == 1) echo "Oui"; else echo "Non"; ?></td>
            <td>
                <a class="btn btn-danger" href="index.php?viewToDisplay=displayAdminPanel&view=ads&delete=<?php echo $ad->id; ?>"><i class="bi bi-trash-fill"></i></a> 
                <a class="btn btn-warning" href="index.php?viewToDisplay=displayAdminPanel&view=ads&edit=<?php echo $ad->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>

    <?php if(isset($popups)){ ?>
    <a class="btn btn-primary" href="index.php?viewToDisplay=displayAdminPanel&view=popup&action=displayAdd">Ajouter un nouveau pop-up</a>
    <div class="table-responsive mb-5">        
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Message</th>
                <th scope="col">Image</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($popups as $popup) { ?>
            <tr>
            <th scope="row"><?php echo $popup->id; ?></th>
            <td><?php echo $popup->message; ?></td>
            <td><img src="<?php echo $popup->image; ?>" width="300" alt=""></td>
            <td><?php if($popup->active == 1) echo "Oui"; else echo "Non"; ?></td>
            <td>
                <a class="btn btn-danger" href="index.php?viewToDisplay=displayAdminPanel&view=popup&delete=<?php echo $popup->id; ?>"><i class="bi bi-trash-fill"></i></a> 
                <a class="btn btn-warning" href="index.php?viewToDisplay=displayAdminPanel&view=popup&displayEdit=<?php echo $popup->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    <?php } ?>
    <?php if(isset($displayAddPopup) || isset($popupToEdit)){ ?>
    <form action="index.php?viewToDisplay=displayAdminPanel&view=popup&action=<?php if(isset($displayAddPopup)) echo "add"; else echo "edit"; ?>" method="post" enctype="multipart/form-data">
        <div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mt-3 mb-2 text-primary">
                    <?php if(isset($popupToEdit)) echo "Modifier le pop-up"; else echo "Ajouter un nouveau pop-up"; ?>
                </h6>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" maxlength="499" rows="5" name="message" placeholder="Message du pop-up"><?php if(isset($popupToEdit)) echo $popupToEdit->message; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <label for="active">Afficher ?</label>
                    <div id ="active" class="form-control">
                        <input type="radio" name="active" id="yes" value="1" <?php if((isset($popupToEdit) && $popupToEdit->active == 1) || !isset($popupToEdit)) echo "checked"; ?>>
                        <label for="yes">Oui</label><br>
                        <input type="radio" name="active" id="no" value="0" <?php if((isset($popupToEdit) && $popupToEdit->active == 0)) echo "checked"; ?>>
                        <label for="no">Non</label>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="imagePopup" name="image" placeholder="Image du pop-up" accept=".jpg, .png">
                        <div class="mt-2" style="width: 300px;" id="previewPopup"></div>
                        <?php if(isset($popupToEdit) && $popupToEdit->image != null){?>
                            <img id="oldImagePopup" class="mt-2" src="<?php echo $popupToEdit->image; ?>" width="300" alt="">
                        <?php } ?>
                    </div>
                </div>
                
            </div>
        </div>
        <?php if(isset($popupToEdit)){ ?>
            <input class="d-none" type="text" value="<?php echo $popupToEdit->id; ?>" name="id">
        <?php } ?>
        <button type="submit" class="btn btn-primary mt-5">
            <?php if(isset($popupToEdit)) echo "Modifier"; else echo "Ajouter"; ?>    
        </button>
    </form>
    <?php } ?>

    <?php
    if(isset($action)){ 
    ?>

    <form name="adForm" class="mt-3" action="index.php?viewToDisplay=displayAdminPanel&view=ads" method="post" enctype='multipart/form-data'>
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h6 class="mb-2 text-primary"><?php if(isset($adToEdit)) echo 'Modification de la publicité'; else echo 'Nouvelle publicité';?></h6>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="company">Entreprise concernée</label>
                    <select class="form-control" name="company" id="company">
                        <option value="">--Sélectionnez une entreprise--</option>
                        <?php foreach ($companies as $company) { ?>
                        <option value="<?php echo $company->id; ?>" <?php if(isset($adToEdit) && $adToEdit->id_comp == $company->id) echo 'selected';?>><?php echo $company->name; ?></option>    
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="display">Afficher ?</label>
                    <div id ="display" class="form-control">
                        <input type="radio" name="display" id="yes" value="1" <?php if(isset($adToEdit) && $adToEdit->display == 1) echo 'checked'; ?>>
                        <label for="yes">Oui</label><br>
                        <input type="radio" name="display" id="no" value="0" <?php if(isset($adToEdit) && $adToEdit->display == 0) echo 'checked'; ?>>
                        <label for="no">Non</label>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="image">Publicité PC</label><br>
                    <?php if(isset($adToEdit)) { ?>
                        <div class="mb-3" style="width: 300px;">
                            <img class="d-block w-100" src="<?php echo $adToEdit->imagePC; ?>" alt="">
                        </div>
                    <?php }?>
                        <div class="mb-3" style="width: 300px;" id="previewPC"></div>
                    <input type="file" class="form-control" id="imagePC" name="imagePC" accept=".jpg, .png">
                    <input type="text" class="d-none" id="imagePCBase64" name="imagePCBase64">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="image">Publicité Mobile</label><br>
                    <?php if(isset($adToEdit)) { ?>
                        <div class="mb-3" style="width: 300px;">
                            <img class="d-block w-100" src="<?php echo $adToEdit->imageMobile; ?>" alt="">
                        </div>
                        
                    <?php } ?>
                        <div class="mb-3" style="width: 300px;" id="previewMobile"></div>

                    <input type="file" class="form-control" id="imageMobile" name="imageMobile" <?php if(isset($adToEdit)) echo "value=\"$adToEdit->imageMobile\""; ?> accept=".jpg, .png">
                    <input type="text" class="d-none" id="imageMobileBase64" name="imageMobileBase64">
                </div>
            </div>
        </div>
        <div class="row gutters">
            <input style="display: none;" type="text" name="action" id="action" value="<?php if(isset($adToEdit)) echo 'editAd'; else echo 'addAd';?>">
            <?php if(isset($adToEdit)) { ?>
                <input style="display: none;" type="text" name="idToEdit" id="idToEdit" value="<?php echo $adToEdit->id;?>">
                <input style="display: none;" type="text" name="imageOldPC" id="imageOldPC" value="<?php echo $adToEdit->imagePC;?>">
                <input style="display: none;" type="text" name="imageOldMobile" id="imageOldMobile" value="<?php echo $adToEdit->imageMobile;?>">
            <?php } ?>
            <a class="btn btn-primary mt-4 col-2" id="submit"><?php if(isset($adToEdit)) echo 'Modifier'; else echo 'Ajouter';?></a>
        </div>
    </form>

    <?php } ?>

</div>

<?php
    $content = ob_get_clean();
    displayTemplateConnected($title, $content, $notification, $scripts);
?>
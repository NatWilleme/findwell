<?php
    $title = "Contact";
    ob_start();	
?>

<div class="container mt-2 mb-5">

    <?php if(!isset($_GET['view'])) { ?>
    <a class="btn btn-primary mb-2" href="../controllers/controller_adminPanel.php?view=companies">Gérer les entreprises</a><br>
    <a class="btn btn-primary mb-2" href="../controllers/controller_adminPanel.php?view=ads">Gérer les publicités</a><br>
    <a class="btn btn-primary mb-2" href="../controllers/controller_adminPanel.php?view=users">Gérer les utilisateurs</a><br>
    <a class="btn btn-primary" href="../controllers/controller_adminPanel.php?view=stats">Accéder aux statistiques</a>
    <?php } else { ?>
    <a class="btn btn-secondary" href="../controllers/controller_adminPanel.php?
        <?php if($_GET['view'] == "companies" && isset($_GET['edit'])) echo "view=companies"; 
        else if($_GET['view'] == "ads" && isset($_GET['edit'])) echo 'view=ads'; 
        else if($_GET['view'] == "users" && isset($_GET['edit'])) echo 'view=users'; ?>
    ">Retour</a>
    <?php } ?>

    <?php if(isset($ads) && !isset($action)){ ?>
        <a class="btn btn-primary" href="../controllers/controller_adminPanel.php?view=ads&action=add">Ajouter une nouvelle publicité</a>
    <?php } ?>

    <?php if(isset($companies) && !isset($action)){ ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
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
            <th scope="row"><?php echo $company->id; ?></th>
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
                <a class="btn btn-danger" href="../controllers/controller_adminPanel.php?view=companies&delete=<?php echo $company->id; ?>"><i class="bi bi-trash-fill"></i></a> 
                <a class="btn btn-warning" href="../controllers/controller_adminPanel.php?view=companies&edit=<?php echo $company->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
    
    <?php if(isset($users)){ ?>
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
                <a class="btn btn-warning" href="../controllers/controller_adminPanel.php?view=users&edit=<?php echo $user->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>




    <?php if(isset($companyToEdit)){ ?>
        <form class="mt-3" action="../controllers/controller_adminPanel.php" method="post">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Informations</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="username">Nom de l'entreprise</label>
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
            </div>
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Description de l'entreprise" rows="6"><?php echo $companyToEdit->description; ?></textarea>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="hours">Heure d'ouverture</label>
                        <textarea class="form-control" name="hours" id="hours" placeholder="Heure d'ouverture" rows="6"><?php echo $companyToEdit->hours; ?></textarea>
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
                        <input type="radio" name="certified" id="yes" value="yes" <?php if($companyToEdit->certified == 1) echo 'checked'; ?>>
                        <label for="yes">Oui</label><br>
                        <input type="radio" name="certified" id="no" value="no" <?php if($companyToEdit->certified == 0) echo 'checked'; ?>>
                        <label for="no">Non</label>
                    </div>
                </div>
            </div>
            <div class="row gutters">
            <button class="btn btn-primary mt-4 col-2" type="submit">Modifier</button>
            </div>
        </form>
    <?php } ?>

    <?php if(isset($userToEdit)){ ?>
        <form class="mt-3" action="../controllers/controller_adminPanel.php?view=users" method="post">
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
            </div>
            <div class="row gutters">
            <input style="display: none;" type="text" name="action" id="action" value="editUser">
            <input style="display: none;" type="text" name="idToEdit" id="idToEdit" value="<?php echo $userToEdit->id;?>">
            <button class="btn btn-primary mt-4 col-2" type="submit">Modifier</button>
            </div>
        </form>
    <?php } ?>


    <?php if(isset($ads) && !isset($action)){ ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Entreprise</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
                <th scope="col">Affichée ?</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ads as $ad) { ?>
            <tr>
            <th scope="row"><?php echo $ad->id; ?></th>
            <td><?php echo $ad->name_comp; ?></td>
            <td><img src="<?php echo $ad->image; ?>" width="300" alt=""></td>
            <td>
                <a class="btn btn-danger" href="../controllers/controller_adminPanel.php?view=ads&delete=<?php echo $ad->id; ?>"><i class="bi bi-trash-fill"></i></a> 
                <a class="btn btn-warning" href="../controllers/controller_adminPanel.php?view=ads&edit=<?php echo $ad->id; ?>"><i class="bi bi-pencil-fill"></i></a>
            </td>
            <td><?php if($ad->display == 1) echo "Oui"; else echo "Non"; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <?php
    if(isset($action)){ 
    ?>

    <form class="mt-3" action="../controllers/controller_adminPanel.php?view=ads" method="post" enctype='multipart/form-data'>
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
                    <label for="image">Publicité <?php if(isset($adToEdit)) echo 'actuelle';?></label><br>
                    <?php if(isset($adToEdit)) { ?>
                        <img src="<?php echo $adToEdit->image; ?>" class="mb-3" width="300" alt="">
                    <?php } ?>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" >
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
        </div>
        <div class="row gutters">
            <input style="display: none;" type="text" name="action" id="action" value="<?php if(isset($adToEdit)) echo 'editAd'; else echo 'addAd';?>">
            <?php if(isset($adToEdit)) { ?>
                <input style="display: none;" type="text" name="idToEdit" id="idToEdit" value="<?php echo $adToEdit->id;?>">
                <input style="display: none;" type="text" name="imageOld" id="imageOld" value="<?php echo $adToEdit->image;?>">
            <?php } ?>
            <button class="btn btn-primary mt-4 col-2" id="submit" type="submit"><?php if(isset($adToEdit)) echo 'Modifier'; else echo 'Ajouter';?></button>
        </div>
    </form>

    <?php } ?>




</div>

<?php
    $content = ob_get_clean();
    require_once("../templates/templateConnected.php");
?>
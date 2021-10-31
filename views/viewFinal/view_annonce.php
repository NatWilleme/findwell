<?php
    $title = "Annonces";
    $scripts = "<script>const change = src => {
        document.getElementById('main').src = src
    }</script>";
    ob_start();	
?>

<div class="container-fluid">

<?php if(!is_null($categoriesServiceToDisplay)){ //Annonce des services ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
        <div class="row d-flex justify-content-around mb-4 mt-4 m-0">
        <?php foreach ($categoriesServiceToDisplay as $category) { ?>
                <div class="card border border-dark pt-2 ms-3 me-3" style="width: 18rem;">
                    <img src="<?php echo $category->image; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category->name; ?></h5>
                    </div>
                    <form id="formAccess" action="index.php" method="get">
                        <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                        <input type="text" name="subcategory" value="service" class="d-none">
                        <input type="text" name="category" class="d-none" value="<?php echo $category->name; ?>">
                        <button class="btn btn-primary mb-2 col-12">Accéder</button>
                    </form>
                </div> 
        <?php } ?>  
        </div>
<?php } else if(!is_null($servicesToDisplay)){ ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="col-10 offset-1 mt-4 table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Image</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Auteur</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicesToDisplay as $service) { ?>
                <tr>
                    <td><img src="<?php if(!is_null($service->imageService[0])) echo $service->imageService[0]; else echo "/images/annonce/blank_image.jpg"; ?>" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td><?php echo $service->title; ?></td>
                    <td><?php echo $service->description; ?></td>
                    <td>
                        <img src="<?php echo $service->imageUser; ?>" class="rounded-circle" alt="profil" style="width: 60px;" id="profil">
                        <label for="profil" class="ms-3"><b><?php echo $service->username; ?></b></label>
                    </td>    
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="service" class="d-none">
                            <input type="text" name="servicesToDisplay" value="true" class="d-none">
                            <input type="text" name="service" value="<?php echo $service->idService; ?>" class="d-none" >
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else if(!is_null($serviceToDisplay)){ ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="d-flex row justify-content-around mt-4">
        <div class="col-5">
            <!-- Gallerie photo -->
            <!-- Photo principale -->
            <div class="main_view text-center">
                <img class="img-fluid" src="<?php echo $serviceToDisplay->imageService[0]; ?>" id="main" alt="IMAGE" style="max-width: 500px; max-height: 500px;">
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <?php foreach ($serviceToDisplay->imageService as $image) { ?>
                
                <img src="<?php echo $image; ?>" onclick="change(this.src)">
                <?php } ?>
            </div>
        </div>
        <div class="col-5">
            <h1><b><?php echo $serviceToDisplay->title; ?></b></h1> 
            <h6>Publié il y a <?php echo $serviceToDisplay->date; ?> jours dans <?php echo $serviceToDisplay->region; ?></h6>
            <h4><b>Détails</b></h4>
            <p><?php echo $serviceToDisplay->description; ?></p>
            <h4><b>Information sur le travailleur :</b></h4>
            <div>
                <img src="<?php echo $serviceToDisplay->imageUser; ?>" class="rounded-circle" alt="profil" style="width: 60px;" id="profil">
                <label for="profil" class="ms-3"><b><?php echo $serviceToDisplay->username; ?></b></label>
            </div>
            <label for="phone"><b>Téléphone:</b> </label>
            <p id="phone" class="d-inline"><?php echo $serviceToDisplay->phone; ?></p>
            <br>
            <label for="phone"><b>Mail:</b> </label>
            <p id="phone" class="d-inline"><?php echo $serviceToDisplay->mail; ?></p>
        </div>
    </div>
<?php } else if(!is_null($occasions)){ //Annonces des outils d'occasion ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="col-10 offset-1 mt-4 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($occasions as $occasion) { ?>
                <tr>
                    <td><img src="<?php echo $occasion->imageOccasion[0]; ?>" style="max-width: 200px; max-height: 200px;" alt=""></td>
                    <td><?php echo $occasion->title; ?></td>
                    <td><b><?php echo $occasion->price; ?> €</b></td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="occasionToDisplay" value="<?php echo $occasion->idOccasion; ?>" class="d-none">
                            <input type="text" name="subcategory" value="occasion" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else if(!is_null($occasionToDisplay)){ ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="d-flex row justify-content-around mt-4">
        <div class="col-5">
            <!-- Gallerie photo -->
            <!-- Photo principale -->
            <div class="main_view text-center">
                <img class="img-fluid" src="<?php echo $occasionToDisplay->imageOccasion[0]; ?>" id="main" alt="IMAGE" style="max-width: 500px; max-height: 500px;">
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <?php foreach ($occasionToDisplay->imageOccasion as $image) { ?>
                    <img src="<?php echo $image; ?>" onclick="change(this.src)">
                <?php } ?>
            </div>
        </div>
        <div class="col-5">
            <h1><b><?php echo $occasionToDisplay->title; ?></b></h1>
            <h4><?php echo $occasionToDisplay->price; ?> €</h4>
            <h6>Publié il y a <?php echo $occasionToDisplay->date; ?> jours dans <?php echo $occasionToDisplay->region; ?></h6>
            <h4><b>Détails</b></h4>
            <p><?php echo $occasionToDisplay->description; ?></p>
            <h4><b>Information sur le vendeur :</b></h4>
            <div>
                <img src="<?php echo $occasionToDisplay->imageUser; ?>" class="rounded-circle" alt="profil" style="width: 60px;" id="profil">
                <label for="profil" class="ms-3"><b><?php echo $occasionToDisplay->username; ?></b></label>
            </div>
            <label for="phone"><b>Téléphone:</b> </label>
            <p id="phone" class="d-inline"><?php echo $occasionToDisplay->phone; ?></p>
            <br>
            <label for="phone"><b>Mail:</b> </label>
            <p id="phone" class="d-inline"><?php echo $occasionToDisplay->mail; ?></p>
        </div>
    </div>
<?php } else if(!is_null($categoriesMaterialsToDisplay)){ //Annonce des services ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="row d-flex justify-content-around mb-4 mt-4 m-0">
    <?php foreach ($categoriesMaterialsToDisplay as $category) { ?>
            <div class="card border border-dark pt-2 ms-3 me-3" style="width: 18rem;">
                <img src="<?php echo $category->image; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $category->name; ?></h5>
                </div>
                <form id="formAccess" action="index.php" method="get">
                    <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                    <input type="text" name="subcategory" value="materiel" class="d-none">
                    <input type="text" name="category" class="d-none" value="<?php echo $category->name; ?>">
                    <button class="btn btn-primary mb-2 col-12">Accéder</button>
                </form>
            </div> 
    <?php } ?>  
    </div>
<?php } else if(!is_null($materialsToDisplay)){ ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="col-10 offset-1 mt-4 table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Image</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($materialsToDisplay as $material ) { ?>                
                <tr>
                    <td><img src="<?php echo $material->imageMaterial[0]; ?>" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td><?php echo $material->title; ?></td>
                    <td><?php echo $material->description; ?></td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="materiel" class="d-none">
                            <input type="text" name="materiel" value="<?php echo $material->idMaterial; ?>" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>                
            </tbody>
        </table>
    </div>
<?php } else if(!is_null($materialToDisplay)){ ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <div class="d-flex row justify-content-around mt-4">
        <div class="col-5">
            <!-- Gallerie photo -->
            <!-- Photo principale -->
            <div class="main_view text-center">
                <img class="img-fluid" src="<?php echo $materialToDisplay->imageMaterial[0]; ?>" id="main" alt="IMAGE" style="max-width: 500px; max-height: 500px;">
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <?php foreach ($materialToDisplay->imageMaterial as $image) { ?>
                    <img src="<?php echo $image; ?>" onclick="change(this.src)">
                <?php } ?>
            </div>
        </div>
        <div class="col-5">
            <h1><b><?php echo $materialToDisplay->title; ?></b></h1>
            <h4><?php echo $materialToDisplay->price; ?> €</h4>
            <h6>Publié il y a <?php echo $materialToDisplay->date; ?> jours dans <?php echo $materialToDisplay->region; ?></h6>
            <h4><b>Détails</b></h4>
            <p><?php echo $materialToDisplay->description; ?></p>
            <h4><b>Information sur le vendeur :</b></h4>
            <div>
                <img src="<?php echo $materialToDisplay->imageCompany; ?>" class="rounded-circle" alt="profil" style="width: 60px;" id="profil">
                <label for="profil" class="ms-3"><b><a href="http://findwell/index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $materialToDisplay->idCompany; ?>"><?php echo $materialToDisplay->nameCompany; ?></a></b></label>
            </div>
            <label for="phone"><b>Téléphone:</b> </label>
            <p id="phone" class="d-inline"><?php echo $materialToDisplay->phone; ?></p>
            <br>
            <label for="phone"><b>Mail:</b> </label>
            <p id="phone" class="d-inline"><?php echo $materialToDisplay->mail; ?></p>
        </div>
    </div>
<?php } else {   //Ecran d'accueil des annonces ?>       
    <div class="row d-flex justify-content-around mb-4 mt-5 m-0">
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 30rem;">
            <img src="images/annonce/service.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Annonces de service</h5>
            </div>
            <form id="formAccess" action="index.php" method="get">
                <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                <input type="text" name="subcategory" value="service" class="d-none">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>
        
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 30rem;">
            <img src="images/annonce/outils.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Vente d'outils d'occasion</h5>
            </div>
            <form id="formAccess" action="index.php" method="get">
                <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                <input type="text" name="subcategory" value="occasion" class="d-none">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>

        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 30rem;">
            <img src="images/annonce/materiel.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Vente de matériaux</h5>
            </div>
            <form id="formAccess" action="index.php" method="get">
                <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                <input type="text" name="subcategory" value="materiel" class="d-none">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification, $scripts);
    else displayTemplateNotConnected($title, $content, $scripts);
    
?>
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
    <?php if(isConnected()){ ?>
    <br><a href="index.php?viewToDisplay=displayAnnonce&subcategory=service&action=displayAdd" class="btn btn-primary col-10 offset-1 offset-lg-0 col-lg-2">Ajouter votre service</a>
    <?php } ?>
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
<?php } else if(!is_null($servicesOfUser)){ ?>
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
                <?php foreach ($servicesOfUser as $service) { ?>
                <tr>
                    <td><img src="<?php if(!is_null($service->imageService[0])) echo $service->imageService[0]; else echo "/images/annonce/blank_image.jpg"; ?>" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td><?php echo $service->title; ?></td>
                    <td><?php echo $service->description; ?></td>  
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
    <?php if(isset($_SESSION['user']) && $serviceToDisplay->idUser == $_SESSION['user']->id){ ?>
        <br><a href="index.php?viewToDisplay=displayAnnonce&subcategory=service&edit=<?php echo $serviceToDisplay->idService; ?>" class="btn btn-primary col-10 offset-1 col-lg-3">Editer le service</a>
    <?php } ?>
    <div class="d-flex row justify-content-around mt-4">
        <div class="col-12 col-lg-5">
            <!-- Gallerie photo -->
            <!-- Photo principale -->
            <div class="main_view text-center">
                <img class="img-fluid" src="<?php echo $serviceToDisplay->imageService[0]; ?>" id="main" alt="IMAGE">
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <?php foreach ($serviceToDisplay->imageService as $image) { ?>
                
                <img src="<?php echo $image; ?>" onclick="change(this.src)">
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-5 col-12">
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
<?php } else if(!is_null($addService)){ //Ajout d'un service ?>

    <form id="formAddService" class="mb-3 mt-3" action="index.php?viewToDisplay=displayAnnonce&subcategory=service&action=add" method="post" enctype='multipart/form-data'>
        <h3 class="text-center mb-3 fw-bold">Informations sur le service</h3>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de votre annonce" required>
                                    <p id="errorTitle"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description de votre annonce" required></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>  
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo(s) de votre service</label>
                                    <input type="file" class="form-control" name="image[]" id="image" accept=".png, .jpg, .jpeg" multiple="multiple" required>
                                    <p id="errorImage"></p>
                                </div>
                            </div>                          
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" name="region" id="region" placeholder="Region où se trouve l'objet" required>
                                    <p id="errorRegion"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mail">Adresse mail</label>
                                    <input type="mail" class="form-control" name="mail" id="mail" placeholder="Adresse mail de contact" required>
                                    <p id="errorMail"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Numéro de contact" required>
                                    <p id="errorPhone"></p>
                                </div>
                            </div>                            
                        </div>
                        <h5>Categorie(s) du service</h5>
                        <?php foreach ($categoriesService as $category) { ?>
                        <div class="form-check">
                            <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                            <input type="checkbox" class="form-check-input" name="checkService[]" id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>">
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary">Ajouter le service</button>
                    </div>
                </div>
            </div>
        </div>        
    </form>
<?php } else if(!is_null($serviceToEdit) && $editPermission){ //Modification d'un service ?>

    <form id="formEditService" class="mb-3 mt-3" action="index.php?viewToDisplay=displayAnnonce&subcategory=service&action=edit" method="post" enctype='multipart/form-data'>
        <input class="d-none" type="text" name="idService" value="<?php echo $serviceToEdit->idService; ?>">
        <h3 class="text-center mb-3 fw-bold">Informations sur le service</h3>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de votre annonce" value="<?php echo $serviceToEdit->title; ?>" required>
                                    <p id="errorTitle"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description de votre annonce" required><?php echo $serviceToEdit->description; ?></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>  
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo(s) de votre service</label>
                                    <input type="file" class="form-control" name="image[]" id="image" accept=".png, .jpg, .jpeg" multiple="multiple" value="<?php echo $serviceToEdit->imageService; ?>" required>
                                    <p id="errorImage"></p>
                                </div>
                            </div>                          
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" name="region" id="region" placeholder="Region où se trouve l'objet" value="<?php echo $serviceToEdit->region; ?>" required>
                                    <p id="errorRegion"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mail">Adresse mail</label>
                                    <input type="mail" class="form-control" name="mail" id="mail" placeholder="Adresse mail de contact" value="<?php echo $serviceToEdit->mail; ?>" required>
                                    <p id="errorMail"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Numéro de contact" value="<?php echo $serviceToEdit->phone; ?>" required>
                                    <p id="errorPhone"></p>
                                </div>
                            </div>                            
                        </div>
                        <h5>Categorie(s) du service</h5>
                        <?php foreach ($categoriesService as $category) { ?>
                        <div class="form-check">
                            <label class="form-check-label" for="<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                            <input type="checkbox" class="form-check-input" name="checkService[]" id="<?php echo $category->id; ?>" value="<?php echo $category->id; ?>" <?php if(in_array($category->id, $serviceToEdit->idCategories)) echo "checked"; ?>>
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary">Modifier le service</button>
                    </div>
                </div>
            </div>
        </div>        
    </form>

<?php } else if(!is_null($occasions)){ //Annonces des outils d'occasion ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <?php if(isConnected()){ ?>
        <br><a href="index.php?viewToDisplay=displayAnnonce&subcategory=occasion&action=displayAdd" class="btn btn-primary col-2">Ajouter une annonce</a>
    <?php } ?>
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
                            <input type="text" name="subcategory" value="occasion" class="d-none">
                            <input type="text" name="occasionToDisplay" value="<?php echo $occasion->idOccasion; ?>" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else if(!is_null($occasionsOfUser)){ //Occasions d'un utilisateur spécifique ?>
    <div class="col-10 offset-1 mt-4 table-responsive">
        <?php if(isConnected()){ ?>
        <a href="index.php?viewToDisplay=displayAnnonce&subcategory=occasion&action=displayAdd" class="btn btn-primary col-2">Ajouter une annonce</a>
        <?php } ?>
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
                <?php foreach ($occasionsOfUser as $occasion) { ?>
                <tr>
                    <td><img src="<?php echo $occasion->imageOccasion[0]; ?>" style="max-width: 200px; max-height: 200px;" alt=""></td>
                    <td><?php echo $occasion->title; ?></td>
                    <td><b><?php echo $occasion->price; ?> €</b></td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="occasion" class="d-none">
                            <input type="text" name="occasionToDisplay" value="<?php echo $occasion->idOccasion; ?>" class="d-none">
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
    <?php if(isset($_SESSION['user']) && $occasionToDisplay->idUser == $_SESSION['user']->id){ ?>
        <br><a href="index.php?viewToDisplay=displayAnnonce&subcategory=occasion&edit=<?php echo $occasionToDisplay->idOccasion; ?>" class="btn btn-primary col-10 offset-1 col-lg-3">Editer l'annonce</a>
    <?php } ?>
    <div class="d-flex row justify-content-around mt-4">
        <div class="col-12 col-lg-5">
            <!-- Gallerie photo -->
            <!-- Photo principale -->
            <div class="main_view text-center">
                <img class="img-fluid" src="<?php echo $occasionToDisplay->imageOccasion[0]; ?>" id="main" alt="IMAGE" >
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <?php foreach ($occasionToDisplay->imageOccasion as $image) { ?>
                    <img src="<?php echo $image; ?>" onclick="change(this.src)">
                <?php } ?>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <h1><b><?php echo $occasionToDisplay->title; ?></b></h1>
            <h4><?php echo $occasionToDisplay->price; ?> €</h4>
            <h6>Publié <?php if($occasionToDisplay->date == 0) echo "aujourd'hui"; else if($occasionToDisplay->date == 1) echo "il y a ".$occasionToDisplay->date." jour"; else echo "il y a ".$occasionToDisplay->date." jours" ?> à <?php echo $occasionToDisplay->region; ?></h6>
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
<?php } else if(!is_null($addOccasion)){ //Ajout d'une occasion ?>

    <form id="formAddOccasion" class="mb-3 mt-3" action="index.php?viewToDisplay=displayAnnonce&subcategory=occasion&action=add" method="post" enctype='multipart/form-data'>
        <h3 class="text-center mb-3 fw-bold">Informations sur l'annonce</h3>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de votre annonce" required>
                                    <p id="errorTitle"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="price">Prix</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Prix de votre annonce" required>
                                    <p id="errorPrice"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description de votre annonce" required></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>  
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo(s) de votre annonce</label>
                                    <input type="file" class="form-control" name="image[]" id="image" accept=".png, .jpg, .jpeg" multiple="multiple" required>
                                    <p id="errorImage"></p>
                                </div>
                            </div>                          
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" name="region" id="region" placeholder="Region où se trouve l'objet" required>
                                    <p id="errorRegion"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mail">Adresse mail</label>
                                    <input type="mail" class="form-control" name="mail" id="mail" placeholder="Adresse mail de contact" required>
                                    <p id="errorMail"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Numéro de contact" required>
                                    <p id="errorPhone"></p>
                                </div>
                            </div>                            
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter l'annonce</button>
                    </div>
                </div>
            </div>
        </div>        
    </form>

<?php } else if(!is_null($occasionToEdit) && $editPermission){ //Modification d'une occasion ?>

    <form id="formEditOccasion" class="mb-3 mt-3" action="index.php?viewToDisplay=displayAnnonce&subcategory=occasion&action=edit" method="post" enctype='multipart/form-data'>
        <input class="d-none" type="text" name="idOccasion" value="<?php echo $occasionToEdit->idOccasion; ?>">
        <h3 class="text-center mb-3 fw-bold">Informations sur l'annonce</h3>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="title">Titre</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre de votre annonce" value="<?php echo $occasionToEdit->title; ?>" required>
                                    <p id="errorTitle"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="price">Prix</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Prix de votre annonce" value="<?php echo $occasionToEdit->price; ?>" required>
                                    <p id="errorPrice"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description de votre annonce" required><?php echo $occasionToEdit->description; ?></textarea>
                                    <p id="errorDescription"></p>
                                </div>
                            </div>  
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="image">Photo(s) de votre annonce</label>
                                    <input type="file" class="form-control" name="image[]" id="image" accept=".png, .jpg, .jpeg" multiple="multiple" required>
                                    <p id="errorImage"></p>
                                </div>
                            </div>                          
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" name="region" id="region" placeholder="Region où se trouve l'objet" value="<?php echo $occasionToEdit->region; ?>" required>
                                    <p id="errorRegion"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mail">Adresse mail</label>
                                    <input type="mail" class="form-control" name="mail" id="mail" placeholder="Adresse mail de contact" value="<?php echo $occasionToEdit->mail; ?>" required>
                                    <p id="errorMail"></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Numéro de contact" value="<?php echo $occasionToEdit->phone; ?>" required>
                                    <p id="errorPhone"></p>
                                </div>
                            </div>                            
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier l'annonce</button>
                    </div>
                </div>
            </div>
        </div>        
    </form>

<?php } else if(!is_null($categoriesMaterialsToDisplay)){  //Affichage des catégories de matériel ?>
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
<?php } else if(!is_null($companiesMaterialToDisplay)){  //Affichage des catégories de matériel ?>
    <a style="color: grey; text-decoration: none; font-size: large;" href="javascript:history.go(-1)"><i class="bi bi-arrow-return-left"></i> Retour en arrière</a>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']->type == "company"){?>
        <br><a href="index.php?viewToDisplay=displayAnnonce&subcategory=materiel&addMateriel=true&category=<?php echo $_GET['category'] ?>" class="btn btn-primary col-10 offset-1 col-lg-3">Inscrire mon entreprise à cette catégorie</a>
    <?php } ?>
    <div class="row d-flex justify-content-around mb-4 mt-4 m-0">
    <?php
        $cpt = 0;
        if(sizeof($companiesMaterialToDisplay) == 0){
            echo "<h3>Il n'y a pas encore d'entreprises dans cette categorie!</h3>";
        } else {
        foreach ($companiesMaterialToDisplay as $company) {
    ?>
            
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 18rem;">
            <img src="<?php echo $company->image; ?>" style="max-height:200px; max-width:280px; height:auto; width:auto;" class="card-img-top" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><b><?php echo $company->name; ?></b></h5>
                <p class="card-text">
                    <?php 
                        if ($company->rating == 0) {
                            echo "<b>Pas encore de note !</b>";
                        } 
                        else echo "<b>Note :</b> ".number_format($company->rating,1)." <i class='bi bi-star-fill text-warning'></i>";
                    ?>
                    <br>
                    <b>Région: </b><?php echo $company->city; ?>
                </p>
            </div>
            <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $company->id; ?>" class="btn btn-primary mb-2">Accéder</a>
        </div>          
        <?php }} ?>
    </div>
    </div>
<?php } else {   //Ecran d'accueil des annonces ?>       
    <?php if(isset($_GET['message'])){
        if($_GET['message'] == 1) { ?>
            <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                Votre annonce a bien été ajoutée
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else if($_GET['message'] == 2) { ?>
            <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                Votre annonce a bien été modifiée
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else if($_GET['message'] == 3) { ?>
            <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
                Votre annonce n'a pas pu être ajoutée
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
    } ?>
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
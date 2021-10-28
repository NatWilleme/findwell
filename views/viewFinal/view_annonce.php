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
            <h1><b><?php echo $serviceToDisplay->title; ?></b></h1> <?php //TODO CHANGER LE TITRE ?>
            <h6>Publié il y a 5 jours dans <?php echo $serviceToDisplay->region; ?></h6> <?php //TODO CHANGER LE TEMPS DEPUIS COMBIEN DE TEMPS EST DISPO L'ARTICLE ET LA REGION ?>
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
                <tr> <?php //TODO REMPLACER LES ANNONCES PAR CELLES DE LA DB ?>
                    <td><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/247021214_4604978756282197_3400176656525937962_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=c48759&_nc_ohc=RAMZqMIDNQoAX_C0mWN&_nc_ht=scontent-bru2-1.xx&oh=63092891132751959113842038aad2a3&oe=617A2ADC" style="max-width: 200px; max-height: 200px;" alt=""></td>
                    <td>Lot d'outils de plomberie</td>
                    <td><b>50 €</b></td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="occasion" class="d-none">
                            <input type="text" name="occasionToDisplay" value="true" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/216898043_4176518545789196_7653711590485020179_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=c48759&_nc_ohc=ucEGQcJtrF0AX-Yq3g6&tn=wJavlCUQrOPtVtHG&_nc_ht=scontent-bru2-1.xx&oh=93a098b9f7f7cf3cc51010bf3dd82e3a&oe=617A045A" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td>Coffret a outils CRV Pro 171 pièces neuf</td>
                    <td><b>75 €</b></td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="occasion" class="d-none">
                            <input type="text" name="occasionToDisplay" value="true" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t39.30808-6/247054568_3035077803439634_5599501352136373279_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=843cd7&_nc_ohc=NXwzYQDDcOkAX_EaCOa&_nc_ht=scontent-bru2-1.xx&oh=686d58789e4d2ed1d59db0404058b6a8&oe=6178F499" alt="" style="max-width: 200px; max-height: 200px;"></th>
                    <td>Servante d’atelier 582 outils XXL avec clé Dynamométrique</td>
                    <td><b>55€</b></td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="occasion" class="d-none">
                            <input type="text" name="occasionToDisplay" value="true" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
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
                <img class="img-fluid" src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/247021214_4604978756282197_3400176656525937962_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=c48759&_nc_ohc=RAMZqMIDNQoAX_C0mWN&_nc_ht=scontent-bru2-1.xx&oh=63092891132751959113842038aad2a3&oe=617A2ADC" id="main" alt="IMAGE" style="max-width: 500px; max-height: 500px;">
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/247021214_4604978756282197_3400176656525937962_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=c48759&_nc_ohc=RAMZqMIDNQoAX_C0mWN&_nc_ht=scontent-bru2-1.xx&oh=63092891132751959113842038aad2a3&oe=617A2ADC" onclick="change(this.src)">
                <img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/p180x540/245994250_4462493267131128_7641823295377069576_n.jpg?_nc_cat=107&ccb=1-5&_nc_sid=c48759&_nc_ohc=2Fo9VDt-7h4AX9fMZdW&_nc_ht=scontent-bru2-1.xx&oh=2bacfcd9447bd21e6dc5431355022a13&oe=617A61A6" onclick="change(this.src)">
                <img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/p180x540/245990138_4478861788899296_1951181311720254673_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=c48759&_nc_ohc=C0zjeQobJqsAX9aMooV&_nc_ht=scontent-bru2-1.xx&oh=22be9e5c40aa6238944eb4a0c0cbc017&oe=617AD7DE" onclick="change(this.src)">
            </div>
        </div>
        <div class="col-5">
            <h1><b>Lot d'outils de plomberie</b></h1> <?php //TODO CHANGER LE TITRE ?>
            <h4>50€</h4> <?php //TODO CHANGER LE PRIX ?>
            <h6>Publié il y a 5 jours dans Charleroi</h6> <?php //TODO CHANGER LE TEMPS DEPUIS COMBIEN DE TEMPS EST DISPO L'ARTICLE ET LA REGION ?>
            <h4><b>Détails</b></h4>
            <p>Outils de plomberie en bon état, utilisé peu de fois. A venir chercher sur Charleroi</p>
            <h4><b>Information sur le vendeur :</b></h4>
            <div>
                <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/1840612-image-profil-icon-male-icon-human-or-people-sign-and-symbol-vector-gratuit-vectoriel.jpg" class="rounded-circle" alt="profil" style="width: 60px;" id="profil">
                <label for="profil" class="ms-3"><b>Marc Henry</b></label>
            </div>
            <label for="phone"><b>Téléphone:</b> </label>
            <p id="phone" class="d-inline">0495008855</p>
            <br>
            <label for="phone"><b>Mail:</b> </label>
            <p id="phone" class="d-inline">test@gmail.com</p>
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
                <tr> <?php //TODO REMPLACER LES ANNONCES PAR CELLES DE LA DB ?>
                    <td><img src="https://vss.astrocenter.fr/habitatpresto/pictures/29602738-adobestock-162090178-copie.jpeg" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td>100 dalles de carrelage imitation parquet</td>
                    <td>Carrelage imitation parquet, parfait pour un style moderne et chaleureux.</td>
                    <td>
                        <form action="index.php" method="get">
                            <input type="text" name="viewToDisplay" value="displayAnnonce" class="d-none">
                            <input type="text" name="subcategory" value="materiel" class="d-none">
                            <input type="text" name="materiel" value="true" class="d-none">
                            <button class="btn btn-primary">Accéder</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/216898043_4176518545789196_7653711590485020179_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=c48759&_nc_ohc=ucEGQcJtrF0AX-Yq3g6&tn=wJavlCUQrOPtVtHG&_nc_ht=scontent-bru2-1.xx&oh=93a098b9f7f7cf3cc51010bf3dd82e3a&oe=617A045A" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td>Coffret a outils CRV Pro 171 pièces neuf</td>
                    <td><b>75 €</b></td>
                    <td><button class="btn btn-primary">Accéder</button></td>
                </tr>
                <tr>
                    <td><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t39.30808-6/247054568_3035077803439634_5599501352136373279_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=843cd7&_nc_ohc=NXwzYQDDcOkAX_EaCOa&_nc_ht=scontent-bru2-1.xx&oh=686d58789e4d2ed1d59db0404058b6a8&oe=6178F499" alt="" style="max-width: 200px; max-height: 200px;"></th>
                    <td>Servante d’atelier 582 outils XXL avec clé Dynamométrique</td>
                    <td><b>55€</b></td>
                    <td><button class="btn btn-primary">Accéder</button></td>
                </tr>
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
                <img class="img-fluid" src="https://vss.astrocenter.fr/habitatpresto/pictures/29602738-adobestock-162090178-copie.jpeg" id="main" alt="IMAGE" style="max-width: 500px; max-height: 500px;">
            </div>
    
            <!-- Photo en miniature en dessous -->
            <div class="side_view">
                <img src="https://vss.astrocenter.fr/habitatpresto/pictures/29602738-adobestock-162090178-copie.jpeg" onclick="change(this.src)">
                <img src="https://www.carra-carrelage.fr/Files/111872/Img/11/DALLE-MORE-carrelage-exterieur-40x120-ep-2-cm-BEIGE-effet-bois.png" onclick="change(this.src)">
                <img src="https://www.carrelages-grilli.be/img/cms/carrelage-parquet-bois-grilli.JPG" onclick="change(this.src)">
            </div>
        </div>
        <div class="col-5">
            <h1><b>100 dalles de carrelage imitation parquet</b></h1> <?php //TODO CHANGER LE TITRE ?>
            <h4>500€</h4> <?php //TODO CHANGER LE PRIX ?>
            <h6>Publié il y a 5 jours dans Charleroi</h6> <?php //TODO CHANGER LE TEMPS DEPUIS COMBIEN DE TEMPS EST DISPO L'ARTICLE ET LA REGION ?>
            <h4><b>Détails</b></h4>
            <p>Carrelage imitation parquet, parfait pour un style moderne et chaleureux.</p>
            <h4><b>Information sur le vendeur :</b></h4>
            <div>
                <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/1840612-image-profil-icon-male-icon-human-or-people-sign-and-symbol-vector-gratuit-vectoriel.jpg" class="rounded-circle" alt="profil" style="width: 60px;" id="profil">
                <label for="profil" class="ms-3"><b>Mon entreprise</b></label>
            </div>
            <label for="phone"><b>Téléphone:</b> </label>
            <p id="phone" class="d-inline">0495008855</p>
            <br>
            <label for="phone"><b>Mail:</b> </label>
            <p id="phone" class="d-inline">monentreprise@gmail.com</p>
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
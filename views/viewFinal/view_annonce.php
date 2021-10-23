<?php
    $title = "Annonces";
    ob_start();	
?>

<div class="container-fluid ps-0 pe-0">

<?php if(!is_null($categoriesToDisplay)){ //Annonce des services ?>
        <div class="row d-flex justify-content-around mb-4 mt-4 m-0">
        <?php foreach ($categoriesToDisplay as $category) { ?>
                <div class="card border border-dark pt-2 ms-3 me-3" style="width: 18rem;">
                    <img src="<?php echo $category->image; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category->name; ?></h5>
                    </div>
                    <form id="formAccess" action="" method="post">
                        <button class="btn btn-primary mb-2 col-12">Accéder</button>
                    </form>
                </div> 
        <?php } ?>  
        </div>
 <?php } else if(!is_null($occasions)){ //Annonces des outils d'occasion ?>
    <div class="col-10 offset-1 mt-4">
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
                <tr>
                    <th scope="row"><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/247021214_4604978756282197_3400176656525937962_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=c48759&_nc_ohc=RAMZqMIDNQoAX_C0mWN&_nc_ht=scontent-bru2-1.xx&oh=63092891132751959113842038aad2a3&oe=617A2ADC" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td>Lot d'outils de plomberie</td>
                    <td><b>50 €</b></td>
                    <td><button class="btn btn-primary">Accéder</button></td>
                </tr>
                <tr>
                    <th scope="row"><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t45.5328-4/s960x960/216898043_4176518545789196_7653711590485020179_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=c48759&_nc_ohc=ucEGQcJtrF0AX-Yq3g6&tn=wJavlCUQrOPtVtHG&_nc_ht=scontent-bru2-1.xx&oh=93a098b9f7f7cf3cc51010bf3dd82e3a&oe=617A045A" style="max-width: 200px; max-height: 200px;" alt=""></th>
                    <td>Coffret a outils CRV Pro 171 pièces neuf</td>
                    <td><b>75 €</b></td>
                    <td><button class="btn btn-primary">Accéder</button></td>
                </tr>
                    <tr>
                    <th scope="row"><img src="https://scontent-bru2-1.xx.fbcdn.net/v/t39.30808-6/247054568_3035077803439634_5599501352136373279_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=843cd7&_nc_ohc=NXwzYQDDcOkAX_EaCOa&_nc_ht=scontent-bru2-1.xx&oh=686d58789e4d2ed1d59db0404058b6a8&oe=6178F499" alt="" style="max-width: 200px; max-height: 200px;"></th>
                    <td>Servante d’atelier 582 outils XXL avec clé Dynamométrique</td>
                    <td><b>55€</b></td>
                    <td><button class="btn btn-primary">Accéder</button></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } else {   //Ecran d'accueil des annonces ?>       
    <div class="row d-flex justify-content-around mb-4 mt-5 m-0">
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 30rem;">
            <img src="images/annonce/service.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Annonces de service</h5>
            </div>
            <form id="formAccess" action="index.php?viewToDisplay=displayAnnonce&subcategory=service" method="post">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>
        
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 30rem;">
            <img src="images/annonce/outils.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Vente d'outils d'occasion</h5>
            </div>
            <form id="formAccess" action="index.php?viewToDisplay=displayAnnonce&subcategory=occasion" method="post">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>

        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 30rem;">
            <img src="images/annonce/materiel.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center fs-3">Vente de matériaux</h5>
            </div>
            <form id="formAccess" action="index.php?viewToDisplay=displayAnnonce&subcategory=materiel" method="post">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
    
?>
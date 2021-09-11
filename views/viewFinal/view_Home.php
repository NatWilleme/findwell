<?php
    $title = "Accueil";
    ob_start();	
?>

<div class="container-fluid ps-0 pe-0">
    


    <div id="carouselExampleIndicators" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
                <img src="images/HomePage/carousel1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="images/HomePage/carousel2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="images/HomePage/carousel3.png" class="d-block w-100" alt="...">
            </div>
            <?php foreach ($ads as $ad) { ?>
            <div class="carousel-item" data-bs-interval="4000">
            <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $ad->id_comp; ?>">
                <img src="<?php echo $ad->image; ?>" class="d-block w-100" alt="...">
            </a>
            </div>   
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide d-lg-none d-sm-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
                <img src="images/HomePage/carousel1Mobile.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="images/HomePage/carousel2Mobile.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="images/HomePage/carousel3Mobile.png" class="d-block w-100" alt="...">
            </div>
            <?php foreach ($ads as $ad) { ?>
            <div class="carousel-item" data-bs-interval="4000">
            <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $ad->id_comp; ?>">
                <img src="<?php echo $ad->image; ?>" class="d-block w-100" alt="...">
            </a>
            </div>   
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Les tuiles -->
    <div class="row mb-5 m-0">

        <div class="col-xl-2"></div>

        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-8 col-8 position-relative tuile">
        <div class="containerPerso">
            <a href="index.php?viewToDisplay=displayCategoriesList&category=Gros Travaux">  
                <img src="images/HomePage/card1.jpg" alt="Avatar" class="card-img-top border border-dark rounded border-2 image">
                <div class="overlay">Trouvez l'entreprise qui vous correspond pour votre projet de A à Z.</div>
            </a>
        </div>
        <label class="fw-bold fst-italic fs-3" style="text-align: center;">Gros travaux</label>  
        </div>

        <div class="col-xl-1"></div>

        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-8 col-8 position-relative tuile">
        <div class="containerPerso">
            <a href="index.php?viewToDisplay=displayCategoriesList&category=Petits travaux">  
                <img src="images/HomePage/card2.jpg" alt="Avatar" class="card-img-top border border-dark rounded border-2 image">
                <div class="overlay">Effectuez vos petits travaux d'un simple clic.</div>
            </a>
        </div>
        <label class="fw-bold fst-italic fs-3">Petits travaux</label>
        </div>

        <div class="col-xl-1"></div>

        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-8 col-8 position-relative tuile">
        <div class="containerPerso">
            <a href="index.php?viewToDisplay=displayCategoriesList&category=Dépannage d'urgence">  
                <img src="images/HomePage/card3.jpg" alt="Avatar" class="card-img-top border border-dark rounded border-2 image">
                <div class="overlay">Accédez aux entreprises disponible 24h/24h.</div>
            </a>
        </div>
        <label class="fw-bold fst-italic fs-3">Dépannage d'urgence</label>
        </div>

        <div class="col-xl-1"></div>

    </div>


    <div class="row mt-5 mb-5 m-0">
        <div class="col-1"></div>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="d-flex mb-5">
                <div class="flex-shrink-0">
                    <img src="images/HomePage/rapide.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Rapide</h3>
                    <p class="fst-italic fs-5">Trouvez rapidement ce que vous recherchez en utilisant la plateforme findwell</p>
                </div>
            </div>

            <div class="d-flex mb-5">
                <div class="flex-shrink-0">
                    <img src="images/HomePage/assistance.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Assistance</h3>
                    <p class="fst-italic fs-5">Bénéficiez d’une assistance pour un suivi des travaux le plus optimal possible</p>
                </div>
            </div>

            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="images/HomePage/satisfaction.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Satisfaction</h3>
                    <p class="fst-italic 
                    fs-5">Choisissez parmis un large panel des meilleurs entreprises de la région</p>
                </div>
            </div>
        </div>
        <div class="col-1"></div>

        <!-- Video youtube -->
        <!-- <iframe class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>       -->
    </div>

    <div class="row mt-5 mb-5 d-flex justify-content-around col-12">
        
        <div class="card col-4">
            <img src="images/imagesCategories/carreleur.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        <div class="card col-4">
            <img src="images/imagesCategories/carreleur.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

    
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
    
?>
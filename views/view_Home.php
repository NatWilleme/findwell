<?php
$title = "Accueil";
$scripts = "<script src=\"https://vjs.zencdn.net/7.18.1/video.min.js\"></script>";
ob_start();
?>

<div class="container-fluid ps-0 pe-0">


    <div>
        <div id="carouselHomePC" class="carousel slide d-none d-lg-block col-10 offset-1" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="images/HomePage/carousel1.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/HomePage/carousel2.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/HomePage/carousel3.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/HomePage/carousel4.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <?php foreach ($ads as $ad) { ?>
                    <div class="carousel-item" data-bs-interval="4000">
                        <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $ad->id_comp; ?>">
                            <img src="<?php echo $ad->imagePC; ?>" class="d-block w-100" alt="...">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHomePC" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselHomePC" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div id="carouselHomeMobile" class="carousel slide d-lg-none d-sm-block" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="images/HomePage/carousel1Mobile.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/HomePage/carousel2Mobile.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/HomePage/carousel3Mobile.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/HomePage/carousel4Mobile.png?ver=1.2" class="d-block w-100" alt="...">
                </div>
                <?php foreach ($ads as $ad) { ?>
                    <div class="carousel-item" data-bs-interval="4000">
                        <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $ad->id_comp; ?>">
                            <img src="<?php echo $ad->imageMobile; ?>" class="d-block w-100" alt="...">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHomeMobile" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselHomeMobile" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Les tuiles -->
        <div class="row d-flex justify-content-lg-around justify-content-center mt-2 mt-lg-0 mx-0">



            <div class="col-8 col-lg-2 col-md-3 mb-3">
                <div class="containerPerso tuile">
                    <a href="index.php?viewToDisplay=displayCategoriesList&category=Gros Travaux">
                        <img src="images/HomePage/card1.jpg" alt="Avatar" class="border border-dark rounded border-2 image">
                        <div class="overlay">
                            <div class="text">Trouvez l'entreprise qui vous correspond pour votre projet de A à Z.</div>
                        </div>
                    </a>
                    <p class="fw-bold fst-italic fs-3 text-center">Gros travaux</p>
                </div>
            </div>



            <div class="col-8 col-lg-2 col-md-3 mb-3">
                <div class="containerPerso tuile">
                    <a href="index.php?viewToDisplay=displayCategoriesList&category=Petits travaux">
                        <img src="images/HomePage/card2.jpg" alt="Avatar" class="border border-dark rounded border-2 image">
                        <div class="overlay">
                            <div class="text">Effectuez vos petits travaux d'un simple clic.</div>
                        </div>
                    </a>
                    <p class="fw-bold fst-italic fs-3 text-center">Petits travaux</p>
                </div>
            </div>


            <div class="col-8 col-lg-2 col-md-3 mb-3">
                <div class="containerPerso tuile">
                    <a href="index.php?viewToDisplay=displayAnnonce&subcategory=service">
                        <img src="images/HomePage/card3.jpg" alt="Avatar" class="border border-dark rounded border-2 image">
                        <div class="overlay">
                            <div class="text">Accédez à nos bricoleurs.</div>
                        </div>
                    </a>
                    <p class="fw-bold fst-italic fs-3 text-center">Bricoleurs</p>
                </div>
            </div>

        </div>
    </div>
    <div class="row col-12 mx-auto p-0 d-none d-lg-block">
        <img class="p-0" src="images/HomePage/banner.png" alt="">
    </div>
    <div class="row col-12 mx-auto p-0 d-lg-none d-sm-block">
        <img class="p-0" src="images/HomePage/bannerMobile.png" alt="">
    </div>

    <div class="row g-0 col-12 mt-5 d-flex justify-content-center">
        <div class="col-8 col-md-3 my-auto fadeInLeft">
            <img src="images/icons/worker.jpg" title="Painter man vector created by iconicbestiary" class="col-12">
        </div>
        <div class="col-10 col-lg-6 offset-lg-1 fadeInUp4">
            <video id="my-video" class="video-js vjs-big-play-centered col-12 border border-5 border-dark" height="500" controls preload="auto" poster="images/preview.png" data-setup="{}">
                <source src="images/findwell.mp4" type="video/mp4" />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                </p>
            </video>
        </div>
    </div>

    <div class="row mt-5 mb-5 m-0">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 offset-lg-1">
            <div class="d-flex mb-5 fadeInUp1">
                <div class="flex-shrink-0">
                    <img src="images/HomePage/rapide.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Rapide</h3>
                    <p class="fst-italic fs-5">Trouvez rapidement ce que vous recherchez en utilisant la plateforme findwell</p>
                </div>
            </div>

            <div class="d-flex mb-5 fadeInUp2">
                <div class="flex-shrink-0">
                    <img src="images/HomePage/assistance.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Assistance</h3>
                    <p class="fst-italic fs-5">Bénéficiez d’une assistance pour un suivi des travaux le plus optimal possible</p>
                </div>
            </div>

            <div class="d-flex fadeInUp3">
                <div class="flex-shrink-0">
                    <img src="images/HomePage/satisfaction.png" width="100px">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Satisfaction</h3>
                    <p class="fst-italic 
                    fs-5">Choisissez parmis un large panel des meilleurs entreprises de la région</p>
                </div>
            </div>
        </div>
        <div class="col-10 col-lg-5 offset-1 my-auto fadeInRight">
            <img src="images/icons/worker2.jpg" title="Engineering worker vector created by pch.vector" class="col-12">
        </div>


    </div>

    <div class="row mt-5 mb-5 justify-content-around" style="--bs-gutter-x: 0;">
        <div class="mb-5 text-center p-4" style="background-color: #2e323c; color: white;">
            <h1 class="col-12 col-lg-10 offset-lg-1" style="word-spacing: -2px; font-size: 2em;"><i>Peu importe votre recherche dans le domaine de la construction ou de la rénovation, Findwell vous accompagne dans vos projets</i></h1>
        </div>

        <div class="card col-10 col-lg-4 backInLeft">
            <img src="images/HomePage/satisfaction2.png" class="card-img-top">
            <div class="card-body pt-0">
                <p class="card-text">
                <h5 class="fw-bold">Notre engagement pour votre satisfaction</h5>
                Chacune des entreprises présentes sur la plateforme a été vérifiée et confirmée au préalable.
                </p>
            </div>
        </div>
        <div class="card col-10 col-lg-4 backInRight">
            <img src="images/HomePage/assistance2.png" class="card-img-top">
            <div class="card-body pt-0">
                <p class="card-text">
                <h5 class="fw-bold">Une assistance à tout moment</h5>
                N'hésitez pas à contacter notre assistance si vous avez quelconques questions.
                </p>
            </div>
        </div>
    </div>



</div>

<?php
$content = ob_get_clean();
if (isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification, $scripts);
else displayTemplateNotConnected($title, $content, $scripts);

?>
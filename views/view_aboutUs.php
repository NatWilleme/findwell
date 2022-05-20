<?php
    $title = "Qui sommes-nous ?";
    ob_start();	
?>

<div class="container-fluid p-0">
    <div id="carouselAboutUs" class="carousel slide col-12 d-none d-lg-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <img src="images/quisommesnous1.gif" width="100%" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="6000">
                <img src="images/quisommesnous2.gif" width="100%" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="6000">
                <img src="images/quisommesnous3.gif" width="100%" alt="">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAboutUs" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAboutUs" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div id="carouselAboutUs" class="carousel slide col-12 d-lg-none d-sm-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <img src="images/quisommesnous1Mobile.gif" width="100%" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="6000">
                <img src="images/quisommesnous2Mobile.gif" width="100%" alt="">
            </div>
            <div class="carousel-item" data-bs-interval="6000">
                <img src="images/quisommesnous3Mobile.gif" width="100%" alt="">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAboutUs" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAboutUs" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
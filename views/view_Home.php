<?php
    $title = "Contact";
    ob_start();	
?>

<div class="container-fluid ps-0 pe-0">
    <div class="bg-image" style="background-image: url('../images/HomePage/imageAccueil.jpg'); background-size: cover; height: 800px;">
        <h1 class=" ms-5 fst-italic text-white">Qu'est-ce que Findwell ?</h1>
        <p class="mt-3 ms-5 fs-4" style="color: white;">
        Findwell est une plateforme communautaire permettant <br>
        de faciliter la recherche d’une entreprise au moment <br>
        où l’on en a le plus besoin ! 
        </p>
        <p class="mt-3 ms-5 fs-4 text-white">
        Que ce soit pour des gros travaux, des petits travaux, peut <br>
        importe la demande, vous trouverez ce que vous recherchez sur Findwell !
        </p>
    </div>

    <!-- Les tuiles -->
    <div class="row mb-5">

        <div class="col-2"></div>

        <div class="col-2 position-relative" style="border: none;  bottom: 100px;">
            <a href="../controllers/controller_categoriesList.php?category=Gros Travaux"><img src="../images/HomePage/card1.jpg" class="img-thumbnail card-img-top border border-dark rounded border-2" alt=""></a>
            <label class="fst-italic fs-4">Gros travaux</label>
        </div>

        <div class="col-1"></div>

        <div class="col-2 position-relative" style="border: none; bottom: 100px;">
            <a href="../controllers/controller_categoriesList.php?category=Petits travaux"><img src="../images/HomePage/card2.jpg" class="img-thumbnail card-img-top border border-dark rounded border-2" alt=""></a>
            <label class="fst-italic fs-4">Petits travaux</label>
        </div>

        <div class="col-1"></div>

        <div class="col-2 position-relative" style="border: none; bottom: 100px;">
            <a href="../controllers/controller_categoriesList.php?category=Dépannage d'urgence"><img src="../images/HomePage/card3.jpg" class="img-thumbnail card-img-top border border-dark rounded border-2" alt=""></a>
            <label class="fst-italic fs-4">Dépannage d'urgence</label>
        </div>

        <div class="col-1"></div>

    </div>

    <div class="row mt-5 mb-5">
        <div class="col-1"></div>
        <div class="col-4">
            <div class="d-flex mb-5">
                <div class="flex-shrink-0">
                    <img src="../images/HomePage/rapide.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Rapide</h3>
                    <p class="fst-italic fs-5">Trouvez rapidement ce que vous recherchez en utilisant la plateforme findwell</p>
                </div>
            </div>

            <div class="d-flex mb-5">
                <div class="flex-shrink-0">
                    <img src="../images/HomePage/assistance.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Assistance</h3>
                    <p class="fst-italic fs-5">Bénéficiez d’une assistance pour un suivi des travaux le plus optimal possible</p>
                </div>
            </div>

            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="../images/HomePage/satisfaction.png" width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="fw-bold">Satisfaction</h3>
                    <p class="fst-italic fs-5">Choisissez parmis un large panel des meilleurs entreprises de la région</p>
                </div>
            </div>
        </div>
        <div class="col-1"></div>

        <!-- Video youtube -->
        <div class="col-6">
            <iframe width="800" height="500" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require_once("../templates/templateConnected.php");
?>
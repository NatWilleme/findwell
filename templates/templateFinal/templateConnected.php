<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-TW2FJRC3N5"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-TW2FJRC3N5');
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Findwell est une plateforme communautaire permettant de trouver facilement une entreprise pour vos projets de rénovation ou de construction.">
  <meta name="application-name" content="Findwell">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css?1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
  <link  href="/node_modules/cropperjs/dist/cropper.css" rel="stylesheet">

  <title><?php echo $title; ?></title>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    footer {
      margin-top: auto;
    }
  </style>
</head>

<body>

  <!-- First Navbar -->
  <nav class="navbar navbar-expand-lg border-bottom border-2 border-dark firstNavbar">
    <div class="container-fluid d-flex justify-content-end">

      <div>

        <div class="dropdown pe-3">
          <button class="btn dropdown-toggle position-relative" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_SESSION['user']->type == "admin" && $notification != 0) { ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $notification; ?>
                <span class="visually-hidden">Entreprise à confirmer</span>
              </span>
            <?php } ?>
            <img class="rounded" src="<?php if ($_SESSION['user']->image != "") echo $_SESSION['user']->image;
                                      else echo "images/upload/photos_profils/default-profil.jpg" ?>" alt="profil" style="width: 50px;">
          </button>
          <ul class="dropdown-menu shadow" style="transform: translate3d(-60px, 0px, 0px);" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="index.php?viewToDisplay=displayEditProfil">Mes informations <i class="bi bi-info-circle-fill text-secondary"></i></a></li>
            <li><a class="dropdown-item" href="index.php?viewToDisplay=displayFavorite">Mes favoris <i class="bi bi-star-fill text-warning"></i></a></li>
            <?php if ($_SESSION['user']->type == "admin") { ?>
              <li><a class="dropdown-item" href="index.php?viewToDisplay=displayAdminPanel">Gestion du site <?php if ($notification != 0) { ?><span class="badge bg-primary"><?php echo $notification; ?></span><?php } else { ?><i class="bi bi-gear-fill"></i><?php } ?></a></li>
            <?php } ?>
            <li><a href="index.php?viewToDisplay=displayAnnonce&subcategory=occasion&idUser=<?php echo $_SESSION['user']->id; ?>" class="dropdown-item">Mes occasions</a></li>
            <li><a href="index.php?viewToDisplay=displayAnnonce&subcategory=service&idUser=<?php echo $_SESSION['user']->id; ?>" class="dropdown-item">Mes services</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="index.php?disconnect=true">Se déconnecter <i class="bi bi-box-arrow-right"></i></a></li>
          </ul>
        </div>

      </div>

    </div>
  </nav>



  <!-- Second Navbar -->
  <nav class="navbar navbar-expand-lg border-bottom border-2 border-dark" style="background-color: #FFD338">
    <div class="container-fluid">
      <!-- Logo -->

      <!-- PC -->
      <div class="col-1">
        <a class="navbar-brand mt-2 mt-lg-0 d-none d-md-block" href="index.php">
          <img src="images/logo1.png" height="80" loading="lazy" class="animate__animated  animate__flip ms-3" />
        </a>
      </div>

      <!-- Mobile -->
      <div class="col-12 d-md-none d-flex justify-content-center">
        <a class="btn btn-secondary col-10" href="index.php"><i class="bi bi-house-fill"></i></a>
      </div>

      <!-- END Logo -->


      <div class="col-12 col-md-4 offset-md-2 d-flex justify-content-center">
        <div class="bg-light rounded rounded-pill shadow-sm col-10 mt-3 mt-lg-0">
          <form action="index.php?viewToDisplay=displaySearch" method="POST" class="d-flex">
            <div class="input-group">
              <input style="font-style: italic;" type="search" id="searchInput" aria-describedby="button-addon1" name="company" class="form-control border-0 rounded rounded-pill bg-light" placeholder="Rechercher..">
              <input type="text" class="d-none" name="location">
              <div class="input-group-append">
                <button id="button-addon1" type="submit" class="btn btn-link text-primary animate__animated animate__rubberBand"><i class="bi bi-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row mt-3 mt-lg-0 d-flex justify-content-center col-12 col-md-4">
        <div class="col-5 text-center pulseOnHover my-auto">
          <a href="index.php?searchAll=true">
            <img src="/images/icons/book.png" width="40px">
            <div>
              <span class="nav-link active text-dark" aria-current="page">Toutes les entreprises</span>
            </div>
          </a>
        </div>
        <div class="col-1 myBorderColor"></div>
        <div class="col-5 text-center pulseOnHover my-auto">
          <a href="index.php?viewToDisplay=displayContact">
            <img src="/images/icons/contact2.png" width="40px">
            <div>
              <span class="nav-link text-dark">Nous contacter</span>
            </div>
          </a>
        </div>
      </div>


    </div>
  </nav>
  <!-- Second Navbar -->




  <!-- CONTENU -->
  <?php echo $content; ?>

  <!-- FOOTER -->
  <footer class="footer text-center" id="footer" style="background-color: #FFD338;">

    <div class="container pt-1">
      <div class="row">
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <ul class="list-unstyled mb-0">
            <li>
              <a href="index.php?viewToDisplay=displayAboutUs" class="text-dark footer-link">À propos de nous</a>
            </li>
            <li>
              <a href="index.php?viewToDisplay=displayConfidential" class="text-dark footer-link">Politique de confidentialité</a>
            </li>
            <li>
              <a href="index.php?viewToDisplay=displayCGV" class="text-dark footer-link">Conditions générales de vente</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <a class="fs-1 text-dark footer-link" target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/findwell.be" role="button">
            <i class="bi bi-facebook"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      ©<?php echo date("Y"); ?> Copyright:
      <a class="text-reset fw-bold" href="https://findwell.be/">findwell.be</a>
    </div>
    <!-- Copyright -->

  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/location.js"></script>
  <script src="js/observerApi.js"></script>
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/cropperjs"></script>

  <?php if (isset($scripts) && $scripts != '') echo $scripts; ?>

</body>

</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Findwell</title>
    <style>
      body{
        font-family: 'Roboto', sans-serif;
      }
    </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg border-bottom border-2 border-dark" style="background-color: #FFD338">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button"> <i class="fas fa-bars"></i></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Logo -->
        <a class="navbar-brand mt-2 mt-lg-0" href="../controllers/controller_home.php">
          <img src="../images/logo1.png" height="70" alt="" loading="lazy">
        </a>
      </div>
      
      <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-4 mb-4">
        <form action="../controllers/controller_search.php" method="get">
          <div class="input-group">
            <input type="search" aria-describedby="button-addon1" name="company" class="form-control border-0 rounded rounded-pill bg-light">
            <div class="input-group-append">
              <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="bi bi-search"></i></button>
            </div>
          </div>
        </form>
      </div>

        <div class="dropdown pe-3 ms-5">
        <button class="btn dropdown-toggle position-relative" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if($_SESSION['user']->type == "admin" && $notification != 0){ ?>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo $notification; ?>
            <span class="visually-hidden">Entreprise à confirmer</span>
          </span>
          <?php } ?>
          <img class="rounded" src="<?php if($_SESSION['user']->image != "") echo $_SESSION['user']->image; else echo "../images/upload/photos_profils/default-profil.jpg" ?>" alt="profil" style="width: 50px;">
        </button>
        <ul class="dropdown-menu shadow" style="transform: translate3d(-60px, 0px, 0px);" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="../controllers/controller_editProfil.php">Mes informations  <i class="bi bi-info-circle-fill text-secondary"></i></a></li>
          <li><a class="dropdown-item" href="../controllers/controller_favorites.php">Mes favoris  <i class="bi bi-star-fill text-warning"></i></a></li>
          <?php if($_SESSION['user']->type == "admin") { ?>
            <li><a class="dropdown-item" href="../controllers/controller_adminPanel.php">Gestion du site  <?php if($notification != 0) { ?><span class="badge bg-primary"><?php echo $notification; ?></span><?php } else {?><i class="bi bi-gear-fill"></i><?php } ?></a></li>
          <?php } ?>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="../controllers/controller_login.php?disconnect=true">Se déconnecter  <i class="bi bi-box-arrow-right"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->



      
  <!-- CONTENU -->
  <?php echo $content; ?>

  <!-- FOOTER -->
  <footer class="footer text-center pt-2 pb-2 border-top border-2 border-dark fixed-bottom" style="background-color : #FFD338;">
      <div class="container">
          <span class="text-muted">footer</span>
      </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
  <?php if(isset($scripts)) echo $scripts; ?>

</body>
</html>
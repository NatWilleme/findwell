<!DOCTYPE html>
<html lang="fr" class='min-vh-100'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $title; ?></title>
    <style>
      body{
        font-family: 'Roboto', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }    
      footer{
        margin-top: auto;
      }  
    </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg border-bottom border-2 border-dark" style="background-color: #FFD338">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
          <img
            src="images/logo1.png"
            height="80"
            alt=""
            loading="lazy"
          />
        </a>
      </div>
      <a class="btn btn-secondary d-lg-none col-sm-2" href="index.php"><i class="bi bi-house-fill"></i></a>
      <!-- Right elements -->
      <div class="p-1 me-2 bg-light rounded rounded-pill shadow-sm ">
        <form action="index.php" method="get">
          <div class="input-group">
            <input type="text" name="viewToDisplay" value="displaySearch" style="display: none;">
            <input type="search" id="searchInput" aria-describedby="button-addon1" name="company" class="form-control border-0 rounded rounded-pill bg-light">
            <div class="input-group-append">
              <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="bi bi-search"></i></button>
            </div>
          </div>
        </form>
      </div>
      <div class="d-flex align-items-center">
        <!-- Se connecter -->
        <a
          class="d-flex align-items-center text-decoration-none me-4 d-none d-lg-block"
          href="index.php?viewToDisplay=displayConnexion"
          style="color: black;"
        >
          <i class="bi bi-lock-fill pe-1" style="font-size: 1.5rem; color: black;"></i>
          Se connecter
        </a>

        <a
          class="d-flex align-items-center text-decoration-none me-4 d-lg-none"
          href="index.php?viewToDisplay=displayConnexion"
          style="color: black;"
        >
          <i class="bi bi-lock-fill pe-1" style="font-size: 1.5rem; color: black;"></i>
        </a>

        <!-- S'inscrire -->
        <a
          class="d-flex align-items-center text-decoration-none me-4 d-none d-lg-block"
          href="index.php?viewToDisplay=displayRegister"
          style="color: black;"
        >
          <i class="bi bi-person-plus-fill pe-1" style="font-size: 1.5rem; color: black;"></i>
          S'inscrire
        </a>

        <a
          class="d-flex align-items-center text-decoration-none me-4 d-lg-none"
          href="index.php?viewToDisplay=displayRegister"
          style="color: black;"
        >
          <i class="bi bi-person-plus-fill pe-1" style="font-size: 1.5rem; color: black;"></i>
        </a>

      </div>
      <!-- Right elements -->
    </div>
  </nav>
  <!-- Navbar -->

  <div class="mb-5">
  <!-- CONTENU -->
  <?php echo $content; ?>
  </div>
  <!-- FOOTER -->
  <footer class="footer text-center" id="footer" style="background-color: #FFD338;">

    <div class="container pt-1">
      <div class="row">
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!" class="text-dark">Contacts</a>
            </li>
            <li>
              <a href="#!" class="text-dark">Qui sommes-nous ?</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <a class="fs-1 text-dark" href="#!" role="button">
            <i class="bi bi-facebook"></i>
          </a>  
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      ©2021 Copyright:
      <a class="text-reset fw-bold" href="https://findwell.be/">findwell.be</a>
    </div>
    <!-- Copyright -->

  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <?php if(isset($scripts) && $scripts != '') echo $scripts; ?>
</body>
</html>
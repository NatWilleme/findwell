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
      <button
        class="navbar-toggler"
        type="button"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="../controllers/controller_home.php">
          <img
            src="../images/logo1.png"
            height="70"
            alt=""
            loading="lazy"
          />
        </a>
      </div>

      <!-- Right elements -->
      <div class="p-1 bg-light rounded rounded-pill shadow-sm mt-4 mb-4 me-2">
        <form action="../controllers/controller_search.php" method="get">
          <div class="input-group">
            <input type="search" aria-describedby="button-addon1" name="company" class="form-control border-0 rounded rounded-pill bg-light">
            <div class="input-group-append">
              <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="bi bi-search"></i></button>
            </div>
          </div>
        </form>
      </div>
      <div class="d-flex align-items-center">
        <!-- Se connecter -->
        <a
          class="d-flex align-items-center text-decoration-none me-4"
          href="../views/view_connexion.php"
          style="color: black;"
        >
          <i class="bi bi-lock-fill pe-1" style="font-size: 1.5rem; color: black;"></i>
          Se connecter
        </a>

        <!-- S'inscrire -->
        <a
          class="d-flex align-items-center text-decoration-none me-4"
          href="../views/view_register.php"
          style="color: black;"
        >
          <i class="bi bi-person-plus-fill pe-1" style="font-size: 1.5rem; color: black;"></i>
          S'inscrire
        </a>

      </div>
      <!-- Right elements -->
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
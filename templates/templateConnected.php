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
        <a class="navbar-brand mt-2 mt-lg-0" href="../views/view_Home.php">
          <img
            src="../images/logo3.png"
            height="70"
            alt=""
            loading="lazy"
          />
        </a>
      </div>

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- Mes favoris -->
        <a class="me-3 text-decoration-none" href="#" style="color: black;">
        <i class="bi bi-suit-heart" style="font-size: 1.3rem; color: black;"></i>
          Mes favoris
        </a>

        <!-- Mon profil -->
        <a
          class="d-flex align-items-center text-decoration-none"
          href="#"
          style="color: black;"
        >
          <i class="bi bi-person-circle pe-1" style="font-size: 2rem; color: black;"></i>
          Mon profil
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

</body>
</html>
<?php
    $title = "Connexion";
    ob_start();	
?>

<div class="container text-center">
    
    <?php if(isset($alert)){ ?>
    <div class="mt-4 alert alert-<?php echo $alert['color']; ?> alert-dismissible fade show" role="alert">
        <?php
            if($alert['color'] == "danger"){echo "<i class=\"bi bi-exclamation-triangle me-2 fs-4\"></i>";}
            else echo "<i class=\"bi bi-check-square me-2 fs-4\"></i>";
            echo $alert['message']; 
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>

    

    <main class="form-signin">
    <form method="post" action="../controllers/controller_login.php">
        <img class="mb-4" src="../images/logo1.png" alt="" width="120">
        <h1 class="h3 mb-3 fw-normal">Inscription</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="mail" name="mail" placeholder="nom@exemple.be">
            <label for="mail">Adresse mail</label>
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            <label for="password">Mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submitRegister">S'inscrire</button>
    </form>
    </main>

</div>

<?php
    $content = ob_get_clean();
    require_once("../templates/templateNotConnected.php");
?>
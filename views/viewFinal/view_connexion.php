<?php
    $title = "Connexion";
    $scripts="<script src=\"../js/checkEntries/checkEntries_connexion.js\"></script>";
    ob_start();	
?>

<div class="container text-center">
    
    <?php if(isset($alert['color'])){ ?>
    <div class="mt-4 alert alert-<?php echo $alert['color']; ?> alert-dismissible fade show" role="alert">
        <?php
            if($alert['color'] == "danger"){echo "<i class=\"bi bi-exclamation-triangle me-2 fs-4\"></i>";}
            else echo "<i class=\"bi bi-check-square me-2 fs-4\"></i>";
            echo $alert['message']; 
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } if($forget == '' && $newPwd == ''){?>

    <main class="form-signin">
        <form id="formLogin" method="post" action="index.php">
            <img class="mb-4" src="../images/logo1.png" alt="" width="120">
            <h1 class="h3 mb-3 fw-normal">Connexion</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" required>
                <label for="floatingInput">Adresse mail</label>
                <p for="floatingInput" id="errorMail"></p>
            </div>
            <div class="form-floating ">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="floatingPassword">Mot de passe</label>
                <p id="errorPwd"></p>
            </div>
            <div class="mb-2"><a href="index.php?viewToDisplay=displayConnexion&pwdforget=1">Mot de passe oublié ?</a></div>

            <button class="w-100 btn btn-lg btn-primary" name="submitConnexion" type="submit">Se connecter</button>
        </form>
    </main>

    <?php } else if($forget != ''){ ?>
    <main class="form-signin">
        <form id="formLogin" method="post" action="index.php?viewToDisplay=displayConnexion">
            <img class="mb-4" src="../images/logo1.png" alt="" width="120">
            <h1 class="h3 mb-3 fw-normal">Mot de passe oublié</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" required>
                <label for="floatingInput">Entrez votre adresse mail</label>
                <p for="floatingInput" id="errorMail"></p>
            </div>

            <button class="w-100 btn btn-lg btn-primary" name="submitForget" type="submit">Réinitialiser le mot de passe</button>
        </form>
    </main>
    <?php } else if ($newPwd != ''){?>
        <main class="form-signin">
        <form id="formLogin" method="post" action="index.php?viewToDisplay=displayConnexion">
            <img class="mb-4" src="../images/logo1.png" alt="" width="120">
            <h1 class="h3 mb-3 fw-normal">Réinitialisation du mot de passe</h1>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" required>
                <label for="floatingPassword">Mot de passe</label>
                <p for="floatingInput" id="errorPwd"></p>
            </div>
            <div class="form-floating ">
                <input type="password" class="form-control" id="passwordVerif" name="passwordVerif"  required>
                <label for="floatingPassword">Vérification du mot de passe</label>
                <p id="errorPwdVerif"></p>
            </div>

            <button class="w-100 btn btn-lg btn-primary" name="submitReinitialisation" type="submit">Réinitialiser le mot de passe</button>
        </form>
    </main>
    <?php } ?>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $scripts);
    else displayTemplateNotConnected($title, $content, $scripts);
?>
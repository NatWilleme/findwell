<?php
    $title = "Contact";
    ob_start();	
?>

<div class="container mt-5">
    <div class="row">

        <div class="text-center col-12 col-lg-7">
            <img class="mb-3" src="images/icons/contactUs.png" width="350" alt="">
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label for="mail" class="form-label fw-bold">Adresse mail</label>
                    <input type="mail" class="form-control" id="mail" name="mail" placeholder="ex: jeandubois@gmail.com" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ex: Jean Dubois" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label fw-bold">Sujet</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="ex: Question concernant..." required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label fw-bold">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button class="btn btn-primary" name="sendContactMail" type="submit">Envoyer</button>
            </form>
        </div>
        <span class="col-1"></span>
        <div class="col-lg-4 d-none d-lg-block my-auto">
            <img src="images/icons/contact.png" width="100%">
        </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
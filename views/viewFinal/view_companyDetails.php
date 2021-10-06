<?php
    $title = $company->name;
    $scripts = "<script src=\"js/checkEntries/checkEntries_comment.js\"></script>
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>";
    ob_start();	
?>

<div class="container-fluid mt-2 mb-5">
    <?php if($company->certified != 0){ ?>
    <?php if(isset($alert['color'])){ ?>
    <div class="mt-4 alert alert-<?php echo $alert['color']; ?> alert-dismissible fade show" role="alert">
        <?php
            if($alert['color'] == "danger"){echo "<i class=\"bi bi-exclamation-triangle me-2 fs-4\"></i>";}
            else echo "<i class=\"bi bi-check-square me-2 fs-4\"></i>";
            echo $alert['message']; 
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    <div class="row d-flex justify-content-around mt-4">
        <h1 class="col-12 col-lg-5 text-center fw-bold"><?php echo $company->name; ?></h1> 
        <?php if($messageBtn != "") {?>
        <span class="col-12 col-lg-3"></span>    
        <button onclick="location.href='index.php?viewToDisplay=displayCompanyDetails&favorite=<?php echo $company->id; ?>'" class="btn btn-danger col-5 col-lg-2" type="button" ><?php echo $messageBtn; ?></button>
        <?php } else { ?>
        <span class="col-12 col-lg-5"></span>
        <?php } ?>
    </div>
    <div class="row d-flex justify-content-around mb-4 mt-4">

        <img id="imgCompany" class="col-12 col-md-5 col-lg-5 col-xl-5" style="object-fit: cover;" src="<?php echo $company->image; ?>">
        <div class="col-11 col-md-5 col-lg-5 border border-dark mt-3 mt-lg-0">
            <h2 class="fw-bold mt-3 mt-lg-0">Description de l'entreprise:</h2>
            <p><?php echo $company->description; ?></p>
            <div class="d-lg-flex">
                <div class="col-12 col-lg-4">
                    <h2 class="fw-bold">Heures d'ouverture:</h2>
                    <p><?php echo $company->hours; ?></p>
                </div>
                <div class="col-12 col-lg-4">
                    <h2 class="fw-bold">Contacts:</h2>
                    <p>
                        <b class="fw-bold">Mail</b>: <a href="mailto:<?php echo $company->mail; ?>"> <?php echo $company->mail; ?></a><br>
                        <b class="fw-bold">Téléphone</b>: <?php echo $company->phone; ?><br>
                        <b class="fw-bold">Site web</b>: <a href="<?php echo $company->web; ?>"><?php echo $company->web; ?></a>
                    </p>
                </div>
                <div class="col-12 col-lg-4">
                    <h2 class="fw-bold mt-3 mt-lg-0">Adresse:</h2>
                    <p><a href="https://www.google.be/maps/place/<?php echo $company->number.", ".$company->street." ".$company->postalCode." ".$company->city; ?>"  target="_blank" rel="noopener noreferrer"><?php echo $company->number.", ".$company->street."<br>".$company->postalCode." ".$company->city; ?></a></p>
                </div>
            </div>
            
        </div>

        <?php if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) { ?>
        <div class="row d-flex justify-content-around mb-4">
            <div class="col-12 col-lg-5 p-0 mt-3">
                <h4><i>Qu'avez-vous pensé de <?php echo $company->name; ?> ?</i></h4>
                <form id="commentForm" action="index.php?viewToDisplay=displayCompanyDetails&newComment=<?php echo $company->id; ?>" method="post" enctype='multipart/form-data'>
                    <textarea class="" name="newComment" id="newComment" rows="6"  style="width: 100%;" ></textarea>
                    <label for="newComment" id="newCommentError"></label><br>
                    <input class="mt-2" type="file" id="img" name="img" accept=".png, .jpg, .jpeg">
                    <div class="rating" id="starRating" required> 
                        <input type="radio" name="rating" value="5" id="5">
                        <label for="5">☆</label> 
                        <input type="radio" name="rating" value="4" id="4">
                        <label for="4">☆</label> 
                        <input type="radio" name="rating" value="3" id="3">
                        <label for="3">☆</label> 
                        <input type="radio" name="rating" value="2" id="2">
                        <label for="2">☆</label> 
                        <input type="radio" name="rating" value="1" id="1">
                        <label for="1">☆</label>
                    </div>
                    <label for="starRating" id="ratingError"></label><br>
                    <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Publier">
                </form>
            </div>
            <div class="col-12 col-lg-5"></div>
        </div>
        <?php } else {?>
        <div class="row d-flex justify-content-around mt-4">
            <h2 class="col-12 col-lg-5 mb-4 ps-0">Connectez-vous pour laisser un avis !</h2>
            <span class="col-12 col-lg-5 mb-4"></span>
        </div>
        <?php } ?>
        <div class="row d-flex justify-content-around mb-4 p-0">
            <span class="col-12 col-lg-5">
            <?php 
                if ($rating['rate'] == 0) {
                    echo "<h2 class='fw-bold'>Pas encore de note !</h2>";
                } else {
                    echo "<h2 class='col-12 fw-bold'>Note globale: ";
    
                    for ($i=0; $i < 5; $i++) { 
                        if($i < $rating['rate']){
                            echo "<i class='bi bi-star-fill text-warning'></i>";
                        } else echo "<i class='bi bi-star text-warning'></i>";
                    }
                    echo "</h2>";
                }
            ?>
            </span>
            <span class="col-12 col-lg-5"></span>
        </div>
        


        <div class="row d-flex justify-content-around mb-4 p-0">
            <div class="col-12 col-lg-8">
            <h2 class="mb-4"> Avis (<?php echo count($comments); ?>)</h2>
            <?php 
                $cpt = 0;
                foreach ($comments as $comment) {
            ?>
            <div class="row border border-dark mb-2 pt-2">
                <div class="col-12">
                    <p>
                        <img src="<?php if($users[$cpt]->image == "") echo "images/default-profil.jpg"; else echo $users[$cpt]->image; ?>" class="rounded-circle" style="height:40px;width:40px" alt="">
                        <span class="ms-2 fw-bold"><?php echo $users[$cpt]->username ?></span><br>
                        <?php 
                            for ($i=0; $i < 5; $i++) { 
                                if($i < $comment->rating){
                                    echo "<i class='bi bi-star-fill text-warning'></i>";
                                } else echo "<i class='bi bi-star text-warning'></i>";
                            }
                        ?>
                        <?php $date = new DateTime($comment->date); echo $date->format('d-m-Y'); ?><br>
                        <?php echo $comment->comment; ?>
                        <?php if ($comment->image != "") {
                            ?>
                        <br><img class="col-12 col-lg-4" src="<?php echo $comment->image; $cpt++; ?>" style="max-height:500px; max-width: 100%; height:auto; width:auto;" alt="">
                        <?php } ?>
                    </p>
                </div>
            </div>
            <?php
                }
            ?>
            </div>
            <div class="col-12 col-lg-2"></div>
        </div>
    </div>
    <?php } else { ?>
        <h1>Cette page n'est pas disponible pour le moment !</h1>
    <?php } ?>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification, $scripts);
    else displayTemplateNotConnected($title, $content, $scripts);
?>
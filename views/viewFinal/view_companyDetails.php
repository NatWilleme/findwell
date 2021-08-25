<?php
    $title = "Contact";
    $scripts = "<script src=\"../js/checkEntries/checkEntriesComment.js\"></script>
    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>";
    ob_start();	
?>

<div class="container-fluid mt-2 mb-5">
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
    <?php if(isset($_SESSION['category']) && isset($_SESSION['subcategory'])) { ?>
    <nav class="ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="index.php?viewToDisplay=displayCategoriesList&category=<?php echo $_SESSION['category'] ?>"><?php echo $_SESSION['category'] ?></a></li>
            <li class="breadcrumb-item"><a href="index.php?viewToDisplay=displayCompaniesList&subcategory=<?php echo $_SESSION['subcategory']; ?>"><?php echo $_SESSION['subcategory'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $company->name; ?></li>
        </ol>
    </nav>
    <?php } ?>
    <div class="row d-flex justify-content-around mt-4">
        <h1 class="col-5"><?php echo $company->name; ?></h1> 
        <?php if($messageBtn != "") {?>
        <span class="col-1"></span>
        <button onclick="location.href='index.php?viewToDisplay=displayCompanyDetails&favorite=<?php echo $company->id; ?>'" class="btn btn-danger col-5 col-lg-2 " type="button" ><?php echo $messageBtn; ?></button>
        <?php } else { ?>
        <span class="col-5"></span>
        <?php } ?>
    </div>
    <div class="row d-flex justify-content-around mb-4 mt-4">

        <img class="col-12 col-lg-5 img-fluid"  src="<?php echo $company->image; ?>">
        <div class="col-12 col-lg-5">
            <h2>Description de l'entreprise:</h2>
            <p><?php echo $company->description; ?></p>
            <div class="d-lg-flex">
                <div class="col-12 col-lg-5">
                    <h2>Heures d'ouverture:</h2>
                    <p><?php echo $company->hours; ?></p>
                </div>
                <span class="col-2"></span>
                <div class="col-12 col-lg-5">
                    <h2>Contacts:</h2>
                    <p>
                        <b>Mail</b>: <a href="mailto:<?php echo $company->mail; ?>"> <?php echo $company->mail; ?></a><br>
                        <b>Téléphone</b>: <?php echo $company->phone; ?>
                    </p>
                </div>
            </div>
        </div>
        
        

    </div>
    
    <!-- <div class="row d-flex justify-content-around mb-4">
        <div class="col-5">
            <h2>Heures d'ouverture:</h2>
            <p><?php echo $company->hours; ?></p>
        </div>

        <div class="col-5">
            <h2>Contacts:</h2>
            <p>
                <b>Mail</b>: <a href="mailto:<?php echo $company->mail; ?>"> <?php echo $company->mail; ?></a><br>
                <b>Téléphone</b>: <?php echo $company->phone; ?>
            </p>
        </div>
    </div> -->
    <div class="ms-5 me-5">
        <?php if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) { ?>
        <div class="row d-flex justify-content-around mb-4">
            <h2>Qu'avez-vous pensez de <?php echo $company->name; ?> ?</h2>
            <form id="commentForm" action="index.php?viewToDisplay=displayCompanyDetails&newComment=<?php echo $company->id; ?>" method="post" enctype='multipart/form-data'>
                <textarea class="mb-2" name="newComment" id="newComment" rows="6"  style="width: 100%;" ></textarea><br>
                <label for="newComment" id="newCommentError"></label><br>
                <input class="mb-2" type="file" id="img" name="img" accept="image/*"><br>
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
        <?php } else {?>
        <div class="row d-flex justify-content-around">
            <h2 class="col-5 mb-4" style="padding: 12px;">Connectez-vous pour laisser un avis !</h2>
            <span class="col-5 mb-4"></span>
        </div>
        <?php } ?>
        <div class="row d-flex justify-content-around mb-4">
            <?php 
                if ($rating['rate'] == 0) {
                    echo "<h2>Pas encore de note !</h2>";
                } else {
                    echo "<h2>Note globale: ";
    
                    for ($i=0; $i < 5; $i++) { 
                        if($i < $rating['rate']){
                            echo "<i class='bi bi-star-fill text-warning'></i>";
                        } else echo "<i class='bi bi-star text-warning'></i>";
                    }
                }
            ?>
        </div>

        <div class="row d-flex justify-content-around mb-4">
            <h2> Avis (<?php echo count($comments); ?>)</h2>
            <?php 
                $cpt = 0;
                foreach ($comments as $comment) {
            ?>
            <div class="row">
                <div class="col-12 p-0 ">
                    <p>
                        <img src="<?php if($users[$cpt]->image == "") echo "../images/default-profil.jpg"; else echo $users[$cpt]->image; ?>" class="ps-0 pe-0 rounded-circle" style="height:40px;width:40px" alt="">
                        <?php echo $users[$cpt]->username ?><br>
                        <?php 
                            for ($i=0; $i < 5; $i++) { 
                                if($i < $comment->rating){
                                    echo "<i class='bi bi-star-fill text-warning'></i>";
                                } else echo "<i class='bi bi-star text-warning'></i>";
                            }
                        ?>
                        <?php $date = new DateTime($comment->date); echo $date->format('d-m-Y'); ?><br>
                        <?php echo $comment->comment; ?><br>
                        <?php if ($comment->image != "") {
                            ?>
                        <img class="col-12 col-lg-4" src="<?php echo $comment->image; $cpt++; ?>" alt="">
                        <?php } ?>
                    </p>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
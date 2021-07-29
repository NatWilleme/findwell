<?php
    $title = "Contact";
    ob_start();	
?>

<div class="container-fluid mt-2 mb-5">

    <nav class="ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../views/view_Home.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="../controllers/controller_categoriesList.php?category=<?php echo $_SESSION['category'] ?>"><?php echo $_SESSION['category'] ?></a></li>
            <li class="breadcrumb-item"><a href="../controllers/controller_companiesList.php?subcategory=<?php echo $_SESSION['subcategory']; ?>"><?php echo $_SESSION['subcategory'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $company->name; ?></li>
        </ol>
    </nav>
    <div class="row ms-5"><h1><?php echo $company->name; ?></h1></div>
    <div class="row d-flex justify-content-around mb-4">

        <img class="col-3"  src="<?php echo $company->image; ?>">
        <p class="col-3 fs-5"><?php echo $company->hours; ?></p>


    </div>
    
    <div class="row mb-4 ms-5">
        <h2>Description de l'entreprise:</h2>
        <p class="col-5"><?php echo $company->description; ?></p>
    </div>

    <div class="row d-flex justify-content-around mb-4 ms-5">
        <?php 
            if ($rating['rate'] == 0) {
                echo "<h2>Pas encore de note !</h2>";
            } else {
                echo "<h2>Note globale: ". number_format($rating['rate'],1) ." <i class='bi bi-star-fill text-warning'></i>/5</h2>";
            }
        ?>
    </div>

    <div class="row d-flex justify-content-around mb-4 ms-5">
        <h2>Contacts:</h2>
        <p>
            <b>Mail</b>: <a href="mailto:<?php echo $company->mail; ?>"> <?php echo $company->mail; ?></a><br>
            <b>Téléphone</b>: <?php echo $company->phone; ?>
        </p>
    </div>

    <div class="row mb-4 ms-5">
        <h2><?php echo count($comments); ?> avis concernant cette entreprise:</h2>
        <?php 
            $cpt = 0;
            foreach ($comments as $comment) {
        ?>
        <div class="row">
            <div class="col-5">
                <p>
                    <img src="<?php echo $users[$cpt]->image; ?>" class="ps-0 pe-0 rounded-circle" style="height:40px;width:40px" alt="">
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
                    <img width="500px" src="<?php echo $comment->image; $cpt++; ?>" alt="">
                </p>
            </div>
        </div>
        <?php
            }
        ?>


</div>

<?php
    $content = ob_get_clean();
    require_once("../templates/templateConnected.php");
?>
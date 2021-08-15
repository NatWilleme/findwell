<?php
    $title = "Contact";
    ob_start();	
    $scripts = "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>";
?>

<div class="container-fluid ps-0 pe-0 mt-2 mb-5">

    <nav class="ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../controllers/controller_home.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="../controllers/controller_categoriesList.php?category=<?php echo $_SESSION['category'] ?>"><?php echo $_SESSION['category'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['subcategory'] ?></li>
        </ol>
    </nav>

    <div class="row d-flex justify-content-around mb-4 m-0">
    <?php
        $cpt = 0;
        foreach ($companies as $company) {
            $cpt++;
            if ($cpt > 5) {
                echo "</div><div class='row d-flex justify-content-around mb-4 m-0'>";
                $cpt = 1;
            }
            ?>
            
        <div class="card border border-dark pt-2" style="width: 18rem;">
            <img src="<?php echo $company->image; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><b><?php echo $company->name; ?></b></h5>
                <p class="card-text">
                    <?php 
                        if ($company->rating == 0) {
                            echo "<b>Pas encore de note !</b>";
                        } 
                        else echo "<b>Note :</b> ".number_format($company->rating,1)." <i class='bi bi-star-fill text-warning'></i>";
                    ?>
                    <br>
                    <b>Domaine(s) :</b> 
                    <?php
                        echo $company->domaines;
                    ?>
                    <br>
                    <b>Distance :</b> <?php echo $company->distance; ?> km
                </p>
            </div>
            <a href="../controllers/controller_companyDetails.php?idCompany=<?php echo $company->id; ?>" class="btn btn-primary mb-2">Accéder</a>
        </div>          
        <?php
        }
        ?>
    </div>


</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) require_once("../templates/templateConnected.php");
    else require_once("../templates/templateNotConnected.php");
?>
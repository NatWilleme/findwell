<?php
    $title = "Entreprises";
    ob_start();	
    $scripts = "
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>";
?>

<div class="container-fluid ps-0 pe-0 mt-2 mb-5" onload="getLocation()">

    <?php if(isset($_SESSION['category']) && isset($_SESSION['subcategory'])) { ?>
    <nav class="ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="index.php?viewToDisplay=displayCategoriesList&category=<?php echo $_SESSION['category'] ?>"><?php echo $_SESSION['category'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['subcategory'] ?></li>
        </ol>
    </nav>
    <?php } ?>
    <?php if(sizeof($companies) > 0 && $companies[0]->distance != null) { ?>
    <div class="col-12 col-lg-2 offset-lg-10 mb-3">
        <form action="index.php?viewToDisplay=displayCompaniesList&subcategory=<?php echo $_GET['subcategory'] ?>" method="post">
            <label for="sort">Trier par: </label>
            <select class="form-select" name="sort" id="sort" onchange="this.form.submit()">
                <option value="note" <?php if($sort == "note") echo "selected"; ?>>Note</option>
                <option value="distance" <?php if($sort == "distance") echo "selected"; ?>>Distance</option>
            </select>
        </form>
    </div>
    <?php } ?>
    <div class="col-12 col-lg-2 offset-lg-10 mb-3">
        <form action="index.php?viewToDisplay=displayCompaniesList&subcategory=<?php echo $_GET['subcategory'] ?>" method="post">
            <label for="city">Région: </label>
            <div class="input-group">
                <input type="text" name="city" class="form-control" role="group" aria-describedby="btnGroupAddon">
                <button type="submit" class="input-group-text btn-primary" id="btnGroupAddon">Chercher</button>
            </div>
        </form>
    </div>
    <div class="row d-flex justify-content-around mb-4 m-0">
    <?php
        $cpt = 0;
        if(sizeof($companies) == 0){
            echo "<h3>Il n'y a pas encore d'entreprises dans cette categorie!</h3>";
        } else {
        foreach ($companies as $company) {
    ?>
            
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 18rem;">
            <img src="<?php echo $company->image; ?>" style="max-height:200px; max-width:280px; height:auto; width:auto;" class="card-img-top" class="card-img-top" alt="...">
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
                    <?php if($company->distance != null){ ?>
                    <b>Distance :</b> <?php echo $company->distance; ?> km
                    <?php } ?>
                </p>
            </div>
            <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $company->id; ?>" class="btn btn-primary mb-2">Accéder</a>
        </div>          
        <?php }} ?>
    </div>


</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
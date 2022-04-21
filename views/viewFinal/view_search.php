<?php
    $title = "Recherche";
    ob_start();	
?>

<div class="container-fluid mt-2 mb-5">
    <h2 class="fw-bold text-center mb-3">Résultat de la recherche:</h2>
    <?php if($searchResult['companies'][0]->distance != null) { ?>
    <div class="col-12 col-lg-2 offset-lg-10 mb-3">
        <form action="index.php?viewToDisplay=displaySearch" method="post">
            <input class="d-none" type="text" name="company" value="<?php echo $_POST['company']; ?>">
            <label for="sort">Trier par: </label>
            <select class="form-select" name="sort" id="sort" onchange="this.form.submit()">
                <option value="note" <?php if($searchResult['sort'] == "note") echo "selected"; ?>>Note</option>
                <option value="distance" <?php if($searchResult['sort'] == "distance") echo "selected"; ?>>Distance</option>
            </select>
        </form>
    </div>
    <?php } ?>

    <?php if(isset($_POST['company'])) { ?>
    <div class="col-12 col-lg-2 offset-lg-10 mb-3">
        <form action="index.php?viewToDisplay=displaySearch" method="post">
            <input class="d-none" type="text" name="company" value="<?php echo $_POST['company']; ?>">
            <label for="city">Région: </label>
            <div class="input-group">
                <input type="text" name="city" class="form-control" role="group" aria-describedby="btnGroupAddon">
                <button type="submit" class="input-group-text btn-primary" id="btnGroupAddon">Chercher</button>
            </div>
        </form>
    </div>
    <?php } ?>

    <div class="row d-flex justify-content-around mb-4">
    <?php
        if(sizeof($searchResult['companies']) == 0){
            echo "<h3>Aucun résultat pour votre recherche !</h3>";
        } else {
            $cpt = 0;
            foreach ($searchResult['companies'] as $company) {
    ?>
            
            <div class="card border border-dark pt-2 ms-3 me-3 mb-5" style="width: 18rem;">
                <img src="<?php echo $company->image; ?>" style="max-height:200px; max-width:280px; height:auto; width:auto;" class="card-img-top" alt="...">
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
                        <?php if($company->distance != null){ ?><b>Distance :</b> <?php echo $company->distance; ?> km <?php } ?>
                    </p>
                </div>
                <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $company->id; ?>" class="btn btn-primary mb-2">Accéder</a>
            </div>          

    <?php
            }
        }
    ?>
    </div>


</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
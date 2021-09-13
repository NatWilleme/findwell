<?php
    $title = "Favoris";
    ob_start();	
?>

<div class="container-fluid mt-2 mb-5">
    <h2 class="fw-bold text-center mb-3">Mes favoris:</h2>
    <div class="row d-flex justify-content-around mb-4">
    <?php
        if(sizeof($companies) == 0){
            echo "<h3>Aucun résultat pour votre recherche !</h3>";
        } else {
            $cpt = 0;
            foreach ($companies as $company) {
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
                        <b>Localisation :</b> <?php echo $company->city; ?>
                    </p>
                </div>
                <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $company->id; ?>&displayfavorites=true" class="btn btn-primary mb-2">Accéder</a>
            </div>            

            <?php
        } }
    ?>
    </div>
</div>

<?php
    $content = ob_get_clean();
    displayTemplateConnected($title, $content, $notification);
?>
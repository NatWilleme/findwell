<?php
    $title = "Recherche";
    ob_start();	
?>

<div class="container-fluid ps-0 pe-0 mt-2 mb-5">
    <h2>Résultat de la recherche:</h2>
    <div class="row d-flex justify-content-around mb-4">
    <?php
        if(sizeof($searchResult) == 0){
            echo "<h3>Aucun résultat pour votre recherche !</h3>";
        } else {
            $cpt = 0;
            foreach ($searchResult as $company) {
                $cpt++;
                if ($cpt > 5) {
                    echo "</div><div class='row d-flex justify-content-around mb-4'>";
                    $cpt = 1;
                }
            ?>
            
        <div class="card" style="width: 18rem;">
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
                    <b>Localisation :</b> <?php echo $company->city; ?>
                </p>
                <a href="index.php?viewToDisplay=displayCompanyDetails&idCompany=<?php echo $company->id; ?>" class="btn btn-primary">Accéder</a>
            </div>
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
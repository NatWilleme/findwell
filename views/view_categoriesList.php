<?php
    $title = "Contact";
    ob_start();	
?>

<div class="container-fluid ps-0 pe-0 mt-2 mb-5">

    <nav class="ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../views/view_Home.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['category'] ?></li>
        </ol>
    </nav>

    <div class="row d-flex justify-content-around mb-4 m-0">
    <?php
        $cpt = 0;
        foreach ($categories as $category) {
            $cpt++;
            if ($cpt > 5) {
                echo "</div><div class='row d-flex justify-content-around mb-4 m-0'>";
                $cpt = 1;
            }
            ?>
            
        <div class="card" style="width: 18rem;">
            <img src="<?php echo $category->image; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $category->name; ?></h5>
                <a href="../controllers/controller_companiesList.php?subcategory=<?php echo $category->name; ?>" class="btn btn-primary">Accéder</a>
            </div>
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
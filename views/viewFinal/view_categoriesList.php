<?php
    $title = "Categories";
    $scripts = "<script src=\"js/location.js\"></script>";
    ob_start();	
?>

<div class="container-fluid ps-0 pe-0 mt-2 mb-5">

    <nav class="ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION['category'] ?></li>
        </ol>
    </nav>

    <div class="row d-flex justify-content-around mb-4 m-0">
    <?php foreach ($categories as $category) { ?>
        <div class="card border border-dark pt-2 ms-3 me-3" style="width: 18rem;">
            <img src="<?php echo $category->image; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $category->name; ?></h5>
            </div>
            <form id="formAccess" action="index.php?viewToDisplay=displayCompaniesList&subcategory=<?php echo $category->name; ?>" method="post">
            <input type="text" class="d-none" name="location">
                <button class="btn btn-primary mb-2 col-12">Accéder</button>
            </form>
        </div>          
    <?php } ?>
    </div>


</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification, $scripts);
    else displayTemplateNotConnected($title, $content, $scripts);
?>
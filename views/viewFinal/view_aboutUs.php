<?php
    $title = "Qui sommes-nous ?";
    ob_start();	
?>

<div class="container-fluid">
    <div class="col-11 mx-auto">
        <img class="my-4" src="images/quisommesnous1.gif" width="100%" alt="">
        <img class="my-4" src="images/quisommesnous2.gif" width="100%" alt="">
        <img class="my-4" src="images/quisommesnous3.gif" width="100%" alt="">
    </div>
</div>

<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
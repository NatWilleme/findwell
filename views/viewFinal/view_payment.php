<?php
    $title = "Abonnement";
    ob_start();	
?>


<div class="container-fluid">
    
</div>


<?php
    $content = ob_get_clean();
    // if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    // else displayTemplateNotConnected($title, $content);
    require_once('../../templates/templateFinal/templateNotConnected.php');
?>
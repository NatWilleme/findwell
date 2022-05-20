<?php
    $title = "Abonnement";
    ob_start();	
?>


<div class="container">
    <div class="border border-warning border-5 mt-5 p-3">
        <h2 class="text-center">Félicitation ! Votre entreprise correspond aux attentes de Findwell!</h2>
        <fieldset>
            <legend class="text-center ">Afin de pouvoir figurer sur la plateforme, nous vous invitions à suivre les étapes suivantes:</legend>
            <ol>
                <li>Effectuer un virement de xx€ au numéro de compte suivant : <i>BExxxxx</i>.</li>
                <li>Entrez en communication : <i>le nom de votre entreprise</i>.</li>
                <li>Attendez que nos experts confirme le bon déroulement de la transaction et active la visibilité de votre entreprise.</li>
            </ol>
        </fieldset>
    </div>
    

</div>


<?php
    $content = ob_get_clean();
    if(isset($_COOKIE["userConnected"]) && isset($_SESSION['user'])) displayTemplateConnected($title, $content, $notification);
    else displayTemplateNotConnected($title, $content);
?>
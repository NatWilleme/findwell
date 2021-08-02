<?php
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

require_once('../views/view_Home.php');


?>
<?php
require_once('../models/models/user.php');
require_once('../models/dao/usersManager.php');



$user = UsersManager::getUser(unserialize($_COOKIE['userConnected'])->mail);

require_once("../views/view_editProfil.php");

?>
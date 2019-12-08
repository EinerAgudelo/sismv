<?php 
include "../../config.php";
include_once "../Models/Session.php";

$userSession = new userSession();

$userSession->getCurrentUser();
$userSession->closeSession();

header("Location: ".URL_PROYECTO);
 ?>
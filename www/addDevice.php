<?php 
include_once "db.php";
include_once "models/mainModel.php";
include_once "models/deviceModel.php";

$serials = $_POST['serials'];
$devType = (int) $_POST['devType'];

addDevice($serials, $devType);




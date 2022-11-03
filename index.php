<?php

session_start();

require_once ("controllers/PageController.php");
require_once ("models/PageModel.php");
require_once ("crud/Crud.php");
require_once ("constants.php");

// Main
$crud = new Crud();
$pageModel = new PageModel(null, $crud);
$controller = new PageController($pageModel);
$controller -> handleRequest();

?>
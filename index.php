<?php

session_start();

require_once ("controllers/PageController.php");
require_once ("models/PageModel.php");
require_once ("crud/Crud.php");

// Main
$crud = new Crud();
$model = new PageModel(null, $crud);
$controller = new PageController($model);
$controller -> handleRequest();

?>
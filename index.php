<?php

session_start();

require_once ("controllers/PageController.php");

// Main
$crud = new Crud();
$pageModel -> newPageModel(null, $crud);
$controller = new PageController();
$controller -> handleRequest();

?>
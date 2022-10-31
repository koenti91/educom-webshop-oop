<?php 
include_once('./crud/Crud.php');

$crud = new Crud();
$sql = "SELECT * FROM users WHERE id = :id";
$params = array(": id" => 20);
$crud->createRow($sql, $params);
?>
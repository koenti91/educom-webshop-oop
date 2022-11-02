<?php 
include_once('../crud/Crud.php');

$crud = new Crud();
// testqueries
$sql = "SELECT id, filename, name, price, description FROM products";
// $sql = "SELECT * FROM users WHERE id =";
// $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
// $sql = "UPDATE users SET password = :newPassword WHERE id = :id";
// $sql = "DELETE FROM users WHERE id = :id";

$params = array();
$result = $crud->readManyRows($sql, $params);
var_dump($result);
?>
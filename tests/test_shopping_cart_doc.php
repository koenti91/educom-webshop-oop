<?php
require_once "../views/shopping_cart_doc.php";

$cartRows = array(
    "name" => "Stussy Beanie", 
    "id" => "1", 
    "description" => "Stussy Big Stock Cuff Beanie",
    "price" => "44.95", 
    "filename" => "stussyhat.png"
);

$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'canOrder' => true,
                'products' => array(
                    $cartRow,
                    $cartRow
                ),
                'name' => 'Henk', 'nameErr' => 'onbekend', 'email' => 'henk@henk.nl',
                'emailErr' => 'onbekend', 'password' => 'Hallo123.', 'passwordErr' => 'onbekend',
                'passwordRepeat' => 'Hallo123.', 'passwordRepeatErr' => 'onbekend');
var_dump($data);

$view = new ShoppingCartDoc($data);

$view  -> show();

?>
<?php
require_once "../views/delivery_address_doc.php";
require_once "../get_var.php";
$product = array(
    "name" => "Stussy Beanie", 
    "id" => "1", 
    "description" => "Stussy Big Stock Cuff Beanie",
    "price" => "44.95", 
    "filename" => "stussyhat.png"
);

$address = array (
    "id" => "1", "address" => "Zaanstraat 1", "city" => "Amsterdam");
    


$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'products' => array(
                    $product,
                    $product
                ),
                'name' => 'Henk', 'nameErr' => 'onbekend', 'email' => 'henk@henk.nl',
                'emailErr' => 'onbekend', 'password' => 'Hallo123.', 'passwordErr' => 'onbekend',
                'passwordRepeat' => 'Hallo123.', 'passwordRepeatErr' => 'onbekend', 'username' => 'Henk',
                'user_email' => 'henk@gmail.com',
                
                'addresses' => array($address, $address)

            );
                
var_dump($data);

$view = new DeliveryAddressDoc($data);

$view  -> show();

?>
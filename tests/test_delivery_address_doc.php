<?php
require_once "../views/delivery_address_doc.php";

$product = array(
    "name" => "Stussy Beanie", 
    "id" => "1", 
    "description" => "Stussy Big Stock Cuff Beanie",
    "price" => "44.95", 
    "filename" => "stussyhat.png"
);

$address = array(
    "address" => "Zaanstraat 1", "zipCode" => "1234AA", "city" => "Amsterdam", "phone" => "123456789"
);

$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'products' => array(
                    $product,
                    $product
                ),
                'name' => 'Henk', 'nameErr' => 'onbekend', 'email' => 'henk@henk.nl',
                'emailErr' => 'onbekend', 'password' => 'Hallo123.', 'passwordErr' => 'onbekend',
                'passwordRepeat' => 'Hallo123.', 'passwordRepeatErr' => 'onbekend',
                
            'addresses' => array($address, $address)

            );
                
var_dump($data);

$view = new DeliveryAddressDoc($data);

$view  -> show();

?>
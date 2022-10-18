<?php
require_once "../views/last_check_doc.php";

$row = array(
    "name" => "Stussy Beanie", 
    "id" => "1", 
    "description" => "Stussy Big Stock Cuff Beanie",
    "price" => "44.95", 
    "filename" => "stussyhat.png",
    "quantity" => "1", 
    "subtotal" => "44.95",
);

$user = array(
    "name" => "Bertus", "email" => "bertus@gmail.com"
);


$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'cartRows' => array($row, $row),
                'name' => 'Henk', 'nameErr' => 'onbekend', 'email' => 'henk@henk.nl',
                'emailErr' => 'onbekend', 'password' => 'Hallo123.', 'passwordErr' => 'onbekend',
                'passwordRepeat' => 'Hallo123.', 'passwordRepeatErr' => 'onbekend', 'username' => 'Henk',
                'user_email' => 'henk@gmail.com', "address" => "Zaanstraat 1", "zip_code" => "1234AA", 
                "city" => "Amsterdam", "phone" => "123456789", "total" => "89.90", "deliveryAddressId" => "1",
            );
                
var_dump($data);

$view = new LastCheckDoc($data);

$view  -> show();

?>
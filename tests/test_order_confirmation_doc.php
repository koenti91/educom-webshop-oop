<?php
require_once "../views/order_confirmation_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'email' => 'henk@henk.nl', 'password' => 'Hallo123.', 'emailErr' => 'onbekend');

$view = new OrderConfirmationDoc($data);

$view  -> show();

?>
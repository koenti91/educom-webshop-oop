<?php
require_once "../views/login_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'email' => 'henk@henk.nl', 'password' => 'Hallo123.', 'emailErr' => 'onbekend');

$view = new LoginDoc($data);

$view  -> show();

?>
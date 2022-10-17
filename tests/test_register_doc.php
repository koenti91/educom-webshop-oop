<?php
require_once "../views/register_doc.php";

$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"), 
                'name' => 'Henk', 'nameErr' => 'onbekend', 'email' => 'henk@henk.nl',
                'emailErr' => 'onbekend', 'password' => 'Hallo123.', 'passwordErr' => 'onbekend',
                'passwordRepeat' => 'Hallo123.', 'passwordRepeatErr' => 'onbekend');

$view = new RegisterDoc($data);

$view  -> show();

?>
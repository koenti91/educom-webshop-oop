<?php
require_once "../views/contact_thanks_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                'gender' => 'Mevrouw', 'name' => 'Henk', 'email' => 'henk@gmail.com', 
                'phone' => '0612345678', 'preferred' => 'Postduif', 
                'question' => 'bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla');

$view = new ContactThanksDoc($data);

$view  -> show();

?>
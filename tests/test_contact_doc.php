<?php
require_once "../views/contact_doc.php";

$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                "gender" => "madam", "genderErr" => "onbekend", 
                "name" => "Jan Klaassen", "nameErr" => "onbekend", "email" => "henk@hotmail.com", 
                "emailErr" => "onbekend", "phone" => "0646398233", "phoneErr" => "onbekend",  
                "preferred" => "e-mail", "preferredErr" => "onbekend", 
                "question" => "bla bla bla", "questionErr" => "onbekend",
                "valid" => false);

$view = new ContactDoc($data);

$view  -> show();

?>
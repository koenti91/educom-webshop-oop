<?php
require_once "../views/contact_thanks_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                /* other fields */ );

$view = new ContactThanksDoc($data);

$view  -> show();

?>
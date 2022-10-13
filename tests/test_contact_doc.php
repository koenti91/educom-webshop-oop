<?php
require_once "../views/contact_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                /* other fields */ );

$view = new ContactDoc($data);

$view  -> show();

?>
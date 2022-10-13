<?php
require_once "../views/register_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                /* other fields */ );

$view = new RegisterDoc($data);

$view  -> show();

?>
<?php
require_once "../views/login_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home", "contact" => "Contact"),
                /* other fields */ );

$view = new LoginDoc($data);

$view  -> show();

?>
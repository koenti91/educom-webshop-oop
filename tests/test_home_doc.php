<?php
require_once "../views/home_doc.php";
$data = array ( 'page' => 'Home', 
                'menu' => array("home" => "Home"),
                /* other fields */ );

$view = new HomeDoc($data);

$view  -> show();

?>
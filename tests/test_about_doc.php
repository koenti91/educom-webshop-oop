<?php
require_once "../views/basic_doc.php";
$data = array ('page' => 'basic', 'menu' => array('home' => 'Home', 'about' => 'About', 
                'contact' => 'Contact', 'webshop' => 'Webshop'));

$view = new AboutDoc($data);

$view  -> show();

?>
<?php
require_once "../views/change_pw_doc.php";
$data = array ('page' => 'basic', 'menu' => array('home' => 'Home', 'about' => 'About', 
                'contact' => 'Contact', 'webshop' => 'Webshop'));

$view = new ChangePwDoc($data);

$view  -> show();

?>
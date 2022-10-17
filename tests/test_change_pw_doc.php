<?php
require_once "../views/change_pw_doc.php";
$data = array ('page' => 'basic', 'menu' => array('home' => 'Home', 'about' => 'About', 
                'contact' => 'Contact', 'webshop' => 'Webshop'),
                'oldPasswordErr' => 'onbekend', 'newPasswordErr' => 'onbekend', 
                'repeatNewPasswordErr' => 'onbekend', 'valid' => false);

$view = new ChangePwDoc($data);

$view  -> show();

?>
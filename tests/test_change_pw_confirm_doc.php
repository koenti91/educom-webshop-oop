<?php
require_once "../views/change_pw_confirm_doc.php";
$data = array ('page' => 'basic', 'menu' => array('home' => 'Home', 'about' => 'About', 
                'contact' => 'Contact', 'webshop' => 'Webshop'));

$view = new ChangePwConfirmDoc($data);

$view  -> show();

?>
<?php

class ShopModel extends PageModel {

    public $products = '';
    public $product = '';
    public $cartRows = array();
    public $cartRow = '';
    public $total = '';
    public $name = '';
    public $id = '';
    public $filename = '';
    public $price = '';
    public $quantity = '';
    public $description = '';
    public $canOrder = false;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }

}   

?>
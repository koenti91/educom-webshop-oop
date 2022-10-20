<?php

class SessionManager {

    public function doLoginUser($name, $userId) {
        $_SESSION['login'] = $name; 
        $_SESSION['loggedInUserId'] = $userId;
        $_SESSION['shoppingCart'] = array();  // { productIdA => quantity, productIdB => quantity, ... }
    }

    public function isUserLoggedIn() {
        return isset($_SESSION['login']);
    }

    public function getLoggedInUsername() {
        return $_SESSION['login'];
    }

    public function getLoggedInUserID() {
        return $_SESSION['loggedInUserId'];
    }

    public function doLogoutUser() {
        unset($_SESSION['login']);
    }

    public function getShoppingCart() {
        return $_SESSION['shoppingCart'];
    }

    public function addToCart($productId, $quantity) {
        $_SESSION['shoppingCart'][$productId] = $quantity; 
    }

    public function deleteFromCart($productId) {   
        unset($_SESSION['shoppingCart'][$productId]);
    }

    public function emptyCart() {
        $_SESSION['shoppingCart'] = array();
    }

    public function storeDeliveryAddressForSession ($id) {
        $_SESSION['deliveryAddressId'] = $id;
        return true; 
    }

    public function getDeliveryAddressForSession () {
        return $_SESSION['deliveryAddressId'];
    }
}

?>
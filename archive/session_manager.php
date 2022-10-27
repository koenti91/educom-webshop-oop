<?php

function doLoginUser($name, $userId) {
    $_SESSION['login'] = $name; 
    $_SESSION['loggedInUserId'] = $userId;
    $_SESSION['shoppingCart'] = array();  // { productIdA => quantity, productIdB => quantity, ... }
}

function isUserLoggedIn() {
    return isset($_SESSION['login']);
}

function getLoggedInUsername() {
    return $_SESSION['login'];
}

function getLoggedInUserID() {
    return $_SESSION['loggedInUserId'];
}

function doLogoutUser() {
    unset($_SESSION['login']);
}

function getShoppingCart() {
    return $_SESSION['shoppingCart'];
}

function addToCart($productId, $quantity) {
    $_SESSION['shoppingCart'][$productId] = $quantity; 
}

function deleteFromCart($productId) {   
    unset($_SESSION['shoppingCart'][$productId]);
}

function emptyCart() {
    $_SESSION['shoppingCart'] = array();
}

function storeDeliveryAddressForSession ($id) {
    $_SESSION['deliveryAddressId'] = $id;
    return true; 
}

function getDeliveryAddressForSession () {
    return $_SESSION['deliveryAddressId'];
}

?>
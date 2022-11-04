<?php
require_once "UserCrud.php";

class ShopCrud extends UserCrud {

    // create
    function createProduct($name , $description, $price, $filename) {
        $params = get_defined_vars();
        $sql = "INSERT into products (name, description, price, filename)
                VALUES (:name, :description, :price, :filename)";
        $this->crud->createRow($sql, $params);
    }

    function createOrder($userId, $deliveryAddressId) {
        $params = get_defined_vars();
        $sql = "INSERT INTO orders (user_id, date, delivery_address_id) 
                VALUES (:userId, CURRENT_DATE(), :deliveryAddressId)";
        $this->crud->createRow($sql, $params);
    }

    function createDeliveryAddress ($userId, $address, $zipCode, $city, $phone) {
        $params = get_defined_vars();
        $sql = "INSERT INTO delivery_address (user_id, address, zip_code, city, phone) 
                VALUES (:userId, :address, :zipCode, :city,:phone)";
        $this->crud->createRow($sql, $params);
    }

    // read
    function readAllProducts() {
        $params = get_defined_vars();
        $sql = "SELECT * FROM products";
        return $this->crud->readManyRows($sql, $params);
    }

    function readProductById($productId) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM products WHERE id = :productId";
        return $this->crud->readOneRow($sql, $params);
    }

    function readDeliveryAddresses($userId) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM delivery_address WHERE user_id = :userId";
        return $this->crud->readManyRows($sql, $params);
    }

    function readDeliveryAddressByUserIdAndAddress ($userId, $address, $zipCode, $city) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM delivery_address WHERE user_id = :userId and address = :address and
                zip_code = :zipCode and city = :city";
        return $this->crud->readOneRow($sql, $params);
    }

    function readDeliveryById ($userId, $id) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM delivery_address WHERE id = :id and user_id = :userId";
        return $this->crud->readOneRow($sql, $params);
    }
}
?>
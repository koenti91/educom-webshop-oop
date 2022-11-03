<?php 

class UserCrud {

    private $crud;

    function __construct($crud) {
        $this->crud = $crud;
    }

    //create
    function createUser($name, $email, $password) {
        $params = get_defined_vars();
        $sql = "INSERT into users (name, email, password) VALUES (:name, :email, :password)";
        $this->crud->createRow($sql, $params);
        return true;
    }

    function createDeliveryAddress($userId, $address, $zipCode, $city, $phone) {
        $params = get_defined_vars();
        $sql = "INSERT INTO delivery_address (user_id, address, zip_code, city, phone) 
                VALUES (:userId, :address, :zipCode, :city', :phone)";
        $this->crud->createRow($sql, $params);
    }

    //read
    function readUserByEmail($email) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM users WHERE email = :email";
        return $this->crud->readOneRow($sql, $params);
    }

    function readUserById($id) {
        $params= get_defined_vars();
        $sql = "SELECT * FROM users WHERE id = :id";
        return $this->crud->readOneRow($sql, $params);
    }

    function readDeliveryAddresses($userId) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM delivery_address WHERE user_id = :userId";
        return $this->crud->readManyRows($sql, $params);
    }

    function readDeliveryAddressesByUserIdAndAddress($userId, $address, $zipCode, $city) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM delivery_address WHERE user_id = :userId and address = :address and
                zip_code = :zipCode and city = :city";
        return $this->crud->readOneRow($sql, $params);
    }

    function readDeliveryById ($userId, $id) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM delivery_address WHERE id = :id and user_id = :userId";
        return $this->crud->readOneRow ($sql, $params);
    }

    //update
    function updateUser($id, $password) {
        $params = get_defined_vars();
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $this->crud->updateRow($sql, $params);
        return true;
    }

    //delete
    function deleteUser($id) {
        $params= get_defined_vars();
        $sql = "DELETE FROM users WHERE id = :id";
        $this->crud->deleteRow($sql, $params);
        return true;
    }
}

?>
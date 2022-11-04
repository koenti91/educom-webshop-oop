<?php 

class UserCrud {

    protected $crud;

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
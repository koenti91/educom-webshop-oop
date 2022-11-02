<?php 

class UserCrud {

    private $crud;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function createUser($email, $name, $password) {
        $params = get_defined_vars();
        $sql = "INSERT into users (email, name, password) VALUES (:email, :name, :password)";
        $this->crud->createRow($sql, $params);
        return true;
    }

    function readUserByEmail($email) {
        $params = get_defined_vars();
        $sql = "SELECT * FROM users WHERE email = :email";
        return $this->crud->readOneRow($sql, $params);
    }

    function updateUser(int $id, User $user) {
        //
    }

    function deleteUser(int $id) {
        //
    }
}

?>
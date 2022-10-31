<?php 

class Crud {
    private $pdo;
    private $connstring = "mysql:host=localhost;dbname=koens_webshop";
    private $username = "koens_webshop";
    private $password = "Gebruiker098";

    public function __construct() {
        $this->pdo = new PDO($this->connstring, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createRow($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return true;
    }

    public function readOneRow($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function readManyRows($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateRow ($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return true;
    }
}

$crud = new Crud();
$sql = "SELECT * FROM users WHERE id = :id";
$params = array(":id" => 40);
print_r($crud->readManyRows($sql, $params));

?>
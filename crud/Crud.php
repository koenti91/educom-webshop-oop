<?php 

class Crud {
    private $pdo;
    private $connstring = "mysql:host=localhost;dbname=koens_webshop";
    private $username = "WebShopUser";
    private $password = "Gebruiker098.";

    public function __construct() {
        $this->pdo = new PDO($this->connstring, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function prepareAndBind ($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt;
    }

    public function createRow($sql, $params) {
        $this->prepareAndBind($sql, $params);
        return $this-> pdo -> LastInsertId();
    }

    public function readOneRow($sql, $params) {
        $stmt = $this->prepareAndBind($sql, $params);
        return $stmt->fetch();
    }

    public function readManyRows($sql, $params) {
        $stmt = $this->prepareAndBind($sql, $params);
        $results = $stmt->fetchAll();
        $array = array();
        foreach ($results as $result) {
            $array[$result->id] = $result;
        }
        return $array;
    }

    public function updateRow ($sql, $params) {
        $index = strpos($sql, "UPDATE ");
        if ($index === false || $index != 0) {
            throw new Exception("SQL does not start with UPDATE, but was " . $sql);
        }
        $index = strpos($sql, "WHERE");
        if ($index === false || $index < 8) {
            throw new Exception("SQL does not contain WHERE, but was " . $sql);
        }
        $this->prepareAndBind($sql, $params);
    }

    public function deleteRow ($sql, $params) {
        $index = strpos($sql, "DELETE FROM");
        if ($index === false || $index != 0) {
            throw new Exception("SQL does not start with DELETE FROM, but was " . $sql);
        }
        $index = strpos($sql, "WHERE");
        if ($index === false || $index < 12) {
            throw new Exception("SQL does not contain WHERE, but was " . $sql);
        }
        $this->prepareAndBind($sql, $params);
    }
}

?>
<?php

function connectDatabase() {

  $servername = "localhost";
  $username = "WebShopUser";
  $password = "Gebruiker098.";
  $dbname = "koens_webshop";
  
  $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        throw new Exception("Could not connect to database." . mysqli_connect_error());
      }

  return $conn;
}

function closeDatabase($conn) {
    mysqli_close($conn);
}

function findAll($conn, $sql) {
    try {
        $result = runQuery($conn, $sql);
        $resultarray = [];
        while ($row = mysqli_fetch_assoc($result)){
            $resultarray [$row["id"]] = $row;
        }
        return $resultarray;
    } 
    finally {
        closeDatabase($conn);
    }
}

function runQuery($conn, $sql) {
    $result = mysqli_query($conn, $sql);
        
    if(!$result) {
        throw new Exception("Query failed, SQL: " . $sql. "error" .mysqli_error($conn));
    }
    return $result;
}

function executeQuery($conn, $sql, $closeConnection = true) { 
    try {
        runQuery($conn, $sql);
        
        return mysqli_insert_id($conn);
    }

    catch (Exception $e) {
        $closeConnection = true;
        throw $e;
    }
    finally {
        if ($closeConnection) {
            closeDatabase($conn);
        }
    }
}

function findOne($conn, $sql) {
    try {
        $result = runQuery($conn, $sql);
        
        return mysqli_fetch_assoc($result);
    }

    finally {
        closeDatabase($conn);
    }
}

function findUserByEmail($email) {
    $conn = connectDatabase();

    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM users WHERE email = '". $email ."'";

    return findOne($conn, $sql);
}

function findUserByID($userId){
    $conn = connectDatabase();

    $userId = mysqli_real_escape_string($conn, $userId);
    $sql = "SELECT * FROM users WHERE id = '". $userId ."'";
    
    return findOne($conn, $sql);
}

function saveUser($name, $email, $password) {
    $conn = connectDatabase();
    
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

   return executeQuery($conn, $sql);
}

function changePassword($userId, $newPassword) {
    $conn = connectDatabase();

    $newPassword = mysqli_real_escape_string($conn, $newPassword);
    $userId = mysqli_real_escape_string($conn, $userId);
    $sql = "UPDATE users SET password = '$newPassword' WHERE id = $userId";

    executeQuery($conn, $sql);
}

function getAllProducts() {
    $conn = connectDatabase();

    $sql = "SELECT id, filename, name, price, description FROM products";

    return findAll($conn, $sql);
}
function findProductByID($productId){
    $conn = connectDatabase();

    $productId = mysqli_real_escape_string($conn, $productId);
    $sql = "SELECT * FROM products WHERE id = '". $productId ."'";
    
    return findOne($conn, $sql);
}

function saveOrder($userId, $deliveryAddressId, $cartRows) {
    $conn = connectDatabase();
    
    $sql = "INSERT INTO orders (user_id, date, delivery_address_id) VALUES ($userId, CURRENT_DATE(), ".$deliveryAddressId.")";

    $orderId = executeQuery($conn, $sql, false);

    foreach($cartRows as $cartRow) {
        $sql = " INSERT INTO order_products (order_id, product_id, quantity, price) 
                 VALUES ($orderId, " . $cartRow['productId'] . ", " . $cartRow['quantity'] . ", '" . ($cartRow['price']/100) . "')";
        executeQuery($conn, $sql, false);
    }
    closeDatabase($conn);
}

function findDeliveryAddresses($userId) {
    $conn = connectDatabase();

    $sql = "SELECT * FROM delivery_address WHERE user_id = $userId";

    return findAll($conn, $sql);
}

function findDeliveryAddressByUserAndAddress($userId, $address, $zipCode, $city) {
    $conn = connectDatabase();

    $sql = "SELECT * FROM delivery_address 
            WHERE user_id = $userId and address = '$address' and 
                  zip_code = '$zipCode' and city = '$city'";

    return findOne($conn, $sql);
}


function findDeliveryById($userId, $id) {
    $conn = connectDatabase();

    $sql = "SELECT * FROM delivery_address WHERE id = $id and user_id = $userId";

    return findOne($conn, $sql);
}

function saveDeliveryAddress($userId, $address, $zipCode, $city, $phone) {
    $conn = connectDatabase();

    $sql = "INSERT INTO delivery_address (user_id, address, zip_code, city, phone) VALUES ($userId, '$address', '$zipCode', '$city','$phone')";
    $id = executeQuery($conn, $sql, false);
    
    closeDatabase($conn);
    
    return $id;
}

?>
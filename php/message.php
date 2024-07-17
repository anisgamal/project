<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Contact{
    private $conn;

    public function __construct(){

    $host="localhost";
    $username="root";
    $password="";
    $dbname="project";
    $mysqli;


    try {
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}
public function messages($data) {
    if(empty($data['name']) || empty($data['email']) || empty($data['message'])) {
        return false;
    }
    
    $name = htmlspecialchars(strip_tags($data['name']));
    $email = htmlspecialchars(strip_tags($data['email']));
    $message = htmlspecialchars(strip_tags($data['message']));
    
    $sql = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $this->conn->prepare($sql);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    
    if($stmt->execute()) {
        return true;
    }
    
    return false;
}
}


?>
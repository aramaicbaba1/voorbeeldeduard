<?php
class Database{
    private $dbh;

    public function __construct() {
        $this->dbh = new PDO('mysql:host=localhost;dbname=product', 'root', '');
    }

    public function getConnection() {
        return $this->dbh;
    }

    public function select($sql,$placeholder = []) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholder);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function insert($sql,$placeholder) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholder);
    }

    public function delete($sql, $placeholders = []) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt->rowCount();
    }

    public function execute($sql, $placeholders = []) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt->rowCount();
    }

    public function login($username, $password) {
        $sql = "SELECT username, password FROM medewerker WHERE username=:username";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['username'=> $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result && password_verify($password, $result['password'])){
            session_start();
            $_SESSION['username'] = $username;
            header("location: medewerker.php");
            exit();
        }else{
            echo 'Username or password is incorrect.';
            exit();
        }
    }
}
?>
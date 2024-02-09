<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'pavlisji';
    private $username = 'pavlisji';
    private $password = 'KraKEN-30.12.1999';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $exception) {
            error_log("Chyba připojení k databázi: " . $exception->getMessage());
            throw new Exception("Chyba připojení k databázi: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>
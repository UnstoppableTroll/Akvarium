<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'dbakvarium';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);

            // Nastavení atributů PDO pro lepší zpracování chyb
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
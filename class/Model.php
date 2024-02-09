<?php
require_once 'Config.php';

class Model {
    private $conn;
    private $strana = 'akvarko';

    function __construct()
    {

        $database = new Database();
        $this->conn = $database->getConnection();
        
    }

    public function registraceUzivatele($username, $password) {
        try {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO uzivatel (Jmeno, Heslo) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashPassword);
    
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            error_log('Chyba databáze: ' . $e->getMessage());
            return false;
        }
    }
    
    public function ziskejRybky($limit = 10) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Ryba ORDER BY RybaID DESC LIMIT :limit");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log('Chyba při načítání rybek: ' . $e->getMessage());
            return [];
        }
    }
    
    public function ziskejVsechnyRybky() {
        try {
            $stmt = $this->conn->prepare("SELECT Jmeno, Barva FROM Ryba");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log('Chyba při načítání rybek: ' . $e->getMessage());
            return [];
        }
    }

    public function ziskejRybuUzivatele($uzivatelID) {
        try {
            $stmt = $this->conn->prepare("SELECT Jmeno, Barva FROM Ryba WHERE UzivatelID = :UzivatelID LIMIT 1");
            $stmt->bindParam(':UzivatelID', $uzivatelID, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log('Chyba při načítání ryby uživatele: ' . $e->getMessage());
            return null;
        }
    }
    

    public function prihlaseniUzivatele($username, $password) {
        try {
            
            $stmt = $this->conn->prepare("SELECT UzivatelID, Heslo FROM uzivatel WHERE Jmeno = :username");
    
      
            $stmt->bindParam(':username', $username);
    
          
            $stmt->execute();
    
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashPassword = $row['Heslo'];
                $uzivatelID = $row['UzivatelID'];
    
            
                if (password_verify($password, $hashPassword)) {
                    session_start();
                    $_SESSION['UzivatelID'] = $uzivatelID;
                    return true;
                }
            }
    
            return false;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function smazatRybu($rybaID) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM Ryba WHERE RybaID = :RybaID");
            $stmt->bindParam(':RybaID', $rybaID, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            error_log('Chyba při mazání ryby: ' . $e->getMessage());
            return false;
        }
    }

    
    public function nastavStranku($stranka){
        $this->strana = $stranka;
    }

    public function stranaZobrazeni()
    {
        switch ($this->strana){
            case 'akvarko':
                return array(null, 'akvarko');
            case 'akvarko':
                    return array(null, 'akvarko');
            case 'moje_ryba':
                return array(null, 'moje_ryba');
            case 'admin':
                    return array(null, 'admin');    

        }
    }

    public function aktualizujRybu($uzivatelID, $nazevRybky, $barvaRybky) {
        // Kontrola, zda již existuje záznam
        $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM Ryba WHERE UzivatelID = :UzivatelID");
        $checkStmt->bindParam(':UzivatelID', $uzivatelID);
        $checkStmt->execute();
    
        if ($checkStmt->fetchColumn() > 0) {
            $updateStmt = $this->conn->prepare("UPDATE Ryba SET Jmeno = :Jmeno, Barva = :Barva WHERE UzivatelID = :UzivatelID");
            $updateStmt->bindParam(':Jmeno', $nazevRybky);
            $updateStmt->bindParam(':Barva', $barvaRybky);
            $updateStmt->bindParam(':UzivatelID', $uzivatelID);
            $updateStmt->execute();
        } else {
            $insertStmt = $this->conn->prepare("INSERT INTO Ryba (UzivatelID, Jmeno, Barva) VALUES (:UzivatelID, :Jmeno, :Barva)");
            $insertStmt->bindParam(':UzivatelID', $uzivatelID);
            $insertStmt->bindParam(':Jmeno', $nazevRybky);
            $insertStmt->bindParam(':Barva', $barvaRybky);
            $insertStmt->execute();
        }
    }
    
}

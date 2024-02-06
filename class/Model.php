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
    


    public function prihlaseniUzivatele($username, $password) {
        try {
            // Příprava SQL dotazu pro vyhledání uživatele a získání jeho ID
            $stmt = $this->conn->prepare("SELECT UzivatelID, Heslo FROM uzivatel WHERE Jmeno = :username");
    
            // Vazba hodnot
            $stmt->bindParam(':username', $username);
    
            // Spuštění dotazu
            $stmt->execute();
    
            if ($stmt->rowCount() == 1) {
                // Získání dat z databáze
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashPassword = $row['Heslo'];
                $uzivatelID = $row['UzivatelID'];
    
                // Ověření hesla
                if (password_verify($password, $hashPassword)) {
                    // Přihlášení úspěšné, nastavení UzivatelID do session
                    session_start();
                    $_SESSION['UzivatelID'] = $uzivatelID;
                    return true;
                }
            }
    
            return false;
        } catch(PDOException $e) {
            // V případě chyby vrátit false
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
}

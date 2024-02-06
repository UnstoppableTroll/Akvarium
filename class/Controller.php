<?php
class Controller {
    private $Model;

    function __construct($model) {
        $this->Model = $model;
    }

    public function zkontroluj() {
        if (isset($_GET['akvarko'])) {
            $this->Model->nastavStranku('akvarko');
        }
        if (isset($_GET['rybka'])) {
            $this->Model->nastavStranku('moje_ryba');
        }
        if (isset($_GET['admin'])) {
            $this->Model->nastavStranku('admin');
        }
    }

    public function handleDeleteFish() {
        if (isset($_POST['ryba_id'])) {
            $rybaID = $_POST['ryba_id'];
            return $this->Model->smazatRybu($rybaID);
        }
    }

    public function handleLogin() {
        if (isset($_POST['jmeno_login'], $_POST['heslo_login'])) {
            $username = $_POST['jmeno_login'];
            $password = $_POST['heslo_login'];
    
            if ($this->Model->prihlaseniUzivatele($username, $password)) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['username'] = $username;
    
                // Kontrola, zda je uživatel admin
                if ($_SESSION['UzivatelID'] == 1) {
                    header('Location: index.php?admin');
                } else {
                    header('Location: index.php?rybka');
                }
                exit;
            } else {
                return "Nesprávné uživatelské jméno nebo heslo!";
            }
        }
    }
    
    public function handleRegister() {
        if (isset($_POST['jmeno_registrace'], $_POST['heslo_registrace'])) {
            $username = $_POST['jmeno_registrace'];
            $password = $_POST['heslo_registrace'];
    
            if ($this->Model->registraceUzivatele($username, $password)) {
                return "Registrace byla úspěšná, nyní se můžete přihlásit.";
            } else {
                return "Nepodařilo se zaregistrovat.";
            }
        }
    }
    
}
?>

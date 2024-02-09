<?php
class Controller {
    private $Model;

    function __construct($model) {
        $this->Model = $model;
    }


    public function zobrazRybky() {
        if (!isset($_SESSION['user_logged_in']) || $_SESSION['UzivatelID'] != 1) {
            header('Location: index.php?rybka');
            exit;
        }
    
        return $this->Model->ziskejRybky();
    }
    
    public function inicializace() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ryba_id'])) {
            $this->handleDeleteFish();
        }
    }

    
    public function zobrazAkvarko() {
        if (!isset($_SESSION['user_logged_in'])) {
            header('Location: login.php');
            exit;
        }
    
        return $this->Model->ziskejVsechnyRybky();
    }

    public function zobrazMojeRyba() {
        $uzivatelID = $_SESSION['UzivatelID'] ?? null;
        if (!$uzivatelID) {
            header('Location: login.php');
            exit;
        }
    
        return $this->Model->ziskejRybuUzivatele($uzivatelID);
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

    public function pridejAktualizujRybu($uzivatelID, $nazevRybky, $barvaRybky) {
        if (!isset($_SESSION['user_logged_in'])) {
            header('Location: login.php');
            exit;
        }
    
        $this->Model->aktualizujRybu($uzivatelID, $nazevRybky, $barvaRybky);
        header('Location: index.php?akvarko');
        exit;
    }
    
}



?>

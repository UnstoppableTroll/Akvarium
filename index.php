<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start(); 
require_once 'class/Config.php';
require_once 'class/Model.php';
require_once 'class/Controller.php';
require_once 'class/View.php';

$model = new Model();
$controller = new Controller($model);
$view = new View($model);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'pridejAktualizujRybu':
            $uzivatelID = $_SESSION['UzivatelID'] ?? null;
            $nazevRybky = $_POST['fishName'];
            $barvaRybky = $_POST['fishColor'];
            if ($uzivatelID) {
                $controller->pridejAktualizujRybu($uzivatelID, $nazevRybky, $barvaRybky);
            }
            break;
    }
}


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();


    header('Location: index.php');
    exit();
}


function auto_nacti_tridu($nazevTridy) {
    require 'class/'.$nazevTridy.'.php';
}

spl_autoload_register('auto_nacti_tridu');

$m = new Model();
$c = new Controller($m);
$v = new View($m);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $loginError = $c->handleLogin($_POST['jmeno_login'], $_POST['heslo_login']);
    } elseif (isset($_POST['register'])) {
        // Zpracování registrace
        $registerMessage = $c->handleRegister($_POST['jmeno_registrace'], $_POST['heslo_registrace']);
    }
}



if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    $c->zkontroluj();
    $v->vypisObsah();
} else {
    $v->showLoginRegisterForm(isset($loginError) ? $loginError : '', isset($registerMessage) ? $registerMessage : '');
}

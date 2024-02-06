<?php
session_start(); 



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


// Zpracování požadavků na přihlášení nebo registraci
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Zpracování přihlášení
        $loginError = $c->handleLogin($_POST['jmeno_login'], $_POST['heslo_login']);
    } elseif (isset($_POST['register'])) {
        // Zpracování registrace
        $registerMessage = $c->handleRegister($_POST['jmeno_registrace'], $_POST['heslo_registrace']);
    }
}


// Rozhodnutí, co zobrazit: přihlašovací/registrační formulář nebo obsah stránky
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    // Uživatel je přihlášen, zobrazit obsah
    $c->zkontroluj();
    $v->vypisObsah();
} else {
    // Uživatel není přihlášen, zobrazit přihlašovací/registrační formulář
    $v->showLoginRegisterForm(isset($loginError) ? $loginError : '', isset($registerMessage) ? $registerMessage : '');
}

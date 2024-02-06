<?php
class View {

    private $model;

    function __construct($model) {
        $this->Model = $model;
    }

    public function vypisObsah() {
        $data = $this->Model->stranaZobrazeni();
        $TplData = $data[0];
        include 'templates/'.$data[1].'.php';
    }

    public function showLoginRegisterForm($loginError = '', $registerMessage = '') {
        include 'templates/login.php'; // Cesta k šabloně
    }


}

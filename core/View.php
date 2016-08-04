<?php

class View {

    function __construct() {
        
        //echo 'View was created <br />';
    }

    public function render($view) {
        
        require_once 'views/' . $view . '/index.php';
    }
}


<?php

class Controller {

    function __construct() {
        
        //echo 'Base-controller was created <br>';
        $this->_view = new View();
    }
    
    public function model($model) {
        
        require_once './models/' . $model . '.php';
        
        // check of file exists
        return new $model();
    }

}


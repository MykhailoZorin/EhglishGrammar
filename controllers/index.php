<?php

class Index extends Controller {

    function __construct() {
        
        parent::__construct();
        //echo 'Index-controller was created <br />';
    }

    public function index() {
    
        $this->_view->render('index');
    }

    public function other() {
        
        $data = func_get_args();
        echo 'other()-method was created <br />';
        
        foreach ($data as $arg) {
            
            echo $arg, "<br>";
        }
        
        $this->_view->render('index');
    }
}


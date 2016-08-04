<?php

class Error extends Controller {

    function __construct() {
        
        parent::__construct();
        //echo 'Error-controller was created <br>';
        
    }
    
    function index() {
        
        //echo 'error->index() was called <br>';
        $this->_view->msg = "This page does not exist";
        $this->_view->render('error');
    }
}

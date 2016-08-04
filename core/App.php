<?php

/* Bootstrap */

class App {

    //private $_controller = "index";
    private $_controller = "error";
    private $_method = "index";
    private $_params = array();
    
    
    function __construct() {

        $url = isset($_GET['url']) ? $this->_parseUrl($_GET['url']) : FALSE;
        
        //echo $_GET['url'] , "<br />";
        
        if(!$url) {
            
            $this->_controller = "index";
        }
        
        // controller checking
        if(file_exists('./controllers/' . $url[0] . '.php')) {

            $this->_controller = $url[0];
        }

        unset($url[0]);
        require_once './controllers/' . $this->_controller . '.php';
        $this->_controller = new $this->_controller();

        // method checking
        if(isset($url[1])) {

            if(method_exists($this->_controller, $url[1])) {

                $this->_method = $url[1];
                unset($url[1]);

                $this->_params = $url ? array_values($url) : array();
            }
        }

        call_user_func_array(array($this->_controller, $this->_method), $this->_params);
    }
    
    private function _parseUrl($url) {
        
        $url = false;
        
        if(isset($_GET['url'])) {

            $url = $_GET['url'];
            
            // trim of "/" symbols
            $url = trim($url, "/");
            
            // validate url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            
            // explode to array
            $url = explode('/', $url);
        }
        
        return $url;
    }
}

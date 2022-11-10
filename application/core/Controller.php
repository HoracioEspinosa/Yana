<?php

/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Default controller for load middlewares
 * 
 * @property CI_Router $router
 */

class Controller extends CI_Controller
{
    /** @var IUserModel $user */
    public static $user = null;
    
    protected $middlewares = array();
    
    public function __construct(){
        parent::__construct();
        
        $this->_run_middlewares();
    }

    protected function middleware(){
        return array(
            'auth'
        );
    }

    protected function _run_middlewares(){
        $this->load->helper('inflector');
        $middlewares = $this->middleware();
        
        foreach($middlewares as $middleware){
            $middlewareArray = explode('|', str_replace(' ', '', $middleware));
            $middlewareName = $middlewareArray[0];
            $runMiddleware = true;
            
            if(isset($middlewareArray[1])){
                $options = explode(':', $middlewareArray[1]);
                $type = $options[0];
                $methods = explode(',', $options[1]);
                if ($type == 'except') {
                    if (in_array($this->router->method, $methods)) {
                        $runMiddleware = false;
                    }
                } else if ($type == 'only') {
                    if (!in_array($this->router->method, $methods)) {
                        $runMiddleware = false;
                    }
                }
            }
            
            $filename = ucfirst(camelize($middlewareName)) . 'Middleware';
            
            if ($runMiddleware) {
                if (file_exists(APPPATH . 'middlewares/' . $filename . '.php')) {
                    require APPPATH . 'middlewares/' . $filename . '.php';
                    $ci = &get_instance();
                    $object = new $filename($this, $ci);
                    $this->middlewares[$middlewareName] = $object;
                    $object->run();
                }
            }

        }
    }
}
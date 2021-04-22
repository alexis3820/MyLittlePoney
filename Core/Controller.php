<?php

final class Controller
{
    private $url;

    public function __construct ($controller, $action, $options){
        // check if controller is not empty and exist (else default is instantiate)
        if (empty($controller) || !class_exists($controller)) {
            $this->url['controller'] = 'DefaultController';
        } else {
            $this->url['controller'] = ucfirst($controller).'Controller';
        }

        // check if action is not empty and exist (else default is instantiate)
        if (empty($action) || !method_exists($this->url['controller'], $action.'Action')) {
            $this->url['action'] = 'defaultAction';
        } else {
            $this->url['action']  = $action.'Action';
        }

        // give potential parameters to action
        $this->url['options']  = $options;
    }

    public function run(){
        call_user_func_array(array(new $this->url['controller'],
            $this->url['action']), array($this->url['options']));
    }
}
<?php

final class View
{
    public static function openBuffer(){
        ob_start();
    }

    public static function getBufferContent(){
        return ob_get_clean();
    }

    public static function render($path, $data = array()){
        $file = Constants::viewsRepository().$path.'.php';
        $view = $data; // use $view in Views !
        ob_start();
        include $file; // <---- use $view ! She is include under buffer
        ob_end_flush();
    }
}
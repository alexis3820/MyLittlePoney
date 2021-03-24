<?php

require 'Core/Constants.php';

final class Autoloader
{
    public static function loadCore($class)
    {
        $file = Constants::coreRepository()."$class.php";
        Autoloader::_load($file);
    }

    public static function loadModels($class)
    {
        $file = Constants::modelsRepository()."$class.php";
        Autoloader::_load($file);
    }


    public static function loadViews($class)
    {
        $file = Constants::viewsRepository()."$class.php";
        Autoloader::_load($file);
    }

    public static function loadControllers($class)
    {
        $file = Constants::controllersRepository()."$class.php";
        Autoloader::_load($file);
    }

    private static function _load($file){
        if (is_readable($file)) {
            require $file;
        }
    }
}

spl_autoload_register('Autoloader::loadCore');
spl_autoload_register('Autoloader::loadModels');
spl_autoload_register('Autoloader::loadViews');
spl_autoload_register('Autoloader::loadControllers');

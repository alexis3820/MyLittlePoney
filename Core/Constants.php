<?php

final class Constants
{
    const VIEWS_REPOSITORY        = '/Views/';
    const MODELS_REPOSITORY      = '/Models/';
    const CORE_REPOSITORY       = '/Core/';
    const CONTROLLERS_REPOSITORY = '/Controllers/';

    public static function rootRepository() {
        return realpath(__DIR__ . '/../');
    }

    public static function coreRepository() {
        return self::rootRepository() . self::CORE_REPOSITORY;
    }

    public static function viewsRepository() {
        return self::rootRepository() . self::VIEWS_REPOSITORY;
    }

    public static function modelsRepository() {
        return self::rootRepository() . self::MODELS_REPOSITORY;
    }

    public static function controllersRepository() {
        return self::rootRepository() . self::CONTROLLERS_REPOSITORY;
    }

}
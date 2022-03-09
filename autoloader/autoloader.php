<?php
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'Autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function Autoload($class){
        if(file_exists('controller/' . $class . '.php')){
        require 'controller/' . $class . '.php';
        }
        elseif(file_exists('model/entity/' . $class . '.php')){
            require 'model/entity/' . $class . '.php';
        }
        elseif(file_exists('model/repository/' . $class . '.php')){
            require 'model/repository/' . $class . '.php';
        }
        else{
            echo 'Erreur';
        }
    }
}
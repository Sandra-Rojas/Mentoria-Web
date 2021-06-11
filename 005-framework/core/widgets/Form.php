<?php

namespace app\core\widgets;
use app\core\Model;

class Form{

    public static function begin($action, $method)
    {
        //format phyton
        //%s string , %d numeros
        //return sprintf('<form action="%s" method="%s">', $action, $method);
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();

    }

    public static function end()
    {

        echo '</form>';
    }
    
    //typehint parametro es de un tipo especifico
    //Polimorfismo 
    public static function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);

    }
  
}
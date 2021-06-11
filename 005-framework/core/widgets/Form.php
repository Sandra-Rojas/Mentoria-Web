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
    
    public function __toString()
    {
        return sprintf('
        <div class="mb-3">
            <label class="form-label">%s</label>
            <input type="text" name = %s value=%s class="form-control %s">

            <div class="invalid-feedback">   
                %s
            </div>
  </div>
   ',
   $this->attribute,
   $this->type,
   $this->attribute,
   $this->model->{$this->attribute} , //$this->model->firstname 
   $this->model->hasError($this->attribute) ? 'is-invalid' : ' ',
   $this->model->getFirstError('firstname')
    );
  }

}
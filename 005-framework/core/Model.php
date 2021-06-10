<?php

namespace app\core;

//evita que se cree una instancia de Model
abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value){
            if (property_exists($this, $key)){
                $this->$key = $value;
                //$this->firstname= "Juan"
            }
        }
    }

    //obliga a clases hijas implemetar este metodo
    abstract public function rules(): array;

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules){
            $value = $this->$attribute; // $this->firstaname
            foreach($rules as $rule){
                $rulename = $rule;

                if (!is_string($rulename)) {
                    $rulename = $rule[0];
                }

                if($rulename === self:: RULE_REQUIRED && !$value){
                    //agregar error
                    // echo "\nRULE_REQUIRED ".$rule. "\n";
                    $this->addError($attribute, self::RULE_REQUIRED, $rule);
                }

                if($rulename === self:: RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    //agregar error
                    // echo "\nRULE_EMAIL ". $rule. "\n";
                    $this->addError($attribute, self::RULE_EMAIL, $rule);
                }

                if($rulename === self:: RULE_MIN && strlen($value) < $rule['min']){
                    //agregar error
                    // echo "\nRULE_MIN ". $rule. "\n";
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if($rulename === self:: RULE_MAX && strlen($value) > $rule['max']){
                    //agregar error
                    // echo "\nRULE_MAX ". $rule. "\n";
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if($rulename === self:: RULE_MATCH && $value != $this->{$rule['match']}){
                    //agregar error
                    // echo "\nRULE_MATCH ". $rule. "\n";
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }

            }
        }
        return empty($this->errors);
    }

    public function addError ($attribute, $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        //echo "\n message tiene error:". $message. "****************\n";
        if (is_array($params) || is_object($params)){
            foreach($params as $key => $param){
                // echo "<pre>";
                // echo "----------\n";
                // echo "params: " ;
                // print_r($params);
                // echo "\n param: ". $param;
                // echo "\n key: ". $key;
                // echo "\n message: " . $message;
                
                $message = str_replace("{{$key}}", $param, $message);
                // echo "\n Despues de reemplazar message: " . $message;
                // echo "<pre>";
            }
        }
        

        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This field must be an email',
        self::RULE_MIN => 'Min length of the field must be {min}',
        self::RULE_MAX => 'Max length of the field must be {max}',
        self::RULE_MATCH => 'This fiels must be the same as {match}',
        ];
    }

    public function hasError($attribute)
    {
        return isset($this->errors[$attribute][0]);
        //return $this->errors[$attribute][0] ?? false;

    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}    

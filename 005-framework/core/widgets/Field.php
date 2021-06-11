<?php

namespace app\core\widgets;
use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public Model $model;
    public string $attribute;
    public string $type;

    //metodo magico comienzan con __
    public function __construct(Model $model, string $attribute)
    {

        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;



    }


}
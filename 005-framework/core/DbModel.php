<?php

namespace app\core;

abstract class DbModel extends Model
{
    //clase hija debe implementar nombretabla y atributos(campos de la tb)
    abstract public  function tableName(): string;
    abstract public function attributes(): array;

    public function save()
    {
        $pdo = Application::$app->db->pdo;
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        //var_dump($attributes);

        //funcion arrow (fn())
        //array_map mapea(formatea) un atributo(valor) de un arreglo y le antepone :
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        
        
        //INSERT INTO users2 ( firstname,lastname) VALUES (:firstname, :lastname...)
        //implode a partir de arreglo genera cadena de elemtos separado por ","
        $statement = $pdo->prepare("
        INSERT INTO $tableName 
            (". implode(",",$attributes) .") 
        VALUES
            (". implode(",",$params) .")
        ");

        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
            //$statement->bindValue(":firstname", $this->firstanme);
            //$statement->bindParam(); tercer parametro indica tipo string o int, 
            //pdo valida que el atributo es el correcto para el tipo de dato
        }
        $statement->execute();
        return true;
    }


}
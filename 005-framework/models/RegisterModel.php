<?php
namespace app\models; /***lo agregue por Application */
namespace app\core;
//use app\core\Model;
use app\core\DbModel;

//class RegisterModel extends Model
class RegisterModel extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = ''; 
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'users2';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return  parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8 ]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    //se debe mejorar con script
    public function attributes(): array
    {
            // return [
            //         'firstName',
            //         'lastName',
            //         'email',
            //         'password',
            // ];
            $pdo = Application::$app->db->pdo;
            $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                    WHERE TABLE_SCHEMA= 'registro' 
                    AND TABLE_NAME= 'users2'";

            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_COLUMN);//devuelve array unidimensional
    }

}
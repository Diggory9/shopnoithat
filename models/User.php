<?php
namespace app\models;

use app\core\DbModel;
use app\core\Model;


class User extends DbModel
{
    public int $user_id;
    public string $user_firstname ='';
    public string $user_lastname='';
    public string $user_email ='';
    public string $user_password ='';
    public string $ConfirmPassword='';




 

    public function __construct()
    {
        
        if (!isset($_SESSION['user']))
        {
            $_SESSION['user'] = array();
        }
        
    }

    public function tableName(): string
    {
        return "user";
    }

    public function attribute():array
    {
        return ['user_firstname', 'user_lastname', 'user_email','user_password'];
    }

    public function primaryKey() : string
    {
        return 'user_id';
    }

    public function register()
    {
        $this->user_password = md5($this->user_password);
        return $this->save(['user_firstname', 'user_lastname', 'user_email','user_password']);
    }

    public function getUserByEmail()
    {
        return $this->findOne(['user_email'=>$this->user_email]);
    }
    public function getUserById($id)
    {
        return self::findOne(['user_id'=>$id]);
    }
    public function rules()
    {
        return [
            'user_firstname'=>[self::RULE_REQUIRED],
            'user_lastname'=>[self::RULE_REQUIRED],
            'user_email'=>[self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_UNIQUE,'class'=>$this::class]],
            'user_password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>4]],
            'ConfirmPassword'=>[self::RULE_REQUIRED,[self::RULE_MACTH,'match'=>'user_password']]
        ];
    }
    public function checkAdmin()
    {
        $sql ="SELECT u.user_id, u.user_email, u.user_firstname, u.user_lastname, u.user_phone, u.user_address, u.user_password, u.status
        FROM user u
        JOIN user_role ur ON u.user_id = ur.user_id
        JOIN role r ON ur.role_id = r.role_id
        WHERE r.role_name = 'admin' AND u.user_id = :id;";

        $stm = $this->prepare($sql);
        $stm->bindParam(':id', $this->user_id, \PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetch();
        if($data)
            return true;
        return false;

    }
}
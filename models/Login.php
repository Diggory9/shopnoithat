<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Model;


class Login extends Model
{

    public string $email;
    public string $password;

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>4]]
        ];
    }

    public function  login(){

        
        $user =new User();
        $user = $user->findOne(['user_email'=>$this->email]);
       
        if(empty($user))
        {
            $this->addErrors('email','User dose not exits with this email');
            return false;
        }
        if($user->user_password != md5($this->password))
        {
            $this->addErrors('password','Password is incorrect!');
            return false;
        }
        Application::$app->login($user);

        
        return true;
        
    }

}
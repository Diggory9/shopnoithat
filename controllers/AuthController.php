<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Respone;
use app\models\Login;
use app\models\User;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{

    

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }
    public function login(Request $request)
    {

        $userLogin = new Login();
        if($request->isPost())
        {
            $userLogin->loadData($request->getBody());
            if( $userLogin->validate() && $userLogin->login())
            {
                Application::$app->session->setFlash('success','Login success!'); 
                
                //$backUrl = $_SERVER['HTTP_REFERER'];
                Application::$app->response->redirect('/');
            }
         
            return $this->render('login',['models'=>$userLogin]);
        }
        $this->setLayout('auth');
        return $this->render('login',['models'=>$userLogin]);
    } 
    public function register(Request $request)
    {
        $registerModel = new  User();
       
        if($request->isPost())
        {
            $registerModel->loadData($request->getBody());
           
            if($registerModel->validate() && $registerModel->register())
            {
                Application::$app->session->setFlash('success','Thanks for registering!');
                // session luu thong tin dang nhap

                //Lấy dữ liệu vừa đăng ký qua email
                $user = $registerModel->getUserByEmail();
                Application::$app->login($user);
                $currentUrl = $_SERVER['HTTP_REFERER'];
                Application::$app->response->redirect('/');
                
            }

            return $this->render('register',['model'=> $registerModel]);
        }
        $this->setLayout('auth');
        return $this->render('register',['model'=> $registerModel]);
    }
    public function  logout()
    {
        Application::$app->logout();
        Application::$app->session->setFlash('success','Logout success!');
        sleep(2);
        Application::$app->response->redirect('/');
    }
    public function profile()
    {
        return $this->render('profile');
    }
}
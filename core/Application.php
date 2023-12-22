<?php 


namespace app\core;

use app\models\User;

class Application{

    public static $ROOT_DIR;
    public Router $router;
    public Request $requset;
    public Respone $response;
    public Session $session;
    public Database $db;
    public ?User $user;
    public View $view;
    public $layout ='';
    public Controller $controller;
    public static Application $app;
    public function __construct($rootpath)
    {
        $this->controller = new Controller();
        self::$ROOT_DIR = $rootpath;
        self::$app = $this;
        $this->requset = new Request();
        $this->response = new Respone();
        $this->session = new Session();
        $this->router = new Router ($this->requset,$this->response);
        $this->db = Database::getInstance();
        $this->view = new View();
        $primaryValue = $this->session->get('user');
        $this->user = new User();
        if(!empty($primaryValue))
        {
             $primaryKey =  $this->user->primaryKey();
             $this->user=  $this->user->findOne([$primaryKey=>$primaryValue]);
        }else{
            $this->user = null;
        }
        $this->layout ='main';

    }

    
    public function getController()
    {
        return $this->controller;
    }
    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }


    public function login(DbModel $user)
    {
        
       
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};

        // check role 
        $this->session->set('user', $primaryValue);
        return true;
    }
    public  function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public function isGuest()
    {
        return !self::$app->user;
    }
    public function isAdmin()
    {
        if(self::$app->user)
            return self::$app->user->checkAdmin();
        return false;
    }



    
    public function run()
    {
        try{
            echo $this->router->resolve();
        }
        catch(\Exception $ex)
        {
            
            echo $this->view->renderView('errors/_error',[
                'exception'=> $ex
            ]);
        }
    }
}
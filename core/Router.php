<?php

namespace app\core;

use app\core\exceptions\NotFound;
use app\core\exceptions\NotFoundException;
use app\core\Request;
class Router
{
    public Request $request;
    public Respone $response;

    protected array $routes =[];
    
    public function __construct(Request $request, Respone $respone){
        $this->request = $request;
        $this->response = $respone;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;

    }
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;

    }
    
    
    public function resolve()
    {
        //todo
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        
        $callback = $this->routes[$method][$path]?? false;
        if($callback === false)
        {
           $this->response->setStatusCode(404);
            throw new NotFoundException();
            
        }
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        if(is_array($callback))
        {
            /**  @var \app\core\Controller $controller */
          
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach($controller->getMiddlewares() as $middleware)
            {
                $middleware->execute();
            }
        }

        return call_user_func($callback,$this->request, $this->response);
       
    }
    public function renderView($view, $params=[])
    {

       return Application::$app->view->renderView($view,$params);
    }
}
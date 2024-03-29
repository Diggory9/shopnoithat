<?php
namespace app\core;

class View
{
    public string $title = '';

    public function renderView($view, $params=[])
    {

        $viewContent = $this->rederOnlyView($view,$params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent,$layoutContent);
    }
    public function renderContent($content)
    {

        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $content,$layoutContent);
    }


    protected function layoutContent()
    {
        
            
            $layout = Application::$app->layout;
            if(Application::$app->controller)
            {
                $layout = Application::$app->controller->layout;
            }
        ob_start();
        include_once  Application::$ROOT_DIR.'/views/layouts/'.$layout.'.php';
        return ob_get_clean();
    }
    protected function rederOnlyView($view,$params) 
    {
     
        extract($params);
        ob_start();
        include_once  Application::$ROOT_DIR.'/views/'.$view.'.php';
        return ob_get_clean();
    }
}


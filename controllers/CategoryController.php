<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Category;

use app\core\Application;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // $category = new Category();
        // if ($request->isPost())
        // {
        //     $category->loadData($request->getBody());
        //     if ($category->validate() && $category->insertData())
        //     {
        //         Application::$app->session->setFlash('success', 'Insert Data category successfuly!');
        //         Application::$app->response->redirect('/admin/category');
        //     }
        //     else
        //     {
        //         Application::$app->session->setFlash('error', 'Error insert data category!');
        //         Application::$app->response->redirect('/admin/category/add');
        //     }
        // }

        $category = new Category();
        $dataAll = $category->selectAll();

      
        $this->setLayout('admin');
        return $this->render('category/showTable',['categoris'=>$dataAll]);
        
    }

    public function add(Request $request)
    {
         $category = new Category();
        if ($request->isPost())
        {
            $category->loadData($request->getBody());
            if ($category->validate() && $category->insertData())
            {
                Application::$app->session->setFlash('success', 'Insert Data category successfuly!');
                Application::$app->response->redirect('/admin/category');
            }
            else
            {
                Application::$app->session->setFlash('error', 'Error insert data category!');
                return $this->render('category/showAdd',['model'=> $category]);
            }
        }
        $this->setLayout('admin');
        return $this->render('category/showAdd',['model'=> $category]);
    }
}



?>
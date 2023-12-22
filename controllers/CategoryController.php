<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Category;

use app\core\Application;
use app\core\Respone;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = new Category();
        $reqGet = $request->getBody();
        if(!empty($reqGet['category_id'])){
            $id = $reqGet['category_id'];
           
            $data = $category->getCategoryById($id);
            $dataAll[] = $data;
            if(!empty($dataAll)){
                $this->setLayout('admin');
                return $this->render('category/showTable',['categoris'=>$dataAll]);
            }
            
            
        }
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
                $this->setLayout('admin');
                return $this->render('category/showAdd',['model'=> $category]);
            }
        }
        $this->setLayout('admin');
        return $this->render('category/showAdd',['model'=> $category]);
    }
    public function edit (Request $request,Respone $respone)
    {
        $category = new Category();
        if ($request->isPost())
        {
            $category->loadData($request->getBody());
           
            if ($category->validate() && $category->updateCategory())
            {
                
                Application::$app->session->setFlash('success', 'Update data category successfuly!');
                Application::$app->response->redirect('/admin/category');
            }
            else
            {
                Application::$app->session->setFlash('error', 'Error insert data category!');
                $this->setLayout('admin');
                return $this->render('category/showEdit',['model'=> $category]);
            }
        }
        $reqGet= $request->getBody();
        $dataOne=$category->findOne(['category_id'=>$reqGet['id']]);
        $this->setLayout('admin');
        return $this->render('category/showEdit',['model'=> $dataOne]);
    }

    public function remove(Request $request)
    {
        $category = new Category();
        if ($request->isGet())
        {
           $reqGet = $request->getBody();
           $category->category_id = $reqGet['id'];
         
            if ($category->removeCategory())
            {
                
                Application::$app->session->setFlash('success', 'drop data category successfuly!');
                Application::$app->response->redirect('/admin/category');
            }
            else
            {
                Application::$app->session->setFlash('error', 'Không thể xóa danh mục này vì đang chứa sản phẩm!');
                Application::$app->response->redirect('/admin/category');
            }
        }
    }
}



?>
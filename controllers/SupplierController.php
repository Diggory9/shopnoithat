<?php
    namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Supplier;

    class SupplierController extends Controller
    {
        public function index(Request $request){
            
            $supplier = new Supplier();
            $dataAll = $supplier->selectAll();
            $this->setLayout('admin');
            return $this->render('supplier/showTable',['suppliers'=>$dataAll]);

        }

        public function add(Request $request)
        {
            $supplier = new Supplier();
            if ($request->isPost())
            {
                $supplier->loadData($request->getBody());
                echo '<pre>';
                //var_dump($supplier);
                echo '</pre>';
                if ($supplier->validate() && $supplier->insertData())
                {
                    Application::$app->session->setFlash('success', 'Insert data supplier successfuly!');
                    Application::$app->response->redirect('/admin/supplier');
                }
                else
                {
                    Application::$app->session->setFlash('error', 'Error insert data supplier!');
                    $this->setLayout('admin');
                    return $this->render('supplier/showAdd',['model'=> $supplier]);
                }
            }
            $this->setLayout('admin');
            return $this->render('supplier/showAdd',['model'=> $supplier]);
        }
        public function edit(Request $request)
        {
            $supplier = new Supplier();
            if ($request->isPost())
            {
                $supplier->loadData($request->getBody());
                echo '<pre>';
                //var_dump($supplier);
                echo '</pre>';
                if ($supplier->validate() && $supplier->upateSupplier(['supplier_name'=>$supplier->supplier_name,
                'contact_email'=>$supplier->contact_email, 'supplier_phone'=>$supplier->supplier_phone,
                'supplier_address'=>$supplier->supplier_address],['supplier_id'=>$supplier->supplier_id]))
                {
                    Application::$app->session->setFlash('success', 'Edit data supplier successfuly!');
                    Application::$app->response->redirect('/admin/supplier');
                }
                else
                {
                    Application::$app->session->setFlash('error', 'Error edit data supplier!');
                    $this->setLayout('admin');
                    return $this->render('supplier/showEdit',['model'=> $supplier]);
                }
            }
            // lấy dữ liệu từ request
            $reqGet = $request->getBody();
            // lấy data từ id
            $supplier = $supplier->getSupplierById($reqGet['id']);
            $this->setLayout('admin');
            return $this->render('supplier/showEdit',['model'=> $supplier]);
        }
        public function remove(Request $request)
        {
            $supplier = new Supplier();
            if ($request->isGet())
            {
               $reqGet = $request->getBody();
                if ($supplier->removeSupplierById($reqGet['id']))
                {
                    
                    Application::$app->session->setFlash('success', 'drop data category successfuly!');
                    Application::$app->response->redirect('/admin/supplier');
                }
                else
                {
                    Application::$app->session->setFlash('error', 'Không thể xóa danh mục này vì đang chứa sản phẩm!');
                    Application::$app->response->redirect('/admin/supplier');
                }
            }
        }
    }


?>
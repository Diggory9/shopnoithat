<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\models\Cart;
use app\models\Category;
use app\models\Product;
use app\models\ProductImage;
use app\models\Supplier;

class ProductController extends Controller
{
    private $product;
    private $category;
    private $supplier;
    private $cart;
    

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->supplier = new Supplier();
        $this->cart = new Cart($_SESSION['cart']);
        $this->registerMiddleware(new AdminMiddleware(['productIndexAdmin','productAddAdmin','productDetailAdmin']));
    }
    public function productIndexAdmin(Request $request){
        $reqGet = $request->getBody();
        if(!empty($reqGet['selectOption']) )
        {
           
            echo 1;
            $option = $reqGet['selectOption'];
            if($option == "pro_almost")
            {
                $data = $this->product->getProductAlmostAll();
                
            }else if($option == 'pro_all')
            {
                $data = $this->product->getProductByPage();
            }
        }else if(!empty($reqGet['product_name']))
        {
            $name = $reqGet['product_name'];
            $data = $this->product->getProductByProductName($name);
        }
      else{
            $data = $this->product->getProductByPage();
        }
        foreach ($data as $value)
        {
            $category = $this->category->getCategoryById($value->category_id);
            $value->category = $category;
            $supplier = $this->supplier->getSupplierById($value->supplier_id);
            $value->supplier = $supplier;
        }

        $this->setLayout('admin');
        return $this->render('product/showTable', ['data' => $data]);
    }
    public function showDetail(Request $request)
    {
        $reqGet = $request->getBody();
        $id = $reqGet['id'];
        $pro = new Product();

        $image = new ProductImage();
        $proData = $pro->getProductById($id);
        $imageData = $image->getImageByProductId($id);

        // show 4 sản phẩm ngẫu nhiên
        $randomPro = $pro->getProductRand(4);
        $imageProRand = new ProductImage();
        foreach ($randomPro as $value)
        {
            $dataImg = $imageProRand->getImageByProductId($value->product_id);
            if (isset($dataImg))
            {
                $value->images = $dataImg;
            }
        }
        return $this->render('detail_product', ['product' => $proData, 'image' => $imageData,'productRand'=>$randomPro]);
    }

    public function showProduct(Request $request)
    {
        $reqGet = $request->getBody();
        
        if(!empty($reqGet['selectOption'])){
            $option = $reqGet['selectOption'];
            if($option=="pro_asc"){
                $data = $this->product->sortProductByPriceASC();
            }
            else if($option == "pro_desc"){
                $data = $this->product->sortProductByPriceDESC();
            }
        }
        //search bên trang product
        else if(!empty($reqGet['product_name'])){    
            $name= $reqGet['product_name'];
            $data =  $this->product->getProductByProductName($name);
           
        }
        
        //Lọc theo danh mục
        else if(!empty($reqGet['category_id'])){
            
            $id = $reqGet['category_id'];
            $data =  $this->product->getProductByCateID($id);
        }
        else{
            $data = $this->product->getProductByPage();
        }
        $categoris = $this->category->selectAll();
        $suppliers = $this->supplier->selectAll();
        $image = new ProductImage();
        foreach ($data as $value)
        {
            $dataImg = $image->getImageByProductId($value->product_id);
            if (isset($dataImg))
            {
                $value->images = $dataImg;
            }
        }
        return $this->render('product_page', ['data' => $data,'categoris'=>$categoris,'supplier'=>$suppliers]);
    }

    public function productAddAdmin(Request $request)
    {
        $categoris = $this->category->selectAll();
        $suppliers = $this->supplier->selectAll();
        if ($request->isPost())
        {
            $this->product->loadData($request->getBody());
            $files = $request->getFiles();
            $dir = __DIR_ROOT . '/public/images/uploads/';
            if ($this->product->validate() && $this->product->saveProduct($files['images'], $dir))
            {
                Application::$app->session->setFlash('success', 'Insert data product is successfuly!');
                Application::$app->response->redirect('/admin/product');
            } else
            {
                Application::$app->session->setFlash('error', 'Error insert data category!');
                $this->setLayout('admin');
                return $this->render('product/showAdd', ['model' => $this->product, 'categoris' => $categoris, 'suppliers' => $suppliers]);
            }
        }
       
        $this->setLayout('admin');
        return $this->render('product/showAdd', ['model' => $this->product, 'categoris' => $categoris, 'suppliers' => $suppliers]);
    }
    public function remove(Request $request)
    {
        $pro = new Product();
        if ($request->isGet())
        {
           $reqGet = $request->getBody();
            if ($pro->removeProById($reqGet['id']))
            {
                
                Application::$app->session->setFlash('success', 'drop data user successfuly!');
                Application::$app->response->redirect('/admin/product');
            }
            else
            {
                Application::$app->session->setFlash('error', 'Không thể xóa!');
                Application::$app->response->redirect('/admin/product');
            }
        }
    }

    public function productDetailAdmin(Request $request)
    {
        if ($request->isGet())
        {
            $reqGet = $request->getBody();
            $id = $reqGet['id'];
            $image = new ProductImage();
            $proData = $this->product->getProductById($id);
            $category = $this->category->getCategoryById($proData->category_id);
            $supplier = $this->supplier->getSupplierById($proData->supplier_id);
            $imageData = $image->getImageByProductId($id);
            $proData->category = $category;
            $proData->supplier = $supplier;
            $this->setLayout('admin');
            return $this->render('product/showDetail', ['product' => $proData, 'image' => $imageData]);
        }
    }

    public function productEditAdmin(Request $request)
    {
        $categoris = $this->category->selectAll();
        $suppliers = $this->supplier->selectAll();
        $reqGet = $request->getBody();
        $id = $reqGet['id'];
        $image = new ProductImage();
        $proData = $this->product->getProductById($id);
        $category = $this->category->getCategoryById($proData->category_id);
        $supplier = $this->supplier->getSupplierById($proData->supplier_id);
        $imageData = $image->getImageByProductId($id);
        $proData->images = $imageData;
        $proData->category = $category;
        $proData->supplier = $supplier;
        $this->setLayout('admin');
        return $this->render('product/showUpdate', ['model' =>$proData,'categoris' => $categoris, 'suppliers' => $suppliers]);
    }

    public function removeImg(Request $request)
    {
        $reqGet = $request->getBody();
        $pro_image = new ProductImage();
        $imgId = $reqGet['idImg'];
        $idPro = $reqGet['idPro'];
        $img =$pro_image->getImgById($imgId);

        $imgName = $img->image_path;
        if($pro_image->removeImg($imgId))
        {
            Application::$app->session->setFlash('success', 'Xóa thành công!');


            unlink(__DIR_ROOT."public/images/uploads/" . $imgName);

            Application::$app->response->redirect('/admin/product/edit?id='.$idPro);
            
        } else
        {
            Application::$app->session->setFlash('error', 'Xóa không thành công!');
            $this->setLayout('admin');
            Application::$app->response->redirect('/admin/product/edit?id='.$idPro);
        }

    }
    public function addImage(Request $request)
    {
        if($request->isPost() )
        {
            $reqPost = $request->getBody();
            $files = $request->getFiles();
            $dir = __DIR_ROOT . '/public/images/uploads/';
            $id = $reqPost['id'];
            $this->product->product_id = $id;
            $check = $this->product->addImages($files['images'],$dir);
            if($check)
            {
                Application::$app->session->setFlash('success', 'Thêm thành công!');
                Application::$app->response->redirect('/admin/product/edit?id='.$id);
            }
            else{
                Application::$app->session->setFlash('success', 'Thêm không thành công!');
                Application::$app->response->redirect('/admin/product/edit?id='.$id);
            }
        }
    }

    public function updateProduct(Request $request)
    {
        if($request->isPost() )
        {
            $this->product->loadData($request->getBody());
            $attribute =['product_name'=>$this->product->product_name, 
            'product_des'=>$this->product->product_des,
            'product_price'=>$this->product->product_price,
            'product_stock_quantity'=>$this->product->product_stock_quantity,
            'category_id'=>$this->product->category_id,
            'supplier_id'=>$this->product->supplier_id];
            $productId =$this->product->product_id;
            $where = ['product_id'=>$this->product->product_id];
            if($this->product->validate() && $this->product->updateProduct($attribute,$where))
            {
                Application::$app->session->setFlash('success', 'Thêm thành công!');
                Application::$app->response->redirect('/admin/product/edit?id='.$productId);
            }
            else{
                Application::$app->session->setFlash('success', 'Thêm không thành công!');
                Application::$app->response->redirect('/admin/product/edit?id='.$productId);
            }
        }
    }

    public function handleBuyNow(Request $request)
    {
        $reqGet = $request->getBody();
        if(!empty($reqGet['id']))
        {
            $proId = $reqGet['id'];
            $this->cart->addProduct($proId);
            Application::$app->session->setFlash('success','Thêm sản phẩm thành công');
            Application::$app->response->redirect('/checkout');
        }
        $currentUrl = $_SERVER['HTTP_REFERER'];
        Application::$app->session->setFlash('success','Thêm sản phẩm thành công');
        Application::$app->response->redirect($currentUrl);
    }


}
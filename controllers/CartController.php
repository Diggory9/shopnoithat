<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Respone;
use app\models\Cart;
use app\models\Login;
use app\models\Order;
use app\models\User;
use app\core\middlewares\AuthMiddleware;
use app\models\Users;

class CartController extends Controller
{
    public $cart;
    public $order;
    public function __construct()
    {
        $this->cart = new Cart($_SESSION['cart']);
        $this->order = new Order();
    }

    public function index(Request $request)
    {
        return $this->render('cart/showCart');
    }
    public function addCart(Request $request)
    {
        $reqGet = $request->getBody();
        $productId  = $reqGet['id']; 
        $this->cart->addProduct($productId);
        $currentUrl = $_SERVER['HTTP_REFERER'];
        Application::$app->session->setFlash('success','Thêm sản phẩm thành công');
        Application::$app->response->redirect($currentUrl);

    }
    public function remove(Request $request)
    {
        $reqGet = $request->getBody();
        $productId  = $reqGet['id']; 
        $this->cart->removeProduct($productId);
        $currentUrl = $_SERVER['HTTP_REFERER'];
       
        Application::$app->response->redirect($currentUrl);
    }
    public function update(Request $request)
    {
        $reqGet = $request->getBody();
        $productId  = $reqGet['id'];
        $quantity = $reqGet['quantity'];
        $this->cart->updateQuantity($productId, $quantity);
        $currentUrl = $_SERVER['HTTP_REFERER'];
        Application::$app->response->redirect($currentUrl);
    }
    public function checkout(Request $request)
    {
        if($request->isPost())
        {
            $this->order->loadData($request->getBody());
            $current_time = date("Y-m-d H:i:s"); // lấy thời gian hiện tại
            $this->order->order_date = $current_time;
            // kiểm tra phương thức thanh toán
            if($this->order->validate())
            {
                if($this->order->addOrderNew($_SESSION['cart']))
                {
                    Application::$app->response->redirect('/checkout-success');
                }else{
                    Application::$app->response->redirect('/checkout-error');
                }
               
            }else{
                return $this->render('cart/showCheckout', ['model' => $this->order]);
            }
        }
        // kiểm tra người dùng đăng nhập chưa
        if(Application::$app->isGuest())
        {
            Application::$app->response->redirect('/login');
        }

        
        return $this->render('cart/showCheckout',['model'=>$this->order]);
    }
    
    public function showSuccess(Request $request)
    {
        $reqGet = $request->getBody();
       
        return $this->render('cart/showSuccess');
    }
    public function showError(Request $request)
    {
        $reqGet = $request->getBody();
      
        return $this->render('cart/showError');
    }
}
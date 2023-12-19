<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Respone;
use app\models\Cart;
use app\models\Login;
use app\models\User;
use app\core\middlewares\AuthMiddleware;

class CartController extends Controller
{
    public $cart;

    public function __construct()
    {
        $this->cart = new Cart();
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
        // echo '<pre>';

        // var_dump($_SESSION['cart']);
        // echo '</pre>';
        // exit;
        $currentUrl = $_SERVER['HTTP_REFERER'];
       
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

  
}
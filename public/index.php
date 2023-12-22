<?php
use app\controllers\CartController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\CategoryController;
use app\controllers\OrderController;
use app\controllers\ProductController;
use app\controllers\ReportController;
use app\controllers\RoleController;
use app\controllers\SupplierController;
use app\controllers\UserController;
use app\controllers\UserOrderController;
use app\model\RegisterModel;
use app\models\Report;

require_once __DIR__.'/../vendor/autoload.php';
require_once '../configs/db.php';

$app = new Application(dirname(__DIR__));
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'handleContact']);

$app->router->get('/', [SiteController::class,'home']);
$app->router->get('/', [SiteController::class,'home']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->router->get('/logout',[AuthController::class,'logout']);
$app->router->get('/profile',[AuthController::class,'profile']);

//profile
$app->router->get('/profile',[UserController::class,'showProfile']);
$app->router->get('/profile/editProfile',[UserController::class,'editProfile']);
$app->router->post('/profile/editProfile',[UserController::class,'editProfile']);

//user_order
$app->router->get('/user_order',[UserOrderController::class,'getDataByUserId']);
$app->router->get('/user_order/detail',[UserOrderController::class, 'getDataDetailOrderByID']);

//product
$app->router->get('/detail-product',[ProductController::class,'showDetail']);
$app->router->get('/product',[ProductController::class,'showProduct']);


// cart
$app->router->get('/add-cart',[CartController::class,'addCart']);
$app->router->get('/show-cart',[CartController::class,'index']);
$app->router->get('/cart-remove',[CartController::class,'remove']);
$app->router->get('/cart-update',[CartController::class,'update']);
$app->router->get('/checkout',[CartController::class,'checkout']);
$app->router->post('/checkout',[CartController::class,'checkout']);
$app->router->get('/checkout-success',[CartController::class,'showSuccess']);
$app->router->get('/checkout-error',[CartController::class,'showError']);

$app->router->get('/admin',[AdminController::class,'home']);
// category
$app->router->get('/admin/category',[CategoryController::class,'index']);
$app->router->get('/admin/category/add',[CategoryController::class,'add']);
$app->router->post('/admin/category/add',[CategoryController::class,'add']);
$app->router->get('/admin/category/edit',[CategoryController::class,'edit']);
$app->router->post('/admin/category/edit',[CategoryController::class,'edit']);
$app->router->get('/admin/category/remove',[CategoryController::class,'remove']);

// supplier
$app->router->get('/admin/supplier',[SupplierController::class,'index']);
$app->router->get('/admin/supplier/add',[SupplierController::class,'add']);
$app->router->post('/admin/supplier/add',[SupplierController::class,'add']);

$app->router->get('/admin/supplier/edit',[SupplierController::class,'edit']);
$app->router->post('/admin/supplier/edit',[SupplierController::class,'edit']);
$app->router->get('/admin/supplier/remove',[SupplierController::class,'remove']);

// role
$app->router->get('/admin/role',[RoleController::class,'index']);
$app->router->get('/admin/role/add',[RoleController::class,'add']);
$app->router->post('/admin/role/add',[RoleController::class,'add']);
$app->router->get('/admin/role/edit',[RoleController::class,'edit']);
$app->router->post('/admin/role/edit',[RoleController::class,'edit']);
$app->router->get('/admin/role/remove',[RoleController::class,'remove']);

// product admin
$app->router->get('/admin/product',[ProductController::class,'productIndexAdmin']);
$app->router->get('/admin/product/add',[ProductController::class,'productAddAdmin']);
$app->router->post('/admin/product/add',[ProductController::class,'productAddAdmin']);
$app->router->get('/admin/product/detail',[ProductController::class,'productDetailAdmin']);
$app->router->get('/admin/product/edit',[ProductController::class,'productEditAdmin']);
$app->router->get('/admin/product/removeImg',[ProductController::class,'removeImg']);
$app->router->get('/admin/product/remove',[ProductController::class,'remove']);


//user
$app->router->get('/admin/user',[UserController::class,'index']);
$app->router->get('/admin/user/add',[UserController::class,'add']);
$app->router->post('/admin/user/add',[UserController::class,'add']);
$app->router->get('/admin/user/edit',[UserController::class,'edit']);
$app->router->post('/admin/user/edit',[UserController::class,'edit']);
$app->router->get('/admin/user/remove',[UserController::class,'remove']);



$app->router->post('/admin/product/addImg',[ProductController::class,'addImage']);
$app->router->post('/admin/product/update',[ProductController::class,'updateProduct']);

// order
$app->router->get('/admin/order',[OrderController::class, 'index']);
$app->router->get('/admin/order/detail',[OrderController::class, 'showDetail']);
$app->router->get('/admin/order/update-status',[OrderController::class,'updateStatus']);
$app->router->get('/admin/order/add',[OrderController::class,'adminAddOrder']);
$app->router->get('/admin/order/add-cart',[OrderController::class,'addCart']);
$app->router->get('/admin/order/cart-update',[OrderController::class,'update']);
$app->router->get('/admin/order/cart-remove',[OrderController::class,'remove']);
$app->router->post('/admin/order/add',[OrderController::class,'adminAddOrder']);
// report
$app->router->get('/admin/report-12-month',[AdminController::class,'showReport']);
$app->router->get('/admin/report-7-date-revenue',[AdminController::class,'show7DayRevenue']);
$app->router->get('/admin/report',[ReportController::class,'index']);



$app->run();
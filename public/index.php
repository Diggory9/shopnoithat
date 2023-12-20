<?php
use app\controllers\CartController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\CategoryController;
use app\controllers\ProductController;
use app\controllers\RoleController;
use app\controllers\SupplierController;
use app\controllers\UserController;
use app\model\RegisterModel;
require_once __DIR__.'/../vendor/autoload.php';
require_once '../configs/db.php';

$app = new Application(dirname(__DIR__));
$app->router->get('/contact',[SiteController::class,'contact']);
$app->router->post('/contact',[SiteController::class,'handleContact']);

$app->router->get('/', [SiteController::class,'home']);

$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

$app->router->get('/logout',[AuthController::class,'logout']);
$app->router->get('/profile',[AuthController::class,'profile']);

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


//user
$app->router->get('/admin/user',[UserController::class,'index']);
$app->router->get('/admin/user/add',[UserController::class,'add']);
$app->router->post('/admin/user/add',[UserController::class,'add']);
$app->router->get('/admin/user/edit',[UserController::class,'edit']);
$app->router->post('/admin/user/edit',[UserController::class,'edit']);

$app->router->post('/admin/product/addImg',[ProductController::class,'addImage']);
$app->router->post('/admin/product/update',[ProductController::class,'updateProduct']);


$app->run();
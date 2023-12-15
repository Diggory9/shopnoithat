<?php
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\ProductController;
use app\model\RegisterModel;
require_once __DIR__.'/../vendor/autoload.php';
require_once '../configs/db.php';

$app = new Application(dirname(__DIR__));
$app->router->get('/product','product');
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




$app->router->get('/admin',[AdminController::class,'home']);

$app->run();
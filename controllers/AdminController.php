<?php

namespace app\controllers;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\models\Order;
use app\models\Product;
use app\models\Report;

class AdminController extends Controller
{
    public $report;
    public $order;
    public $product;
    public function __construct()
    {
        $this->report = new Report();
        $this->order = new Order();
        $this->product = new Product();
        $this->registerMiddleware(new AdminMiddleware(['home']));
    }

    public function home(Request $request)
    {

        $countOrderNew = $this->order->getCountOrderNew();
        $countProduct = $this->product->getCountProductAlmostAll();// đếm số lượn sản phẩm gần hết trong kho
        $this->setLayout('admin');
        return $this->render('adminhome',['countOrderNew'=>$countOrderNew,'countProduct'=>$countProduct['product_count']]);
    }
    public function showReport(Request $request)
    {
        $data = $this->report->get12MonthRepor();
        $jsonString = json_encode($data);
        return $jsonString;
    }
    public function show7DayRevenue()
    {
        $data = $this->report->get7DayRevenue();
        $jsonString = json_encode($data);
        return $jsonString;
    }
}
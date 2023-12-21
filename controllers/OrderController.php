<?php 

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\DetailOrder;
use app\models\Order;
use app\models\Product; 

class OrderController extends Controller
{
    private $order;
    private $orderDetail;
    private $product;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderDetail = new DetailOrder();
        $this->product = new Product();
    }

    public function index(Request $request)
    {
        $data = $this->order->getAll();
      
        $this->setLayout('admin');
        return $this->render('order/showTable',['data'=>$data]);
        
    }
    public function showDetail(Request $request)
    {
        $reqGet = $request->getBody();
        $orderId = $reqGet['id'];
        $orderData = $this->order->getOrderById($orderId);
        $orderDetailData =$this->orderDetail->getDetailByOrderId($orderId);
        foreach($orderDetailData as $value)
        {
            $this->product = new Product();
            $pro = $this->product->getProductById($value->product_id);
            $value->product_name = $pro->product_name;
        }
        $this->setLayout('admin');
        return $this->render('order/showDetail',['order'=>$orderData,'detailOrder'=>$orderDetailData]);
    }
    public function updateStatus(Request $request)
    {
        $reqGet = $request->getBody();
        $idOrder = $reqGet['id'];
        $status = $reqGet['status'];
        $userId = $_SESSION['user'];
        // lấy order hiện tại
        $orderCurrent = $this->order->getOrderById($idOrder);
        if($status == 1)
        {
            // lưu lại người mà đã xác nhận
            $attributes = ['status'=>$status,'through_user_id'=>$userId];
            $where = ['order_id'=>$idOrder];
            if($this->order->updateOrder($attributes,$where))
            {
                 // gửi maill là đã xác nhận đơn hàng.
           
                Application::$app->session->setFlash('success', 'Đơn hàng đã được xác nhận');
                Application::$app->response->redirect('/admin/order/detail?id='.$idOrder);
            }

        }else
        {
           
            $attributes = ['status'=>$status];
            $where = ['order_id'=>$idOrder];
            if($this->order->updateOrder($attributes,$where))
            {
                Application::$app->session->setFlash('success', 'Đơn hàng đã được cập nhật');
                Application::$app->response->redirect('/admin/order/detail?id='.$idOrder);
            }
        }
    }
    public function adminAddOrder(Request $request)
    {
        $this->setLayout('admin');
        $reqGet = $request->getBody();
        if(!empty($reqGet['product_id']))
        {
            $productId =$reqGet['product_id'];
            $productData = $this->product->getProductById($productId);
            return $this->render('order/showAdd',['model'=>$this->order,'product'=>$productData,'id'=>$productId]);
        }
        return $this->render('order/showAdd',['model'=>$this->order]);
    }
    
}




?>
<?php 

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
use app\core\Request;
use app\models\Cart;
use app\models\DetailOrder;
use app\models\Order;
use app\models\Product; 

class OrderController extends Controller
{
    private $order;
    private $orderDetail;
    private $product;
    private $cart;
    public function __construct()
    {
        $this->order = new Order();
        $this->orderDetail = new DetailOrder();
        $this->product = new Product();
        $this->cart = new Cart($_SESSION['cartAdmin']);
        $this->registerMiddleware(new AdminMiddleware(['productIndexAdmin','productAddAdmin','productDetailAdmin']));

    }

    public function index(Request $request)
    {
        $reqGet = $request->getBody();
        if(!empty($reqGet['selectOption'])){
            $option = $reqGet['selectOption'];
            //var_dump($option);
            //exit;
            if($option == "new_order"){
                $data=$this->order->getAllOrderNew();
                //var_dump($data);
                $dataAll = $data;
                if(!empty($dataAll)){
                    $this->setLayout('admin');
                    return $this->render('order/showTable',['data'=>$dataAll]);
                }
            }
        }

       else if(!empty($reqGet['order_id'])){
            $orID = $reqGet['order_id'];
            $data = $this->order->getOrderById($orID);
            $dataAll[]= $data;
            if(!empty($dataAll)){
                $this->setLayout('admin');
                return $this->render('order/showTable',['data'=>$dataAll]);
            }
        }
        $dataAll = $this->order->getAll();
      
        $this->setLayout('admin');
        return $this->render('order/showTable',['data'=>$dataAll]);
        
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
            Application::$app->db->getConnection()->beginTransaction();
            // lấy sản phẩm hiên tại để trừ số lượng
            $detail = $this->orderDetail->getDataByOrderID($idOrder);
            foreach($detail as $value)
            {
                // lấy sản phẩm
                $pro = $this->product->getProductById($value->product_id);
                $this->product->updateProduct(['product_stock_quantity'=>$pro->product_stock_quantity -$value->quantity ], ['product_id'=>$value->product_id]);
            }
            // lưu lại người mà đã xác nhận
            
            $attributes = ['status'=>$status,'through_user_id'=>$userId];
            $where = ['order_id'=>$idOrder];
            if($this->order->updateOrder($attributes,$where))
            {
                 // gửi maill là đã xác nhận đơn hàng.
           
                Application::$app->session->setFlash('success', 'Đơn hàng đã được xác nhận');
                Application::$app->db->getConnection()->commit();
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
        if($request->isPost())
        {
           
            $reqPost = $request->getBody();
            $this->order->loadData($reqPost);
            $current_time = date("Y-m-d H:i:s"); // lấy thời gian hiện tại
            $this->order->order_date = $current_time;
            if($this->order->validate())
            {
             
                if($this->order->addOrderNew($_SESSION['cartAdmin']))
                {
                    Application::$app->session->setFlash('success', 'Đơn hàng đã thêm thành công');
                    Application::$app->response->redirect('/admin/order');
                }else{
                 
                    return $this->render('order/showAdd',['model'=>$this->order]);
                }
              
            }else{

               
                $this->setLayout('admin');
                Application::$app->session->setFlash('error', 'Thêm không thành công');
                return $this->render('order/showAdd',['model'=>$this->order]);
            }
        }
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
    public function addCart(Request $request)
    {
        $reqGet = $request->getBody();
        $productId  = $reqGet['id']; 
        $this->cart->addProduct($productId);
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
    public function remove(Request $request)
    {
        $reqGet = $request->getBody();
        $productId  = $reqGet['id']; 
        $this->cart->removeProduct($productId);
        $currentUrl = $_SERVER['HTTP_REFERER'];
       
        Application::$app->response->redirect($currentUrl);
    }
}




?>
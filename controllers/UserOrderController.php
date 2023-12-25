<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\DetailOrder;
use app\models\Order;
use app\models\Product;

class UserOrderController extends Controller
{
    private $order;
    private $detailoder;
    private $product;
    public function __construct()
    {
        $this->order = new Order();
        $this->detailoder = new DetailOrder();
        $this->product = new Product();
    }
    public function getDataByUserId()
    {
        $order = new Order();
        $id = $_SESSION['user'];
        $data = $order->getDataByUserId($id);
        echo '<pre>';
        //var_dump($data);
        echo '</pre>';
        return $this->render('user_order', ['model' => $data]);
    }
    public function getDataDetailOrderByID(Request $request)
    {
        $reqGet = $request->getBody();
        $orderId = $reqGet['order_id'];
        $orderData = $this->order->getOrderById($orderId);
        $orderDetailData = $this->detailoder->getDetailByOrderId($orderId);
        foreach ($orderDetailData as $value)
        {
            $this->product = new Product();
            $pro = $this->product->getProductById($value->product_id);
            $value->product_name = $pro->product_name;
        }
        return $this->render('showdetailorder', ['order' => $orderData, 'detailOrder' => $orderDetailData]);
    }

    public function handleCancelOrder(Request $request)
    {
        $reqGet = $request->getBody();

        if (!empty($reqGet['productid']) && !empty($reqGet['status']))
        {
            $status = $reqGet['status'];
            $orderId = $reqGet['productid'];
            $orderData = $this->order->getOrderById($orderId);
            $currentStatus = $orderData->status;
            if ($currentStatus == 0)
            {

                $attributes = ['status' => $status];
                $where = ['order_id' => $orderId];
                if ($this->order->updateOrder($attributes, $where))
                {
                    Application::$app->session->setFlash('success', 'Đơn hàng đã được cập nhật');
                    Application::$app->response->redirect('detail?order_id=' . $orderId);
                }
            } else if ($currentStatus == 4)
            {
                
                Application::$app->session->setFlash('error', 'Đơn hàng không cập nhật vì đã được giao hàng');
                Application::$app->response->redirect('detail?order_id=' . $orderId);
            } 
            else if ($currentStatus == 5)
            {
                
                //Application::$app->session->setFlash('error', 'Đơn hàng không cập nhật vì đã được giao hàng');
                Application::$app->response->redirect('detail?order_id=' . $orderId);
            } 
            else
            {
                $detail = $this->detailoder->getDataByOrderID($orderId);
                foreach($detail as $value)
                {
                    // lấy sản phẩm
                    $pro = $this->product->getProductById($value->product_id);
                    $this->product->updateProduct(['product_stock_quantity'=> $pro->product_stock_quantity + $value->quantity ], ['product_id'=>$value->product_id]);
                }
                // lưu lại người mà đã xác nhận
                $attributes = ['status'=>$status];
                $where = ['order_id'=>$orderId];
                if($this->order->updateOrder($attributes,$where))
                {
                     // gửi maill là đã xác nhận đơn hàng.
               
                    Application::$app->session->setFlash('success', 'Đơn hàng đã được xác nhận');
                    Application::$app->db->getConnection()->commit();
                    Application::$app->response->redirect('detail?order_id=' . $orderId);
                }
                else{
                    Application::$app->session->setFlash('error', 'Đơn hàng không cập nhật thành công. Nếu có vấn đề xin liên hệ 0346875565.');
                    Application::$app->response->redirect('detail?order_id=' . $orderId);
                }
            }
        }

    }
}
?>
<?php
    namespace app\controllers;
    use app\core\Application;
    use app\core\Controller;
    use app\core\Request;
    use app\models\DetailOrder;
    use app\models\Order;

    class UserOrderController extends Controller
    {
        private $order;
        private $detailoder;
        public function __construct()
        {
            $this->order = new Order(); 
            $this->detailoder = new DetailOrder();
            
        }
        public function getDataByUserId(){
            $order = new Order();
            $id  = $_SESSION['user'];
            $data = $order ->getDataByUserId($id);
            echo '<pre>';
            //var_dump($data);
            echo '</pre>';
            return $this->render('user_order',['model'=>$data]);
        }
        public function getDataDetailOrderByID(Request $request){
            $reqGet = $request->getBody();
            $orderId = $reqGet['order_id'];
            $data = $this->detailoder->getDetailByOrderId($orderId);
            echo '<pre>';
            //var_dump($data);
            echo '</pre>';
            return $this->render('showdetailorder',['model'=>$data]);
        }
    }
?>
<?php
    namespace app\models;
    use Exception;
    use app\core\Application;
    use app\core\DbModel;
    class DetailOrder extends DbModel
    {
        public $product_id;
        public $order_id;
        public $quantity;
        public $price;
        public $product_name;

        public function rules()
        {
            return [
                'consignee_name' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 4]],
                'consignee_phone' => [self::RULE_REQUIRED, self::RULE_PHONE],
                'consignee_add' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
            ];
        }
    
        public function tableName(): string
        {
            return "detail_order";
        }
        public function attribute(): array
        {
            return [];
        }
        public function primaryKey(): string
        {
            return 'order_id';
        }

        public function insertDetail()
        {
            return self::save(['product_id', 'order_id','quantity','price']);
        }
        public function getDetailByOrderId($id)
        {
            return self::find(['order_id'=>$id]);
        }

        public function getDataByOrderID($id){
            try{
                $sql = "SELECT * FROM `detail_order` WHERE `order_id` = $id; ";
                $stm = self::prepare($sql);
                $stm->execute();
                $data = $stm -> fetchAll(\PDO::FETCH_CLASS,static::class);
                return $data;
            }catch (Exception $e)
            {
                Application::$app->session->setFlash('error', 'Error !');
            }
        }

    }





?>
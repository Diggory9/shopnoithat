<?php

    namespace app\models;
    use app\core\DbModel;
    class DetailOrder extends DbModel
    {
        public $product_id;
        public $order_id;
        public $quantity;
        public $price;

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
    
    }





?>
<?php
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use Exception;
use PDO;

class Order extends DbModel
{
    public const ORDER_NEW       = 0; //đơn hàng mới
    public const ORDER_CONF      = 1; // chờ xác nhận
    public const ORDER_WSM       = 2; // chờ xuất hàng
    public const ORDER_WFD       = 3; // chờ giao hàng
    public const ORDER_DELIVERED = 4; // đã giao hàng
    public const ORDER_CANCEL    = 5; // hủy
    public $order_id;
    public $order_date;
    public $total_amount;
    public $consignee_name;

    public $consignee_phone;

    public $consignee_add;
    public $status;
    public $user_id;

    public $through_user_id;


    public function rules()
    {
        return [
            'consignee_name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
            'consignee_phone' => [self::RULE_REQUIRED, self::RULE_PHONE],
            'consignee_add' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
        ];
    }

    public function tableName(): string
    {
        return "user_order";
    }
    public function attribute(): array
    {
        return [];
    }
    public function primaryKey(): string
    {
        return 'order_id';
    }

    public function addOrderNew(&$session)
    {
        try
        {

            Application::$app->db->getConnection()->beginTransaction();
            $table = $this->tableName();
            $attributes = ['order_date', 'total_amount', 'consignee_name', 'consignee_phone', 'consignee_add', 'user_id'];
            $params = array_map(fn($attr) => ":$attr", $attributes);

            $stmt = self::prepare("INSERT INTO $table(" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");
            foreach ($attributes as $attribute)
            {
                $stmt->bindValue(":$attribute", $this->{$attribute});
            }
            $stmt->execute();
            $lastInsertedId = Application::$app->db->getConnection()->lastInsertId();
            $this->order_id = $lastInsertedId;
            $items = &$session;
            foreach ($items as $key => $value)
            {

                $product = new Product();
                $product = $product->getProductById($key);
                if($product->product_stock_quantity < $value['sl'])
                {
                    Application::$app->session->setFlash('success', 'Đơn hàng đã thêm thành công');
                    Application::$app->db->getConnection()->rollBack();
                    return false;
                }
                $detail = new DetailOrder();
                $detail->order_id = $this->order_id;
                $detail->product_id = $key;
                $detail->quantity = $value['sl'];
                $detail->price = $value['product_price'];
              
                if (!$detail->insertDetail())
                {
                    return false;
                }
                unset($items[$key]);
            }
            Application::$app->db->getConnection()->commit();
            return true;
        } catch (Exception $e)
        {
            Application::$app->db->getConnection()->rollBack();
            return false;
        }


    }
    public function getOrderNew()
    {   
        return self::find(['status'=>0]);
    }
    public function getCountOrderNew()
    {
        $sql = "SELECT COUNT(*) AS count_status_0
        FROM user_order
        WHERE status = 0;";
        $stmt = Application::$app->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getAll()
    {
        try
        {
            $sql = "SELECT * FROM `user_order` 
            ORDER BY order_date DESC";
            $stm = $this->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_CLASS, static::class);
            return $result;
        } catch (Exception $e)
        {
            return null;
        }
    }
    public function getOrderById($id)
    {
        return self::findOne(['order_id'=>$id]);
    }
    public function updateOrder($attributes, $where)
    {
        return self::update($attributes,$where);
    }
}
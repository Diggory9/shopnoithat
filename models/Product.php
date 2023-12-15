<?php
namespace app\models;

use app\core\DbModel;
use app\core\exceptions\SqlException;
use app\core\Model;
use Exception;

class Product extends DbModel
{
    public int $product_id;
    public string $product_name;
    public string $product_des;
    public $product_price;
    public int $product_stock_quantity;
    public int $category_id;
    public int $supplier_id;
    public $images = array();
    public function rules()
    {
        return [
            'product_name' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => $this::class]],
            'product_des' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
            'product_price' => [self::RULE_REQUIRED],
            'category_id' => [self::RULE_REQUIRED]
        ];
    }


    public function tableName(): string
    {
        return "product";
    }
    public function attribute(): array
    {
        return [];
    }
    public function primaryKey(): string
    {
        return 'product_id';
    }
    public function getProductById($id)
    {
        $data = self::findOne(['product_id' => $id]);
        return $data;
    }
    public function getProductByPage($sizepage = 12, $page = 1, $category_id = 1)
    {
        try
        {
            $offset = ($page - 1) * $sizepage;
            $sql = 'SELECT *
            FROM product
            WHERE category_id = :cate
            LIMIT '.$sizepage.' OFFSET '.$offset;
            $stm = $this->prepare($sql);
            
            $stm->bindValue(":cate", $category_id);
            //$stm->bindValue(":size", $sizepage);
            $stm->execute();
            $data = $stm->fetchAll(\PDO::FETCH_CLASS, static::class);
            $img = new ProductImage();
            return $data;
        }
        catch(Exception $e)
        {
            throw new SqlException();
        }

    }
}
?>
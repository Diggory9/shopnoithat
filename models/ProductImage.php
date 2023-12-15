<?php
namespace app\models;
use app\core\DbModel;

class ProductImage extends DbModel
{
    public $image_id;
    public $product_id;
    public $image_path;
    protected $tableName = 'image_product';
    public function getImageByProductId($id){
        $data = self::find(['product_id'=>$id]);

        return $data;
    }
    public function tableName(): string
    {
        return "product_image";
    }
    public function attribute():array
    {
        return ['user_firstname', 'user_lastname', 'user_email','user_password'];
    }
    public function primaryKey(): string
    {
        return 'image_id';
    }
    public function rules()
    {
        return [
        ];
    }
}


?>
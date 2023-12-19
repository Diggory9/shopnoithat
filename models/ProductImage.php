<?php
namespace app\models;
use app\core\DbModel;

class ProductImage extends DbModel
{
    public $image_id;
    public $product_id;
    public $image_path;
    protected $tableName = 'product_image';
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
        return ['product_id','image_path'];
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

    public function saveImageProduct()
    {
        return self::save($this->attribute());
    }
    public function removeImg($id)
    {
        return self::remove(['image_id'=>$id]);
    }
    public function getImgById($id)
    {
        return self::findOne(['image_id'=> $id]);
    }
}


?>
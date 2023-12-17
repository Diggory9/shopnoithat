<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use Exception;

class Category extends DbModel
{
    protected $table = 'category';
    public int $category_id;
    public string $category_name;
    public string $category_description;
    public function rules()
    {
        return [
            'category_name' => [self::RULE_REQUIRED],
            'category_description' => [self::RULE_REQUIRED,],

        ];
    }


    public function tableName(): string
    {
        return $this->table;
    }
    public function attribute(): array
    {
        return ['category_id', 'category_name','category_description'];
    }
    public function primaryKey(): string
    {
        return 'category_id';
    }
    public function insertData()
    {   
        $data = self::findOne(['category_name'=>$this->category_name]);
        if(!empty( $data))
        {
            $this->addErrors('email','Tên danh mục đã tồn tại trong hệ thống');
            return false;
        }
        return self::save(['category_name','category_description']);
    }
    public function updateCategory()
    {
        return self::update(['category_name'=>$this->category_name,'category_description'=>$this->category_description], ['category_id'=>$this->category_id]);
    }
    public function removeCategory()
    {
        return self::remove(['category_id'=>$this->category_id]);
    }
    public function selectAll()
    {
        try{

            
            $sql = "select * from category";
            $stm = self::prepare($sql);
            $stm->execute();
            $data = $stm -> fetchAll(\PDO::FETCH_CLASS,static::class);
            return $data;
        }catch (Exception $e)
        {
            Application::$app->session->setFlash('error', 'Error insert data category!');
        }
      
    }


}


?>
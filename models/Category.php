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
            'category_name' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => $this->table]],
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
        return self::save(['category_name','category_description']);
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
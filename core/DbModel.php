<?php
namespace app\core;

use Exception;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attribute(): array;

    abstract public function primaryKey(): string;
    public function save(array $attribute)
    {
        $table = $this->tableName();
        $attributes = $attribute;
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $stmt = self::prepare("INSERT INTO $table(" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");
        foreach ($attributes as $attribute)
        {
            $stmt->bindValue(":$attribute", $this->{$attribute});
        }
        $stmt->execute();
        return true;

    }

    public function update(array $attribute, array $where)
    {
        try
        {
            $tableName = static::tableName();
            $wheres = array_keys($where);// get key;
            $whereSql = implode('and', array_map(fn($attr)=> "$attr = :$attr",$wheres)); 
            $attributes = array_keys($attribute);
            $params = implode(',', array_map(fn($attr)=> "$attr = :$attr",$attributes));
            $sql = "update $tableName set $params WHERE $whereSql";

            $stmt = self::prepare($sql);
            foreach($where as $key => $value)
            {
                $stmt->bindValue(":$key", $value);
            }
            foreach($attribute as $key => $value)
            {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return true;
        }catch(Exception $e)
        {
            return false;
        }
        
    }

    public function remove(array $where)
    {
        try
        {
            $tableName = static::tableName();
            $wheres = array_keys($where);// get key;
            $whereSql = implode('and', array_map(fn($attr)=> "$attr = :$attr",$wheres)); 
            $sql = "DELETE FROM $tableName WHERE $whereSql";
            
            $stmt = self::prepare($sql);
            foreach($where as $key => $value)
            {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return true;
        }catch(Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    public static function prepare($sql)
    {
        return Application::$app->db->getConnection()->prepare($sql);
    }
    public function find($where)
    {
        $tableName = static::tableName();
        $attribute = array_keys($where);// get key;
        $whereSql = implode('and', array_map(fn($attr)=> "$attr = :$attr",$attribute)); 
        $sql = "SELECT * FROM $tableName WHERE $whereSql";
        $stmt = self::prepare($sql);
        foreach($where as $key => $value)
        {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        $data =  $stmt->fetchAll(\PDO::FETCH_CLASS,static::class);
        return $data;
    }

    public function findOne($where)// ['email' => e@email.com, 'name'=> 'ndv']
    {
        // get table
        $tableName = static::tableName();
        $attribute = array_keys($where);// get key;
        $whereSql = implode('and', array_map(fn($attr)=> "$attr = :$attr",$attribute)); 
        $sql = "SELECT * FROM $tableName WHERE $whereSql";
        
        $stmt = self::prepare($sql);
        foreach($where as $key => $value)
        {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        $data =  $stmt->fetchObject(static::class);
        return $data;// vd new User(// data //);
    }
}
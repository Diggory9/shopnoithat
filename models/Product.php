<?php
namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\exceptions\SqlException;
use app\core\Model;
use Exception;
use PDO;

class Product extends DbModel
{
    public $product_id;
    public $product_name;
    public $product_des;
    public $product_price;
    public $product_stock_quantity;
    public $category_id;
    public $supplier_id;
    public $images = array();
    public $category;
    public $supplier;
    public function rules()
    {
        return [
            'product_name' => [self::RULE_REQUIRED],
            'product_des' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]],
            'product_price' => [self::RULE_REQUIRED],
            'category_id' => [self::RULE_REQUIRED],
            'product_stock_quantity' => [self::RULE_REQUIRED],
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
    public function getProductByCateID($id){
        $data = self::find(['category_id'=>$id]);
        return $data;
    }
    public function getProductByProductName($name){
        try{
            $sql = " SELECT * FROM `product` WHERE `product_name` like '%$name%'";
            $stm = self::prepare($sql);
            $stm->execute();
            $data = $stm -> fetchAll(PDO::FETCH_CLASS,static::class);
            return $data;
        }catch (Exception $e)
        {
            Application::$app->session->setFlash('error', 'Error!');
        }
    }

    public function getProductByPage()
    {
        try
        {
         
            $sql = 'SELECT *
            FROM product';
          
            $stm = $this->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_CLASS, static::class);
            $img = new ProductImage();
            return $data;
        } catch (Exception $e)
        {
            throw new SqlException();
        }

    }
    public function saveProduct($file, $uploadDirectory)
    {
        try
        {
            $check = true;
            $d = self::findOne(['product_name' => $this->product_name]);
            if (!empty($d))
            {
                $this->addErrors(self::RULE_UNIQUE, "Tên sản phẩm bị trùng");
                return false;
            }
            Application::$app->db->getConnection()->beginTransaction();
            $table = $this->tableName();
            $attributes = ['product_name', 'product_des', 'product_price', 'product_stock_quantity', 'category_id', 'supplier_id'];
            $params = array_map(fn($attr) => ":$attr", $attributes);

            $stmt = self::prepare("INSERT INTO $table(" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");
            foreach ($attributes as $attribute)
            {
                $stmt->bindValue(":$attribute", $this->{$attribute});
            }
            $stmt->execute();
            $lastInsertedId = Application::$app->db->getConnection()->lastInsertId();
            $this->product_id = $lastInsertedId;
            $check = $this->addImages($file, $uploadDirectory);
            Application::$app->db->getConnection()->commit();
            return $check;
        } catch (Exception $e)
        {
            Application::$app->db->getConnection()->rollBack();
            return false;
        }

    }
    public function addImages($file, $uploadDirectory)
    {
        if (!empty($file['name'][0]))
        {
            foreach ($file['name'] as $key => $value)
            {
                $fileName = $file['name'][$key];
                $fileTmpName = $file['tmp_name'][$key];
                $fileType = $file['type'][$key];
                $fileSize = $file['size'][$key];
                $fileError = $file['error'][$key];

                if ($fileError === 0)
                {
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $hashedFileName = md5_file($fileTmpName) . "." . $fileExtension;
                    $destination = $uploadDirectory . $hashedFileName;

                    move_uploaded_file($fileTmpName, $destination);

                    $this->images[] = $hashedFileName;
                    $proImg = new ProductImage();
                    $proImg->product_id = $this->product_id;
                    $proImg->image_path = $hashedFileName;
                    $proImg->saveImageProduct();
                } else
                {
                    echo "Có lỗi xảy ra khi upload file $fileName. Mã lỗi: $fileError<br>";
                    return false;
                }
            }
        } else
        {
            $this->addErrors(self::RULE_REQUIRED, "Vui lòng chọn ít nhất một file để upload.");
            return false;
        }
        return true;
    }

    public function updateProduct(array $attribute, array $where)
    {
        return self::update($attribute, $where);
    }

    public function removeProById($id)
    {   
        // xóa hình ảnh
        try{
            $img = new ProductImage();
            $img->removeImageByProductId($id);
            return self::remove(['product_id' => $id]);
        }catch(Exception $e)
        {
            return false;
        }
    }
    public function showProductByCategory($categoryId, $sizepage = 12, $page = 1)
    {
        try
        {
            $offset = ($page - 1) * $sizepage;
            $sql = 'SELECT *
            FROM product
            LIMIT ' . $sizepage . ' OFFSET ' . $offset;
            $stm = $this->prepare($sql);

            $stm->bindValue(":cate", $categoryId);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_CLASS, static::class);
            $img = new ProductImage();
            return $data;
        } catch (Exception $e)
        {
            throw new SqlException();
        }
    }

    // đếm số lượng gần hết trong kho
    public function getCountProductAlmostAll()
    {
        try
        {
            $sql = "SELECT COUNT(*) AS product_count
            FROM product
            WHERE product_stock_quantity < 5;";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e)
        {
            return 0;
        }

    }
    public function getProductAlmostAll()
    {
        // lấy những sản phẩm có số lượng nhỏ hơn 2
        try{

            $sql ="SELECT *
            FROM product
            WHERE product_stock_quantity < 5;";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_CLASS,static::class);

        }catch(Exception $e)
        {
            return null;
        }
    }
    public function sortProductByPriceASC()
    {
        // Sắp xếp sản phẩm có giá từ thấp tới cao
        try{

            $sql ="SELECT * FROM `product` ORDER BY `product`.`product_price` ASC";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_CLASS,static::class);

        }catch(Exception $e)
        {
            return null;
        }
    }
    public function sortProductByPriceDESC()
    {
         // Sắp xếp sản phẩm có giá từ cao tới thấp
        try{

            $sql ="SELECT * FROM `product` ORDER BY `product`.`product_price` DESC";
            $stmt = Application::$app->db->getConnection()->prepare($sql);
            $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_CLASS,static::class);

        }catch(Exception $e)
        {
            return null;
        }
    }
    // lấy ramdom sản phẩm

    public function getProductRand($number)
    {
        try{
            $sql = "SELECT *
            FROM product
            ORDER BY RAND()
            LIMIT 4;";
    
            $stmt = $this->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS,static::class);

        }catch (Exception $e) {
            # code...
            return null;
        }
      
    }

}
?>
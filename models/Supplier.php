<?php
    namespace app\models;

use app\core\Application;
use app\core\DbModel;
use Exception;

    class Supplier extends DbModel
    {
        
        protected $table ="supplier";
        public int $supplier_id;
        public string $supplier_name;
        public string $contact_email;
        public string $supplier_phone;
        public string $supplier_address;


        public function rules()
        {
            return [
                'supplier_name' => [self::RULE_REQUIRED],
                'contact_email' => [self::RULE_REQUIRED,self::RULE_EMAIL],    
                'supplier_phone'=>[self::RULE_REQUIRED, self::RULE_PHONE],
                'supplier_address'=>[self::RULE_REQUIRED]
            ];
        }
    
    
        public function tableName(): string
        {
            return $this->table;
        }
        public function attribute(): array
        {
            return [];
        }
        public function primaryKey(): string
        {
            return 'supplier_id';
        }

        public function selectAll()
        {
            try{

            
                $sql = "select * from supplier";
                $stm = self::prepare($sql);
                $stm->execute();
                $data = $stm -> fetchAll(\PDO::FETCH_CLASS,static::class);
                return $data;
            }catch (Exception $e)
            {
                Application::$app->session->setFlash('error', 'Error insert data category!');
            }
        }
        public function insertData()
        {
            $data = self::findOne(['contact_email'=>$this->contact_email]);
            if(!empty( $data))
            {
                $this->addErrors('email','Tên email đã tồn tại trong hệ thống');
                return false;
            }
            return self::save(['supplier_name','contact_email','supplier_phone','supplier_address']);
        }
        public function upateSupplier($attribute, $where)
        {
            return self::update($attribute, $where);
        }

        public function removeSupplierById($id)
        {
            return self::remove(['supplier_id'=>$id]);
        }
        public function getSupplierById($id)
        {
            if(empty($id))
                return null;
            return self::findOne(['supplier_id'=>$id]);
        }
    }

   
?>
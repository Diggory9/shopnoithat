<?php
    namespace app\models;
    use app\core\Application;
    use app\core\DbModel;
    use Exception;
    class Role extends DbModel
    {
        protected $table = 'role';
        public int $role_id;
        public string $role_name;
        public function rules()
        {
            return [
                'role_name'=> [self::RULE_REQUIRED],
            ];
        }
        public function tableName(): string
        {
            return $this->table;
        }
        public function attribute(): array
        {
            return ['role_id', 'role_name'];
        }
        public function primaryKey(): string
        {
            return 'role_id';
        }
        public function insertRole()
        {
            $data = self::findOne(['role_name'=>$this->role_name]);
            if(!empty($data))
            {
                $this->addErrors('email','Tên role đã tồn tại');
                return false;
            }
            return self::save(['role_name']);
        }
        public function updateRole()
        {
            return self::update(['role_name'=>$this->role_name],['role_id'=>$this->role_id]);
        }
        public function removeRole()
        {
            return self::remove(['role_id'=>$this->role_id]);
        }
        public function selectAll()
        {
            try{
                $sql = "select * from role";
                $stm = self::prepare($sql);
                $stm->execute();
                $data = $stm -> fetchAll(\PDO::FETCH_CLASS,static::class);
                return $data;
            }catch (Exception $e)
            {
                Application::$app->session->setFlash('error', 'Error insert data role!');
            }
        
        }
    }
?>
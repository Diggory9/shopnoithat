<?php
    namespace app\controllers;

    use app\core\Controller;
    use app\core\Request;
    use app\models\Role;

    use app\core\Application;
    use app\core\Respone;

    class RoleController extends Controller
    {
        public function index(Request $request)
        {
            $role = new Role();
            $dataAll = $role->selectAll();

            $this->setLayout('admin');
            return $this ->render('role/showTable',['roles'=>$dataAll]);
        }
        public function add(Request $request)
        {
            $role = new Role();

            if($request -> isPost())
            {
                $role -> loadData($request -> getBody());
                if($role->validate()&& $role-> insertRole())
                {
                    Application::$app->session->setFlash('succes','Insert data role succesfully!');
                    Application::$app->response->redirect('/admin/role');
                }
                else
                {
                    Application::$app-> session ->setFlash('error','Error insert data role !');
                    $this->setLayout('admin');
                    return $this ->render('role/showAdd',['model'=>$role]);
                }
            }
            $this ->setLayout('admin');
            return $this ->render('role/showAdd',['model'=>$role]);
        }
        public function edit(Request $request,Respone $respone)
        {
            $role = new Role();

            if($request -> isPost())
            {
                $role -> loadData($request -> getBody());
                if($role->validate()&& $role-> updateRole())
                {
                    Application::$app->session->setFlash('succes','Update data role succesfully!');
                    Application::$app->response->redirect('/admin/role');
                }
                else
                {
                    Application::$app-> session ->setFlash('error','Error insert data role !');
                    $this->setLayout('admin');
                    return $this ->render('role/showEdit',['model'=>$role]);
                }
            }
            $requestGet = $request->getBody();
            $dataOne = $role->findOne(['role_id'=>$requestGet['id']]);
            $this ->setLayout('admin');
            return $this ->render('role/showEdit',['model'=>$dataOne]);
        }
        public function remove(Request $request)
        {
            $role = new Role();
            if ($request->isGet())
            {
            $requestGet = $request->getBody();
            $role->role_id = $requestGet['id'];
            
                if ($role->removeRole())
                {
                    
                    Application::$app->session->setFlash('success', 'drop data role successfuly!');
                    Application::$app->response->redirect('/admin/role');
                }
                else
                {
                    Application::$app->session->setFlash('error', 'Không thể xóa role này ');
                    Application::$app->response->redirect('/admin/role');
                }
            }
        }
    }
?>
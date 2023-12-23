<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\Users;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = new Users();
        $reqGet = $request->getBody();
        if (!empty($reqGet['user_id']))
        {
            $userID = $reqGet['user_id'];
            $data = $user->getUserById($userID);
            $dataAll[] = $data;
            if (!empty($dataAll))
            {
                $this->setLayout('admin');
                return $this->render('user/showTable', ['users' => $dataAll]);
            }
        }
        $dataAll = $user->selectAll();
        $this->setLayout('admin');
        return $this->render('user/showTable', ['users' => $dataAll]);

    }
    public function showProfile(Request $request)
    {
        $u = new User();
        $id = $_SESSION['user'];
        $user = $u->findOne(['user_id' => $id]);
        echo '<pre>';
        //var_dump($user);
        echo '</pre>';
        return $this->render('profile/showProfile', ['model' => $user]);

    }
    public function editProfile(Request $request)
    {
        $user = new Users();
        if ($request->isPost())
        {
            $user->loadData($request->getBody());
            // kiểm tra mk không đổi
            $userCheck = $user->findOne(['user_id' => $user->user_id]);
            if ($userCheck->user_password !== $user->user_password)
            {
                $user->user_password = md5($user->user_password);
            }
            $attribute = [
                'user_firstname' => $user->user_firstname, 'user_lastname' => $user->user_lastname,
                'user_phone' => $user->user_phone, 'user_address' => $user->user_address,
                'user_password' => $user->user_password];

            $user->user_email = ' ';
            $where = ['user_id' => $user->user_id];
            if ($user->validate() && $user->upateUser($attribute, $where))
            {
                Application::$app->session->setFlash('success', 'Edit data user successfuly!');
                Application::$app->response->redirect('/profile');
            } else
            {
                Application::$app->session->setFlash('error', 'Error edit data user!');
                // $this->setLayout('profile');
                return $this->render('/profile/editProfile', ['model' => $user]);
            }
        }
        // lấy dữ liệu từ request
        $id = $_SESSION['user'];
        $user = $user->findOne(['user_id' => $id]);
        return $this->render('profile/editProfile', ['model' => $user]);

    }
    public function add(Request $request)
    {
        $user = new Users();
        if ($request->isPost())
        {
            $user->loadData($request->getBody());
            $user->user_password = trim($user->user_password);
            if (empty($user->user_password) || $user->user_password == null || $user->user_password = "")
            {
                $user->addErrors('unique', 'Mật khẩu chưa được nhập');
            }
            if ($user->validate() && $user->insertData())
            {
                Application::$app->session->setFlash('success', 'Insert data user successfuly!');
                Application::$app->response->redirect('/admin/user');
            } else
            {
                Application::$app->session->setFlash('error', 'Error insert data user!');
                $this->setLayout('admin');
                return $this->render('user/showAdd', ['model' => $user]);
            }
        }
        $this->setLayout('admin');
        return $this->render('user/showAdd', ['model' => $user]);
    }
    public function edit(Request $request)
    {
        $user = new Users();
        if ($request->isPost())
        {
            $user->loadData($request->getBody());
            // kiểm tra mk không đổi
            $userCheck = $user->findOne(['user_id' => $user->user_id]);
            if ($userCheck->user_password !== $user->user_password)
            {
                $user->user_password = md5($user->user_password);
            }
            $attribute = [
                'user_firstname' => $user->user_firstname, 'user_lastname' => $user->user_lastname,
                'user_phone' => $user->user_phone, 'user_address' => $user->user_address,
                'user_password' => $user->user_password];

            $user->user_email = ' ';
            $where = ['user_id' => $user->user_id];
            if ($user->validate() && $user->upateUser($attribute, $where))
            {
                Application::$app->session->setFlash('success', 'Edit data user successfuly!');
                Application::$app->response->redirect('/admin/user');
            } else
            {
                Application::$app->session->setFlash('error', 'Error edit data user!');
                $this->setLayout('admin');
                return $this->render('user/showEdit', ['model' => $user]);
            }
        }
        // lấy dữ liệu từ request
        $reqGet = $request->getBody();
        // lấy data từ id
        $user = $user->getUserById($reqGet['id']);
        $this->setLayout('admin');
        return $this->render('user/showEdit', ['model' => $user]);
    }
    public function remove(Request $request)
    {
        $user = new Users();
        if ($request->isGet())
        {
            $reqGet = $request->getBody();
            if ($user->removeUserById($reqGet['id']))
            {

                Application::$app->session->setFlash('success', 'drop data user successfuly!');
                Application::$app->response->redirect('/admin/user');
            } else
            {
                Application::$app->session->setFlash('error', 'Không thể xóa!');
                Application::$app->response->redirect('/admin/user');
            }
        }
    }
}


?>
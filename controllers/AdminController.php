<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        $this->setLayout('admin');
        return $this->render('adminhome');
    }
}
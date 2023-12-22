<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\Report;

class AdminController extends Controller
{
    public $report;


    public function __construct()
    {
        $this->report = new Report();
    }

    public function home(Request $request)
    {
        $this->setLayout('admin');
        return $this->render('adminhome');
    }
    public function showReport(Request $request)
    {
        $data = $this->report->get12MonthRepor();
        $jsonString = json_encode($data);
        echo '<pre>';
        var_dump($jsonString);
        echo '</pre>';
        exit;
    }
}
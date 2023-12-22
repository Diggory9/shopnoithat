<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Report;

class ReportController extends Controller
{
    public $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function index()
    {
        $this->setLayout('admin');
        $top3 = $this->report->getTop3ProductSell();
        
        return $this->render('report/report',['product_top3'=>$top3]);
    }
}
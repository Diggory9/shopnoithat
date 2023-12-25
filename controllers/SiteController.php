<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Category;
use app\models\Product;
use app\models\Supplier;
use app\models\ProductImage;

class SiteController extends Controller
{

    private $product;
    private $category;
    private $supplier;


    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->supplier = new Supplier();
    }
    public function home(Request $request)
    {
        $reqGet = $request->getBody();

        $data = $this->product->getProductByPage();

        $categoris = $this->category->selectAll();
        $suppliers = $this->supplier->selectAll();
        $image = new ProductImage();
        foreach ($data as $value)
        {
            $dataImg = $image->getImageByProductId($value->product_id);
            if (isset($dataImg))
            {
                $value->images = $dataImg;
            }
        }
        return $this->render('home', ['data' => $data, 'categoris' => $categoris, 'supplier' => $suppliers]);

    }
    public function about()
    {
        return $this->render('about');
    }
    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        var_dump($body);
        return 'This page handleContact';
    }
}
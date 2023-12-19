<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Product;
use app\models\ProductImage;

class ProductController extends Controller
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function showDetail()
    {
        $id =1;

        $pro = new Product();

        $image = new ProductImage();
        $proData = $pro->getProductById($id);
        $imageData = $image->getImageByProductId($id);

        return $this->render('detail_product',['product'=>$proData,'image'=> $imageData]);
    }

    public function showProduct($category='')
    {
        $data = $this->product->getProductByPage();
        $image = new ProductImage();
        foreach($data as $value)
        {
            $dataImg = $image->getImageByProductId($value->product_id);
            if(isset($dataImg))
            {
                $value->images = $dataImg;
            }
        }
        echo '<pre>';
        //var_dump($data);
        echo '</pre>';
        return $this->render('product_page',['data'=>$data]);
    }
}
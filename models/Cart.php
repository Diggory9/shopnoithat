<?php

namespace app\models;

class Cart
{
    // Lấy thông tin giỏ hàng từ session
    private $items;

    public function __construct()
    {
        
        if (!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();
        }
        $this->items = &$_SESSION['cart'];
    }

   
    public function addProduct($productId, $quantity = 1)
    {
        
        $product = new Product();
        $product = $product->getProductById($productId);
        $img = new ProductImage();
        $images = $img->getImageByProductId($productId);
        if (array_key_exists($productId, $this->items))
        {
            $arr = &$this->items[$productId];
            $arr['sl'] = $quantity + $arr['sl'];
            $this->items[$productId] = $arr;
        } else
        {
            $arr = ['product_name' => $product->product_name, 'product_price' => $product->product_price, 'sl' => $quantity,'img'=>$images[0]->image_path];
            $this->items[$productId] = $arr;
        }
    }
    public function removeProduct($productId)
    {
        if (array_key_exists($productId, $this->items))
        {
            unset($this->items[$productId]);
        } else
        {
            echo "Sản phẩm không tồn tại trong giỏ hàng.";
        }
    }

    // Cập nhật số lượng của sản phẩm trong giỏ hàng
    public function updateQuantity($productId, $quantity)
    {
        if (array_key_exists($productId, $this->items))
        {
            $arr = &$this->items[$productId];
            $arr['sl'] = $quantity;
            $this->items[$productId] = $arr;
        } else
        {
            echo "Sản phẩm không tồn tại trong giỏ hàng.";
        }   
    }
}

?>
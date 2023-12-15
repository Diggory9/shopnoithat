
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image"> <img class="d-block w-100" src="<?php echo BASE__URL.'images/uploads/'.$image[0]->image_path?>"
                            id="main_product_image">
                    </div>
                    <div class="thumbnail_images wrapper">
                        <ul id="thumbnail">
                            <?php
                                foreach($image as $value)
                                {
                                    ?>
                                    <li class="image-box"><img onclick="changeImage(this)" src="<?php echo BASE__URL.'images/uploads/'.$value->image_path;?>"
                                    width="70"></li>
                                    <?php
                                }
                            
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>
                                <?php echo $product->product_name?>

                        </h3> <span class="heart"><i class='bi bi-heart'></i></span>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <strong>Mô tả sản phẩm</strong>
                        <p>
                            <?php echo $product->product_des?>
                        </p>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <h4>Giá sản phẩm:</h4>
                        <span>
                            <?php
                            $priceFormat = number_format($product->product_price, 2, ',', '.');
                            echo $priceFormat.' đ';?>
                        </span>
                    </div>
                    <div class="ratings d-flex flex-row align-items-center">
                        <div class="d-flex flex-row"> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bx-star'></i>
                        </div>
                    </div>

                    <div class="buttons d-flex flex-row mt-5 gap-5">
                        <button class="btn btn-outline-dark">Mua ngay</button>
                        <button class="btn btn-dark">Thêm vào giỏ hàng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

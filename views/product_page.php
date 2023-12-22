<div class="container mt-5 mb-5">
    <div class="row g-2">
        <div class="col-md-2 bg-light">
            <div class="p-2">
                <h6 class="text-uppercase text-center">Danh mục sản phẩm</h6>
                <div class="p-lists">
                    <div class="d-flex justify-content-between mt-2"> <span><a href="/product" class="text-decoration-none">Tất cả </a></span> <span>  </span> </div>
                    <?php 
                    foreach($categoris as $value)
                    {
                        ?>
                            <div class="d-flex justify-content-between mt-2"> <span><a href="/product?category_id=<?php echo $value->category_id;?>" class="text-decoration-none"><?php echo $value->category_name;?> </a></span> <span>  </span> </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row g-2">

            <!-- show product -->
                <?php

                foreach ($data as $value)
                {
                    ?>
                    <div class="col-lg-4">
                        <div class="product py-4">
                            <div class="text-center"> <img src="<?php echo BASE__URL.'images/uploads/'. $value->images[0]->image_path;?>" width="250" height="200"> </div>
                            <div class="about text-center">
                            <!-- show name product     -->
                            <h5 height="70"></h5><?php echo $value->product_name;?></h5>
                            <br/>
                            <!-- show price product  -->
                            <span><?php 
                                 $priceFormat = number_format($value->product_price, 2, ',', '.');
                                 echo $priceFormat.' đ';
                            ?></span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center">
                                <button  class="btn btn-primary text-uppercase"><a href="/detail-product?id=<?php echo $value->product_id?>" class="text-decoration-none text-white">CHI TIẾT SẢN PHẨM</a></button>
                                <a href="add-cart?id=<?php echo $value->product_id?>">  <button class=" btn btn-primary"><i class="fa-brands fa-opencart"></i></button></a>
                               
                            </div>
                        </div>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>
    </div>
</div>

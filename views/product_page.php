<div class="container mt-5 mb-5">
    <!-- form tìm kiếm -->
    <div class="col-md-4 order-md-2 mb-8">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100" method="get" action="/product">
                        <div class="input-group">
                            <input class="form-control" type="text" name="product_name" placeholder="Tìm kiếm theo tên sản phẩm" aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $name ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>
            
    </div>
   
    <div class="row g-2">
        
        <div class="col-md-2 bg-light">
            <div class="p-2">
                <h6 class="text-uppercase text-center">Danh mục sản phẩm</h6>
                <div class="p-lists">
                    <div class="d-flex justify-content-between mt-2"> <span><a href="/product" class="text-decoration-none">All Sản phẩm </a></span> <span>  </span> </div>
                    <?php 
                    foreach($categoris as $value)
                    {
                        ?>
                            <div class="d-flex justify-content-between mt-2"> <span><a href="/product?category_id=<?php echo $value->category_id;?>" class="text-decoration-none"><?php echo $value->category_name;?> </a></span> <span>  </span> </div>
                        <?php
                    }
                    ?>

                        <!-- Sắp xếp  -->
                        <label style="margin-top: 30px;">Bộ lọc</label>
                        <form  style="margin-top: 10px;" action="/product" method="get" id="filterProduct">
                            <select name="selectOption" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                
                                <option value="pro_asc">Theo giá: Thấp đến cao</option>
                                <option value="pro_desc">Theo giá: Cao đến thấp</option>
                            </select>
                            <input style="margin-top: 20px;background-color:#3b5d50;" type="submit" value="Áp dụng" class="btn-sm btn-secondary"/>
                        </form>
                        
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
                                 $priceFormat = number_format($value->product_price, 0, ',', '.');
                                 echo $priceFormat.' đ';
                            ?></span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center">
                            
                             <a href="/detail-product?id=<?php echo $value->product_id?>">  <button class=" btn btn-primary">CHI TIẾT SẢN PHẨM</button></a>
                              
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

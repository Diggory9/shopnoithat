
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
                        <a href="buy-now?id=<?php echo $value->product_id?>"><button class="btn btn-outline-dark">Mua ngay</button></a>
                        
                        <a href="add-cart?id=<?php echo $value->product_id?>"> <button class="btn btn-dark">Thêm vào giỏ hàng</button></a>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Sản phẩm liên  quan -->
<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
				
		      	<div class="row">
				<div class="row mb-5">
					<div class="col-md-12 text-center">
						<h2 class="section-title text-secondary">Sản phẩm bạn có thể thích</h2>
					</div>
					
				</div>
					  <!-- show product -->
					  <?php

				foreach ($productRand as $value)
				{
					?>
		      		<!-- Start Column 1 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<a class="product-item" href="/detail-product?id=<?php echo $value->product_id?>">
							<img src="<?php echo BASE__URL.'images/uploads/'. $value->images[0]->image_path;?>" class="img-fluid product-thumbnail">
							<h3 class="product-title"><?php echo $value->product_name;?></h3>
							<strong class="product-price"><?php 
                                 $priceFormat = number_format($value->product_price, 0, ',', '.');
                                 echo $priceFormat.' đ';
                            ?></strong>

							<span class="icon-cross">
								<img src="images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div> 
					<!-- End Column 1 -->
					<?php
                }

                ?>


		      	</div>
		    </div>
		</div>
        
		<!-- Start Testimonial Slider -->
		<div class="testimonial-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title">Phản hồi</h2>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-12">
						<div class="testimonial-slider-wrap text-center">

							<div id="testimonial-nav">
								<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
								<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
							</div>

							<div class="testimonial-slider">
								
								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;Dịch vụ chất lượng, chế độ bảo dưỡng kỹ. Ai mà mua hàng ở đây thì rất đáng đồng tiền bát gạo nha, giá tiền đi đôi chất lượng ạ.&rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Maria Jones</h3>
													<span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;Sản phẩm tốt ngồi êm ái thoải mái rất hài lòng , kèm theo dịch vụ hậu mãi rất tốt , 
														đúng định kỳ , sạch sẽ, nhân viên đến chăm sóc sản phẩm thái độ phẩm chất rất có tâm về sản phẩm.
														Rất hài lòng chế độ  mang đến cho gđ &rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Thế Nguyễn</h3>
													<span class="position d-block mb-3">CEO, Co-Founder,STU</span>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

								<div class="item">
									<div class="row justify-content-center">
										<div class="col-lg-8 mx-auto">

											<div class="testimonial-block text-center">
												<blockquote class="mb-5">
													<p>&ldquo;Sản phẩm TV SHOP đẳng cấp, xứng đáng để sử dụng, sự đầu tư về chi phí, chất lượng sản phẩm, chất lượng dịch vụ bảo hành tốt.&rdquo;</p>
												</blockquote>

												<div class="author-info">
													<div class="author-pic">
														<img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
													</div>
													<h3 class="font-weight-bold">Việt Nguyễn</h3>
													<span class="position d-block mb-3">CEO, Co-Founder, STU </span>
												</div>
											</div>

										</div>
									</div>
								</div> 
								<!-- END item -->

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Testimonial Slider -->
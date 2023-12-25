
		<!-- Start Hero Section -->	
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Nội thất cao cấp</h1>
								
								<p class="mb-4">Nhà là gia đình - Cùng trải nghiệm những sản phẩm và dịch vụ đẳng cấp hàng đầu thế giới, cùng tô điểm Yêu thương cho gia đình!</p>
								<p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="images/couch.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->
		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="images/img-grid-1.jpg" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="images/img-grid-2.jpg" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="images/img-grid-3.jpg" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">Giá trị và sự khác biệt</h2>
						<p>	Với mong muốn phát triển thương hiệu Việt bằng nội lực, 
							chúng tôi chú trọng vào thiết kế và sản xuất nội thất trong nước.
							Danh mục sản phẩm thường xuyên được đổi mới và cập nhật,
							liên tục cung cấp cho khách hàng các dòng sản phẩm theo xu hướng mới nhất.
							Hơn 70% sản phẩm được thiết kế,sản xuất bởi đội ngũ nhân viên cùng công nhân
							ưu tú với nhà máy có cơ sở vật chất hiện đại bậc nhất tại Việt Nam.
							
						</p>
						<p>
							Sự khác biệt chính là sáng tạo nội thất thành phong cách riêng, 
							phù hợp với nhu cầu khách hàng. Không chỉ là sản phẩm nội thất đơn thuần, 
							mà còn là không gian sống theo phong cách riêng với cách bày trí hài hòa từ đồ nội thất kết hợp với đồ trang trí. 
							Giúp khách hàng cảm nhận được một không gian sống thực sự, cảm thấy thoải mái để tận hưởng cuộc sống.
						</p>

						<p><a herf="#" class="btn">Explore</a></p>
					</div>
				</div>
			</div>
		</div>
		<!-- End We Help Section -->
		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-6">
						<h2 class="section-title">Tại sao chọn chúng tôi</h2>
						<p>Sự khác biệt chúng tôi chính là sáng tạo nội thất 
                            thành phong cách riêng, phù hợp với nhu cầu khách hàng.
                             Không chỉ là sản phẩm nội thất đơn thuần, 
                             mà còn là không gian sống theo phong cách riêng với cách bày tr
                             í hài hòa từ đồ nội thất kết hợp với đồ trang trí. 
                           </p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Nhanh chóng</h3>
									<p>Giao hàng nhanh chóng trong nội thành TPHCM</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Nhận hàng mới thanh toán</h3>
									<p>Chính sách nhận hàng kiểm tra hàng mới thanh toán</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Cam kết giá rẻ</h3>
									<p>Cam kết giá phù hợp với mặt bằng chung của thị trường</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="images/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Chính sách đổi trả</h3>
									<p>Bảo hành 1 đổi 1 đối với lỗi do nhà sản xuất</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->
		<!-- Sản phẩm -->
		<!-- Start Popular Product -->
		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
				
		      	<div class="row">
				<div class="row mb-5">
					<div class="col-md-6">
						<h2 class="section-title">Sản phẩm</h2>
					</div>
					
				</div>
					  <!-- show product -->
					  <?php

				foreach ($data as $value)
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
		<!-- End Popular Product -->
		

		


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

</html>

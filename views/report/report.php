<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Top sản phẩm bán chạy</h1>
                <div class="row g-2" >
                    <?php
                    foreach ($product_top3 as $value)
                    {
                        ?>
                        <div class="col-lg-4">
                            <div class="product py-4">
                                <div class="text-center"> <img
                                        src="<?php echo BASE__URL . 'images/uploads/' . $value['image_path']; ?>"
                                        width="250" height="200"> </div>
                                <div class="about text-center">
                                    <!-- show name product     -->
                                    <h5 height="70"></h5><?php echo $value['product_name']; ?></h5>
                                    <br />
                                    <!-- show price product  -->
                                    <span><?php
                                    $priceFormat = number_format($value['product_price'], 0, ',', '.');
                                    echo $priceFormat . ' đ';
                                    ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                       Doanh thu 7 ngày vừa qua
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                    <div class="card-footer small text-muted">Update ngày
                                <?php $current_time = date("Y-m-d");
                                echo $current_time; ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Số lượng đơn hàng theo từng tháng
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                            <div class="card-footer small text-muted">Update ngày
                                <?php $current_time = date("Y-m-d");
                                echo $current_time; ?></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Báo cáo doanh thu tháng hiện tại theo danh mục
                            </div>
                            <div class="card-body"><canvas id="report-category" width="100%" height="50"></canvas></div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
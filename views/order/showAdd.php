<?php

use app\core\Application;

?>
<div class="container mb-5">
    <div class="py-5 text-center">

        <h2>Thêm đơn hàng</h2>
    </div>
    <div class="col-12">
    <div class=" bg-grey" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="row g-0">
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h1 class="fw-bold mb-0 text-black">Sản phẩm</h1>
                            <h6 class="mb-0 text-muted"></h6>
                        </div>
                        <hr class="my-4">
                        <?php
                        if (empty($_SESSION['cartAdmin']))
                        {
                            echo '<h2>Bạn chưa có sản phẩm nào</h2>';
                        } else
                        {


                            $total = 0;

                            foreach ($_SESSION['cartAdmin'] as $key => $value): ?>
                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="<?php echo BASE__URL . 'images/uploads/' . $value['img'] ?>"
                                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h6 class="text-black mb-0"><?php echo $value['product_name'] ?></h6>
                                    </div>

                                    <form action="cart-update" method="get" class="col-md-4 col-lg-3 col-xl-2 d-flex">
                                        <input type="hidden" name="id" value=<?php echo $key ?>>

                                        <button class="btn btn-link px-1 mx-1" type="submit"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity" value="<?php echo $value['sl'] ?>"
                                            type="number" class="form-control form-control-sm" />

                                        <button class="btn btn-link  px-1 mx-1" type="submit"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                    </form>

                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <h6 class="mb-0"><?php
                                        $total += $value['sl'] * $value['product_price'];
                                        $priceFormat = number_format($value['sl'] * $value['product_price'], 0, ',');
                                        echo $priceFormat . ' đ' ?></h6>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="cart-remove?id=<?php echo $key; ?>" class="text-muted"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>

                                <hr class="my-4">
                            <?php endforeach; ?>
                            <div class="pt-5">
                                <h6 class="mb-0"><a href="/product" class="text-body"><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Back
                                        to shop</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 bg-grey">
                        <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-uppercase">
                                    <?php echo !empty($_SESSION['cartAdmin']) ? count($_SESSION['cartAdmin']) . " items" : 0 . ' item'; ?>
                                </h5>
                                <h5><?php

                                $totalFormat = number_format($total, 0, ',');
                                echo $totalFormat . ' đ' ?>

                                </h5>
                            </div>
                            <h5 class="text-uppercase mb-3">Shipping</h5>

                            <div class="mb-4 pb-2">
                                <select class="select">
                                    <option value="1">Standard-Delivery- 50.000 đ</option>
                                </select>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-between mb-5">
                                <h5 class="text-uppercase">Total price</h5>
                            
                                <h5><?php    $total += 50000; $totalFormat = number_format($total, 0, ',');
                                echo $totalFormat . ' đ' ?></h5>
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
    <div class="row">
        <div class="col-md-5 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Nhập mã sản phẩm</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100"
                        method="get" action="/admin/order/add">
                        <div class="input-group">
                            <input class="form-control" type="text" name="product_id"
                                placeholder="Tìm kiếm theo mã sản phẩm" aria-label="Search for..."
                                aria-describedby="btnNavbarSearch" value="<?php echo $id ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                                    class="fas fa-search"></i>
                                </button>
                        </div>
                    </form>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <?php
                    if (!empty($product))
                    {
                        ?>
                        <div class="product py-4">
                            <div class="about text-center">
                                <!-- show name product     -->
                                <h5 height="70"></h5><?php echo $product->product_name; ?></h5>
                                <br />
                                <!-- show price product  -->
                                <span><?php
                                $priceFormat = number_format($product->product_price, 2, ',', '.');
                                echo $priceFormat . ' đ';
                                ?></span>
                            </div>
                            <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center">
                                <a href="add-cart?id=<?php echo $product->product_id ?>"> <button
                                        class=" btn btn-primary">Thêm vào danh sách</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </li>
            </ul>
        </div>
        <div class="col-md-7 order-md-1">

            <form method="post" action="/admin/order/add" class="needs-validation">
                <input type="text" name="user_id" value="<?php echo $_SESSION['user']??0;?>" hidden />
                <input type="text" name="total_amount" value="<?php echo $total; ?>" hidden />
                <h4 class="mb-3">Billing address</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="lastName">Tên người nhận<span class="text-danger"> *</span></label>
                        <input type="text" name="consignee_name"
                            class="form-control  <?php echo $model->hasError('consignee_name') ? 'is-invalid' : ''; ?>"
                            id="lastName" placeholder="Họ và tên"
                            value="<?php echo !empty($model->consignee_name) ? $model->consignee_name : ''; ?>"
                            required="">
                        <div class="invalid-feedback">
                            <?php echo $model->getFirstError('consignee_name'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <input type="text" name="consignee_add"
                        class="form-control <?php echo $model->hasError('consignee_add') ? 'is-invalid' : ''; ?>"
                        id="address" placeholder="1234 Main St" required=""
                        value="<?php echo !empty($model->consignee_add) ? $model->consignee_add : ''; ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('consignee_add'); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="consignee_phone"
                        class="form-control  <?php echo $model->hasError('consignee_phone') ? 'is-invalid' : ''; ?>"
                        id="phone" placeholder="Apartment or suite"
                        value="<?php echo !empty($model->consignee_phone) ? $model->consignee_phone : ''; ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('consignee_phone'); ?>
                    </div>
                </div>


                <hr class="mb-4">


                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked=""
                            required="">
                        <label class="custom-control-label" for="credit">Thanh toán khi giao hàng</label>
                    </div>
                </div>
                <hr class="mb-4">
                <a href="#confModal" data-bs-toggle="modal" data-bs-target="#confModal" title="xác nhận"> <button
                        class="btn btn-primary btn-lg btn-block mb-4" type="submit">Xác nhận</button></a>
                <div class="modal fade" id="confModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Xác nhận đặt hàng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Bạn chắc chắn xác nhận đặt hàng</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Xác nhận" class="btn btn-secondary" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
  
</div>
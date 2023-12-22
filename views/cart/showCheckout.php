<?php

use app\core\Application;

?>
<div class="container">
    <?php
    if (empty($_SESSION['cart']))
    {
        echo '<h2>Bạn chưa có sản phẩm nào trong giỏ hàng</h2>';

        echo '   <a href="/product">
            <button type="button" class="btn btn-dark btn-block btn-lg"
              data-mdb-ripple-color="dark">Quay trở về shop</button>
          </a>';
    } else
    {
        ?>

        <div class="py-5 text-center">

            <h2>Checkout form</h2>
        </div>
        <form method="post" action="/checkout" class="needs-validation">
        <input type="text" name="user_id" value="<?php echo $_SESSION['user']?>" hidden/>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $key => $value)
                    {
                        $total += $value['sl'] * $value['product_price'];
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $value['product_name'] ?></h6>
                                <small class="text-muted">Số lượng: <?php echo $value['sl'] ?></small>
                            </div>
                            <span class="text-muted">
                                <?php
                                $priceFormat = number_format($value['sl'] * $value['product_price'], 0, ',');
                                echo $priceFormat . ' đ'
                                    ?>
                            </span>
                        </li>

                        <?php
                    }

                    ?>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-secondary">
                            <h6 class="my-0">Vận chuyển</h6>
                            <small></small>
                        </div>
                        <span class="text-secondary">500,000 đ</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <input type="text" name="total_amount" id="" value="<?php $total+=500000; echo $total?>" hidden>
                        <strong><?php $totalFormat = number_format($total, 0, ',');

                                echo $totalFormat . ' đ'?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
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
                        <!-- <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="debit">Momo</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="paypal">VNPay</label>
                        </div> -->
                    </div>
                    <hr class="mb-4">
                    <a href="#confModal" data-bs-toggle="modal" data-bs-target="#confModal" title="xác nhận"> <button
                            class="btn btn-primary btn-lg btn-block" type="submit">Xác nhận</button></a>
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
               
            </div>
        </div>
        </form>
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2018 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <?php
    }

    ?>
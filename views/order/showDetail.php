<?php

$status = [0 => 'Đơn hàng mới', 1 => 'Xác nhận đơn hàng', 2 => 'Chờ xuất hàng', 3 => 'Chờ giao hàng', 4 => 'Đã giao hàng', 5 => 'Hủy đơn hàng']

    ?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Chi tiết đơn hàng</h2>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <div>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Thông tin đơn hàng</span>
                </h4>
                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Mã đơn hàng:</h6>
                        </div>
                        <span class="text-muted">
                            <?php echo $order->order_id; ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-secondary">
                            <h6 class="my-0">Ngày lập: </h6>
                            <small></small>
                        </div>
                        <span class="text-secondary"><?php echo $order->order_date ?></span>
                    </li>
                    <li class="list-group-item ">
                        <form action="update-status" method="get"
                            class="needs-validation d-flex justify-content-between">
                            <input type="text" name="id" value="<?php echo $order->order_id?>" hidden/>
                            <div class="text-secondary">
                                <h6 class="my-0">Trạng thái </h6>
                                <small></small>
                            </div>
                            <span class="text-muted">
                                <select id="inputState" name="status">
                                    <?php
                                    // duyệt for
                                    for ($i = 0; $i <= 5; $i++)
                                    {
                                        ?>
                                        <option
                                         <?php if ($i ===  $order->status)
                                                {
                                                    echo 'selected';
                                                }
                                                else if( $i-1 != $order->status && $i != $order->status && $i != 5)
                                                {
                                                    echo 'disabled';
                                                }
                                        ?> 
                                            
                                            value="<?php echo $i ?>"><?php echo $status[$i] ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </span>
                            <input type="submit" value="Cập nhật" class="btn-primary btn-sm" />
                        </form>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Thông tin người nhận</span>
                </h4>
                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tên người nhận</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">
                            <?php echo $order->consignee_name ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-secondary">
                            <h6 class="my-0">Số điện thoại</h6>
                            <small></small>
                        </div>
                        <span class="text-secondary"><?php echo $order->consignee_phone ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="text-secondary">
                            <h6 class="my-0">Địa chỉ nhận hàng</h6>
                            <small></small>
                        </div>
                        <span class="text-secondary"><?php echo $order->consignee_add ?></span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Thông tin thanh toán</span>
                </h4>
                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Trạng thái thạnh toán</h6>
                            <small class="text-muted">Thanh toán khi giao hàng</small>
                        </div>
                        <span class="text-muted">
                        Chưa thanh toán
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Chi tiết sản phẩm</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col">Tên sản phẩm</th>
                        <th class="col">Số lượng</th>
                        <th class="col">Đơn giá</th>
                        <th class="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($detailOrder as $value)
                    {
                        $total += $value->quantity * $value->price;
                        ?>
                        <tr>
                            <td><?php echo $value->product_name ?></td>
                            <td><?php echo $value->quantity ?></td>
                            <td><?php
                            $priceFormat = number_format($value->price, 0, ',');
                            echo    $priceFormat . ' đ' ?></td>
                            <td><?php
                            $tFormat = number_format($value->price* $value->quantity, 0, ',');
                            echo    $tFormat . ' đ' ?></td>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="order-md-2 col-md-6 mb-4">


                <h2>Tổng tiền</h2>
                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tổng tiền hàng</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">
                        <?php
                            $totalFormat = number_format($total, 0, ',');
                            echo    $totalFormat . ' đ' ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-secondary">
                            <h6 class="my-0">Phí vận chuyển</h6>
                            <small></small>
                        </div>
                        <span class="text-secondary"> <?php
                            $pFormat = number_format(500000, 0, ',');
                            echo    $pFormat . ' đ' ?></span>
                    </li>
                    <hr/>   
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="text-secondary">
                            <h6 class="my-0">Tổng giá trị đơn hàng</h6>
                            <small></small>
                        </div>
                        <span class="text-secondary">
                        <?php
                            $ttFormat = number_format(500000+$total, 0, ',');
                            echo    $ttFormat . ' đ' ?>
                        </span>
                    </li>
                </ul>

            </div>
            <a href="/admin/order" class="btn btn-primary rounded">Trở lại trang quản lý đơn hàng</a>
        </div>
     
    </div>
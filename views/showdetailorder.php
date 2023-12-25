<?php
     $status = [0 => 'Đơn hàng mới', 1 => 'Xác nhận đơn hàng', 2 => 'Chờ xuất hàng', 3 => 'Chờ giao hàng', 4 => 'Đã giao hàng', 5 => 'Hủy đơn hàng']

?>

<div style="margin:5%;">
    <div style="margin-bottom: 2rem;" class="row g-2 mt-10">
        <h1>Chi tiết đơn hàng </h1>
        <div class="col-2"> <a href="/user-order" class="btn btn-primary btn-sm rounded">Trở lại</a></div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col">Tên sản phẩm</th>
                <th class="col">Số lượng sản phẩm</th>
                <th class="col">Đơn giá</th>
                <th class="col">Thành tiền</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($detailOrder as $value)
            {
                $total += $value->price * $value->quantity;
                ?>
                <tr>
                    <td><?php echo $value->product_name ?></td>
                    <td><?php echo $value->quantity ?></td>
                    <td><?php $priceFormat = number_format($value->price, 0, ',', '.');
                    echo $priceFormat . ' đ' ?></td>
                    <td><?php $totalFormat = number_format($value->price * $value->quantity, 0, ',', '.');
                    echo $totalFormat . ' đ' ?></td>

                </tr>
                <?php
            }
            ?>



        </tbody>
    </table>

    <hr />
    <div class="row mt-5">
        <div class="order-md-2 col-md-6 mb-4">

            <ul class="list-group mb-3">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Tiền hàng</span>
                </h4>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Tổng tiền hàng</h6>
                        <small class="text-muted"></small>
                    </div>
                    <span class="text-muted">
                        <?php
                        $totalFormat = number_format($total, 0, ',');
                        echo $totalFormat . ' đ' ?>
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-secondary">
                        <h6 class="my-0">Phí vận chuyển</h6>
                        <small></small>
                    </div>
                    <span class="text-secondary"> <?php
                    $pFormat = number_format(500000, 0, ',');
                    echo $pFormat . ' đ' ?></span>
                </li>
                <hr />
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-secondary">
                        <h6 class="my-0">Tổng giá trị đơn hàng</h6>
                        <small></small>
                    </div>
                    <span class="text-secondary">
                        <?php
                        $ttFormat = number_format(500000 + $total, 0, ',');
                        echo $ttFormat . ' đ' ?>
                    </span>
                </li>
            </ul>

        </div>
        <div class="col-md-6 order-md-2 mb-4">
            <div>

                <ul class="list-group mb-3">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Thông tin đơn hàng</span>
                    </h4>
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
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-secondary">
                            <h6 class="my-0">Trạng thái</h6>
                            <small></small>
                        </div>
                        <span class="text-secondary"><?php echo $status[$order->status] ?></span>
                    </li>
                    <li class="list-group-item mt-3">
                        <a href="#deleteModal" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            class="link-underline btn btn-primary btn-sm rounded" title="remove category">Hủy đơn hàng</a>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Hủy đơn hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Bạn có chắc hủy đơn hàng này không</h4>
                                        <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                            hiện!. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a href="/user-order/cancel-order?productid=<?php echo $order->order_id;?>&status=5" class="btn btn-primary">Thực hiện hủy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
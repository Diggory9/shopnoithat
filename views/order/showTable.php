<?php

$status = [0 => 'Đơn hàng mới', 1 => 'Xác nhận đơn hàng', 2 => 'Chờ xuất hàng', 3 => 'Chờ giao hàng', 4 => 'Đã giao hàng', 5 => 'Hủy đơn hàng']

?>

<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">Trang quản lý đơn hàng</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/order/add" class="btn btn-primary rounded">Create</a>
        </div>
    </div>

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Mã order</th>
                    <th class="col">Người đặt hàng</th>
                    <th class="col">Số điện thoại</th>
                    <th class="col">Ngày lập hóa đơn</th>
                    <th class="col">Tổng giá</th>
                    <th class="col">Trạng thái</th>
                    <th >Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $value)
                {
                    ?>
                    <tr>
                        <td>1</td>
                        <td><?php echo $value->order_id ?></td>
                        <td><?php echo $value->consignee_name ?></td>
                        <td><?php echo $value->consignee_phone ?></td>
                        <td><?php echo $value->order_date ?></td>
                        <td><?php
                        $totalFormat = number_format( $value->total_amount, 0, ',');
                        echo $totalFormat . ' đ'?></td>
                        <td><?php echo $status[$value->status] ?></td>
                        <td>
                            <a href="/admin/order/detail?id=<?php echo $value->order_id?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="Chi tiết đơn hàng"><i
                                    class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
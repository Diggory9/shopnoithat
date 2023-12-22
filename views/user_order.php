<?php $status = [0 => 'Đơn hàng mới', 1 => 'Xác nhận đơn hàng', 2 => 'Chờ xuất hàng', 3 => 'Chờ giao hàng', 4 => 'Đã giao hàng', 5 => 'Hủy đơn hàng']
?>
<div style="margin:5%;">
        <div style="margin-bottom: 2rem;" class="row justify-content-center align-items-center g-2 mt-10">
            <h1>Thông tin đơn hàng </h1>
            <a href="/profile">Trở lại</a>
        </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col">Khách hàng</th>
                        <th class="col">Ngày đặt hàng</th>
                        <th class="col">Trạng thái</th>
                        <th class="col">Tổng tiền</th>
                        <th class="col">Số điện thoại</th>
                        <th class="col">Địa chỉ</th>
                        <th class="col">Thông tin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($model as $value)
                    {
                        ?>
                        <tr>
                            <td><?php echo $value->consignee_name ?></td>
                            <td><?php echo $value->order_date ?></td>
                            <td><?php echo $status[$value->status] ?></td>
                            <td><?php echo $value->total_amount ?></td>
                            <td><?php echo $value->consignee_phone ?></td>
                            <td><?php echo $value->consignee_add ?></td>
                            <td><a href="user_order/detail?order_id=<?php echo $value->order_id ?>" > Chi tiết</a></td>
                            
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
</div>
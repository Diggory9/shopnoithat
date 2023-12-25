<?php

$status = [0 => 'Đơn hàng mới', 1 => 'Xác nhận đơn hàng', 2 => 'Chờ xuất hàng', 3 => 'Chờ giao hàng', 4 => 'Đã giao hàng', 5 => 'Hủy đơn hàng']

?>

<div class="container">
    <div class="row mt-4">
        <div class="col-6">
            <h2 class="text-primary">Trang quản lý đơn hàng</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/order/add" class="btn btn-primary rounded">Create</a>
        </div>
        <!-- form tìm kiếm -->
        <div class="col-md-5 order-md-2 mb-8">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100" method="get" action="/admin/order">
                        <div class="input-group">
                            <input class="form-control" type="text" name="order_id" placeholder="Tìm kiếm theo mã đơn hàng" aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $id ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        
        
    </div>

    <!-- Sắp xếp  -->
    <label style="margin-top: 30px;">Bộ lọc</label>
        <form class="col-4"  style="margin-top: 10px;" action="/admin/order" method="get" id="filterProduct">
            <select name="selectOption" class="form-select form-select-sm" aria-label=".form-select-sm example">                
                <option value="new_order">Đơn hàng mới</option>
                <option value="accept_order">Xác nhận đơn hàng</option>
                <option value="wait_order">Chờ xuất hàng</option>
                <option value="delivery_order">Chờ giao hàng</option>
                <option value="delivered_order">Đã giao hàng</option>
                <option value="cancel_order">Hủy đơn hàng</option>
            </select>
            <input style="margin-top: 20px;background-color:#3b5d50;" type="submit" value="Áp dụng" class="btn-sm btn-secondary"/>
        </form>
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
                if(!empty($data[0])){
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
                }
                else{
                    echo "Không tìm thấy mã đơn hàng";
                }
                
                ?>
            </tbody>
        </table>
    </div>
</div>
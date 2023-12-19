<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">Trang sản phẩm</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/product/add" class="btn btn-primary rounded">Create</a>
        </div>
    </div>

    <div class="card">
        <form action="/admin/category" method="post"></form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Mã</th>
                    <th class="col">Tên sản phẩm</th>
                    <th class="col">Giá sản phẩm</th>
                    <th class="col">Số lượng</th>
                    <th class="col">Danh mục</th>
                    <th class="col">Nhà cung cấp</th>
                    <th class="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $value)
                {
                    ?>
                    <tr>
                        <td>1</td>
                        <td><?php echo $value->product_id ?></td>
                        <td><?php echo $value->product_name ?></td>
                        <td><?php echo $value->product_price ?></td>
                        <td><?php echo $value->product_stock_quantity ?></td>
                        <td><?php echo empty($value->category)?'Không có danh mục':$value->category->category_name ?></td>
                        <td><?php echo empty($value->supplier)?'Không có nhà cung cấp':$value->supplier->supplier_name ?></td>
                        <td>
                            <a href="/admin/product/edit?id=<?php echo $value->product_id ?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="edit category"><i
                                    class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                            <a href="#deleteModal<?php echo $value->supplier_id ?>" data-bs-toggle="modal"
                                data-bs-target="#deleteModal<?php echo $value->supplier_id ?>" class="link-underline btn btn-primary btn-sm rounded"
                                title="remove category"><i class="fa-solid fa-trash"></i></a>&nbsp;
                            <div class="modal fade" id="deleteModal<?php echo $value->supplier_id ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Xóa danh mục <?php echo $value->supplier_name ?> </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Bạn có chắc xóa danh mục <?php echo $value->supplier_name ?></h4>
                                            <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                hiện!. </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="/admin/supplier/remove?id=<?php echo $value->supplier_id ?>"
                                                class="btn btn-primary">Thực hiện xóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/product/detail?id=<?php echo $value->product_id?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="Chi tiết sản phẩm"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
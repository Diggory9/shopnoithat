<div class="container">
    <div class="row mb-1 mt-1">
        <div class="col-6">
            <h2 class="text-primary">Trang sản phẩm</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/product/add" class="btn btn-primary rounded">Create</a>
        </div>
        <!-- form tìm kiếm -->
        <div class="col-md-5 order-md-2 mb-8">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100" method="get" action="/admin/product">
                        <div class="input-group">
                            <input class="form-control" type="text" name="product_name" placeholder="Tìm kiếm theo tên sản phẩm" aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $name ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <form class="col-3" action="/admin/product" method="get" id="filterProduct">
            <select class="form-select" name="selectOption">
                
               
                <option value="pro_all">Show sản tất cả</option>
                <option value="pro_almost">Show sản phẩm sắp hết</option>
            </select>
            <input style="margin-top: 10px; background-color:#3b5d50" type="submit" value="Áp dụng" class="btn-sm btn-secondary"/>
        </form>
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
                if(!empty($data[0]))
                {
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
                                    class="link-underline btn btn-primary btn-sm rounded" title="edit user"><i
                                        class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                                <a href="#deleteModal<?php echo $value->product_id ?>" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal<?php echo $value->product_id ?>"
                                    class="link-underline btn btn-primary btn-sm rounded" title="remove user"><i
                                        class="fa-solid fa-trash"></i></a>
                                <div class="modal fade" id="deleteModal<?php echo $value->product_id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
    
                                            <div class="modal-header">
                                                <h5 class="modal-title">Xóa product <?php echo $value->product_name ?> </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Bạn có chắc xóa  <?php echo $value->product_name ?></h4>
                                                <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                    hiện!. </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="/admin/product/remove?id=<?php echo $value->product_id ?>"
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
                }
                else{
                    echo"Không tìm thấy sản phẩm";
                }
            
                ?>
            </tbody>
        </table>
    </div>
</div>

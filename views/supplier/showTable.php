<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">Nhà cung cấp</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/supplier/add" class="btn btn-primary rounded">Create</a>
        </div>
    </div>
    <!-- form tìm kiếm -->
    <div class="col-md-5 order-md-2 mb-8">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100" method="get" action="/admin/supplier">
                        <div class="input-group">
                            <input class="form-control" type="text" name="supplier_id" placeholder="Tìm kiếm theo mã supplier" aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $id ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>   
            </ul>
        </div>

    <div class="card">
        <form action="/admin/category" method="post"></form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Mã</th>
                    <th class="col">Nhà cung cấp</th>
                    <th class="col">Contact email</th>
                    <th class="col">Phone</th>
                    <th class="col">Address</th>
                    <th class="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($suppliers[0])){
                    foreach ($suppliers as $value)
                    {
                        ?>
                        <tr>
                            <td>1</td>
                            <td><?php echo $value->supplier_id ?></td>
                            <td><?php echo $value->supplier_name ?></td>
                            <td><?php echo $value->contact_email ?></td>
                            <td><?php echo $value->supplier_phone ?></td>
                            <td><?php echo $value->supplier_address?></td>
                            <td>
                                <a href="/admin/supplier/edit?id=<?php echo $value->supplier_id ?>"
                                    class="link-underline btn btn-primary btn-sm rounded" title="edit category"><i
                                        class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                                <a href="#deleteModal<?php echo $value->supplier_id ?>" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal<?php echo $value->supplier_id ?>" class="link-underline btn btn-primary btn-sm rounded"
                                    title="remove category"><i class="fa-solid fa-trash"></i></a>
                                <div class="modal fade" id="deleteModal<?php echo $value->supplier_id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
    
                                            <div class="modal-header">
                                                <h5 class="modal-title">Xóa   <?php echo $value->supplier_name ?> </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Bạn có chắc xóa   <?php echo $value->supplier_name ?></h4>
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
                            </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    echo"Không tìm thấy mã nhà cung cấp trong hệ thống";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">User</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/user/add" class="btn btn-primary rounded">Create</a>
        </div>
        <!-- form tìm kiếm -->
        <div class="col-md-5 order-md-2 mb-8">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100" method="get" action="/admin/user">
                        <div class="input-group">
                            <input class="form-control" type="text" name="user_id" placeholder="Tìm kiếm theo mã user" aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $name ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>   
            </ul>
        </div>
    </div>

    <div class="card">
        <form action="/admin/user" method="post"></form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Mã</th>
                    <th class="col">Họ tên</th>
                    <th class="col">Email</th>
                    <th class="col">Số điện thoại</th>
                    <th class="col">Địa chỉ</th>
                    <th class="col">Thao tác</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($users[0])){
                    foreach ($users as $value)
                    {
                        ?>
                        <tr>
                            <td>1</td>
                            <td><?php echo $value->user_id ?></td>
                            <td><?php echo $value->user_firstname . ' ' . $value->user_lastname; ?></td>
                            <td><?php echo $value->user_email ?></td>
                            <td><?php echo $value->user_phone ?? "Chưa có số điện thoại" ?></td>
                            <td><?php echo $value->user_address ?? "Chưa có địa chỉ" ?></td>
                            <td>
                                <a href="/admin/user/edit?id=<?php echo $value->user_id ?>"
                                    class="link-underline btn btn-primary btn-sm rounded" title="edit user"><i
                                        class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                                <a href="#deleteModal<?php echo $value->user_id ?>" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal<?php echo $value->user_id ?>"
                                    class="link-underline btn btn-primary btn-sm rounded" title="remove user"><i
                                        class="fa-solid fa-trash"></i></a>
                                <div class="modal fade" id="deleteModal<?php echo $value->user_id ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
    
                                            <div class="modal-header">
                                                <h5 class="modal-title">Xóa user <?php echo $value->user_firstname ?> </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Bạn có chắc xóa user <?php echo $value->user_firstname ?></h4>
                                                <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                    hiện!. </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="/admin/user/remove?id=<?php echo $value->user_id ?>"
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
                    echo"Không tìm thấy user trong hệ thống";
                }
              

                ?>
            </tbody>
        </table>
    </div>
</div>
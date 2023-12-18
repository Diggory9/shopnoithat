<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">User</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/user/add" class="btn btn-primary rounded">Create</a>
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
                    <th class="col">Khóa</th>

                </tr>
            </thead>
            <tbody>
                <?php
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
                        <td>
                            <?php if ($value->status == 0): ?>
                                <a href="#lockModal<?php echo $value->user_id ?>" data-bs-toggle="modal"
                                data-bs-target="#lockModal<?php echo $value->user_id ?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="khóa"><i class="fa-solid fa-lock"></i></a>
                            <div class="modal fade" id="lockModal<?php echo $value->user_id ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Bạn muốn khóa người dùng:  <?php echo $value->user_firstname." ".$value->user_lastname ?> </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Bạn có chắc khóa người dùng này <?php echo $value->user_firstname ." ".$value->user_lastname?></h4>
                                            <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                hiện!. </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="/admin/user/lock?id=<?php echo $value->user_id ?>"
                                                class="btn btn-primary">Khóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                                <a href="#unLockModal<?php echo $value->user_id ?>" data-bs-toggle="modal"
                                data-bs-target="#unLockModal<?php echo $value->user_id ?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="mở khóa"><i class="fa-solid fa-unlock"></i></a>
                            <div class="modal fade" id="unLockModal<?php echo $value->user_id ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Bạn muốn khóa người dùng:  <?php echo $value->user_firstname." ".$value->user_lastname ?> </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Bạn có chắc khóa người dùng này <?php echo $value->user_firstname ." ".$value->user_lastname?></h4>
                                            <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                hiện!. </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="/admin/user/lock?id=<?php echo $value->user_id ?>"
                                                class="btn btn-primary">Khóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
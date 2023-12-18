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
                    <th class="col">Email</th>
                    <th class="col">First name</th>
                    <th class="col">Last name</th>
                    <th class="col">Phone</th>
                    <th class="col">Address</th>
                    <th class="col">Password</th>
                    <th class="col">Status</th>
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
                        <td><?php echo $value->user_email ?></td>
                        <td><?php echo $value->user_firstname ?></td>
                        <td><?php echo $value->user_lastname ?></td>
                        <td><?php echo $value->user_phone?></td>
                        <td><?php echo $value->user_address?></td>
                        <td><?php echo $value->user_password?></td>
                        <td><?php echo $value->status?></td>
                        <td>
                            <a href="/admin/user/edit?id=<?php echo $value->user_id ?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="edit user"><i
                                    class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                            <a href="#deleteModal<?php echo $value->user_id ?>" data-bs-toggle="modal"
                                data-bs-target="#deleteModal<?php echo $value->user_id ?>" class="link-underline btn btn-primary btn-sm rounded"
                                title="remove user"><i class="fa-solid fa-trash"></i></a>
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

                ?>
            </tbody>
        </table>
    </div>
</div>
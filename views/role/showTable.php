<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">Role</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/role/add" class="btn btn-primary rounded">Create</a>
        </div>
    </div>

    <div class="card">
        <form action="/admin/role" method="post"></form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Mã</th>
                    <th class="col">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($roles as $value)
                {
                    ?>
                    <tr>
                        <td>1</td>
                        
                        <td><?php echo $value->role_id ?></td>
                        <td><?php echo $value->role_name ?></td>
                        <td>
                            <a href="/admin/role/edit?id=<?php echo $value->role_id ?>"
                                class="link-underline btn btn-primary btn-sm rounded" title="edit role"><i
                                    class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                            <a href="#deleteModal<?php echo $value->role_id ?>" data-bs-toggle="modal"
                                data-bs-target="#deleteModal<?php echo $value->role_id ?>" class="link-underline btn btn-primary btn-sm rounded"
                                title="remove role"><i class="fa-solid fa-trash"></i></a>
                            <div class="modal fade" id="deleteModal<?php echo $value->role_id ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Xóa role  <?php echo $value->role_name ?> </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Bạn có chắc xóa role  <?php echo $value->role_name ?></h4>
                                            <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                hiện!. </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a href="/admin/role/remove?id=<?php echo $value->role_id ?>"
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
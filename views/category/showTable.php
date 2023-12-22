


<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">Danh mục</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/category/add" class="btn btn-primary rounded">Create</a>
        </div>
        <div class="col-md-5 order-md-2 mb-8">

            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 w-100" method="get" action="/admin/category">
                        <div class="input-group">
                            <input class="form-control" type="text" name="category_id" placeholder="Tìm kiếm theo mã danh mục" aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $id ?? '' ?>" />
                            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>
                
            </ul>
        </div>
    </div>

    <div class="card">
        <form action="/admin/category" method="post"></form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">#</th>
                    <th class="col">Mã</th>
                    <th class="col">Danh mục</th>

                    <th class="col">Mô tả</th>
                    <th class="col">Thao tác</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($categoris[0]) ){
                    foreach ($categoris as $value) {
                        ?>
                            <tr>
                                <td>1</td>
        
                                <td><?php echo $value->category_id ?></td>
                                <td><?php echo $value->category_name ?></td>
        
                                <td>
                                    <p style="width:600px"><?php echo $value->category_description ?> </p>
                                </td>
                                <td>
                                    <a href="/admin/category/edit?id=<?php echo $value->category_id ?>" class="link-underline btn btn-primary btn-sm rounded" title="edit category"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;
                                    <a href="#deleteModal<?php echo $value->category_id ?>" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $value->category_id ?>" class="link-underline btn btn-primary btn-sm rounded" title="remove category"><i class="fa-solid fa-trash"></i></a>
                                    <div class="modal fade" id="deleteModal<?php echo $value->category_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
        
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Xóa danh mục <?php echo $value->category_name ?> </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Bạn có chắc xóa danh mục <?php echo $value->category_name ?></h4>
                                                    <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực
                                                        hiện!. </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="/admin/category/remove?id=<?php echo $value->category_id ?>" class="btn btn-primary">Thực hiện xóa</a>
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
                    echo "Không tìm thấy danh mục";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
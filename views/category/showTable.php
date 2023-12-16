<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-6">
            <h2 class="text-primary">Category</h2>
        </div>
        <div class="col-6 text-end">
            <a href="/admin/category/add" class="btn btn-primary rounded">Create</a>
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
                    foreach($categoris as $value)
                    {
                        ?>
                            <tr>
                                <td>1</td>
                                <td><?php echo $value->category_id?></td>
                                <td><?php echo $value->category_name?></td>
                                <td><?php echo $value->category_description?></td>
                                <td>
                                    <a class="link-underline btn btn-primary btn-sm rounded" title="edit category"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp; 
                                    <a class="link-underline btn btn-primary btn-sm rounded" title="remove category"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                    }
                
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center align-items-center g-2 mt-5">
        <h2>Thêm sản phẩm</h2>
    </div>
    <form action="add" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Tên sản phẩm</label>
            <input type="text" id="form2Example1" name="product_name"
                class="form-control  <?php echo $model->hasError('product_name') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->product_name) ? $model->product_name : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('product_name'); ?>
            </div>
        </div>
        <div class="form-row row">
            <div class="form-group mb-4 col-md-4">
                <label class="form-label" for="form2Example1">Giá</label>
                <input type="text" id="form2Example1" name="product_price"
                    class="form-control  <?php echo $model->hasError('product_price') ? 'is-invalid' : ''; ?>"
                    value="<?php echo !empty($model->product_price) ? $model->product_price : ''; ?>" />
                <div class="invalid-feedback">
                    <?php echo $model->getFirstError('product_price'); ?>
                </div>
            </div>
            <div class="form-group mb-4 col-md-4">
                <label class="form-label" for="form2Example1">Số lượng</label>
                <input type="text" id="form2Example1" name="product_stock_quantity"
                    class="form-control  <?php echo $model->hasError('product_stock_quantity') ? 'is-invalid' : ''; ?>"
                    value="<?php echo !empty($model->product_stock_quantity) ? $model->product_stock_quantity : ''; ?>" />
                <div class="invalid-feedback">
                    <?php echo $model->getFirstError('product_stock_quantity'); ?>
                </div>
            </div>

        </div>
        <div class="form-row row">

            <div class="form-group col-md-4">
                <label for="inputState">Danh mục</label>
                <select id="inputState" class="form-control" name="category_id">
                    <?php
                    // duyệt for
                    foreach ($categoris as $value)
                    {
                        ?>
                         <option value="<?php echo $value->category_id?>"><?php echo $value->category_name?></option>
                        <?php
                    }
                    ?>

                </select>   
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Nhà cung cấp</label>
                <select id="inputState" class="form-control" name="supplier_id">
                    <?php
                    // duyệt for
                    foreach ($suppliers as $value)
                    {
                        ?>
                         <option value="<?php echo $value->supplier_id?>"><?php echo $value->supplier_name?></option>
                        <?php
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Mô tả sản phẩm</label>
            <textarea  name="product_des" class="form-control" <?php echo $model->hasError('product_des') ? 'is-invalid' : ''; ?>">
            <?php echo !empty($model->product_des) ? $model->product_des : ''; ?>
            </textarea>
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('product_des'); ?>
            </div>
        </div>
        <div class="form-outline mb-4 col-md-5">
            <input type="file" class="custom-file-input" id="customFile" name="images[]" multiple accept="image/*">
            <label class="custom-file-label" for="customFile">Choose file</label>

        </div>
        <div class="fom-outline mb-4">
            <input class="btn btn-primary rounded" type="submit" value="Submit" />
            <a class="btn btn-primary rounded" href="/admin/product">Trở về</a>
        </div>
    </form>
</div>
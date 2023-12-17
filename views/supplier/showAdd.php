<div class="container">
    <div class="row justify-content-center align-items-center g-2 mt-5">
        <h2>Thêm nhà cung cấp</h2>
    </div>
    <form action="add" method="post">
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Tên nhà cung cấp</label>
            <input type="text" id="form2Example1" name="supplier_name"
                class="form-control  <?php echo $model->hasError('supplier_name') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->supplier_name) ? $model->supplier_name : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('supplier_name'); ?>
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email</label>
            <input type="text" id="form2Example1" name="contact_email"
                class="form-control  <?php echo $model->hasError('contact_email') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->contact_email) ? $model->contact_email : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('contact_email'); ?>
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Số điện thoại</label>
            <input type="text" id="form2Example1" name="supplier_phone"
                class="form-control  <?php echo $model->hasError('supplier_phone') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->supplier_phone) ? $model->supplier_phone : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('supplier_phone'); ?>
            </div>
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Địa chỉ</label>
            <input type="text" id="form2Example1" name="supplier_address"
                class="form-control  <?php echo $model->hasError('supplier_address') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->supplier_address) ? $model->supplier_address : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('supplier_address'); ?>
            </div>
        </div>

        <div class="fom-outline mb-4">
            <input class="btn btn-primary rounded" type="submit" value="Submit" />

        </div>
    </form>
</div>
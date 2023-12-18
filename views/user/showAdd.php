<div class="container">
    <div class="row justify-content-center align-items-center g-2 mt-5">
        <h2>Thêm user</h2>
    </div>
    <form action="add" method="post" class="col-12">
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">Email</label>
            <input type="text" id="form2Example1" name="user_email"
                class="form-control  <?php echo $model->hasError('user_email') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->user_email) ? $model->user_email : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('user_email'); ?>
            </div>
        </div>
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">First name</label>
            <input type="text" id="form2Example1" name="user_firstname"
                class="form-control  <?php echo $model->hasError('user_firstname') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->user_firstname) ? $model->user_firstname : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('user_firstname'); ?>
            </div>
        </div>
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">Last name</label>
            <input type="text" id="form2Example1" name="user_lastname"
                class="form-control  <?php echo $model->hasError('user_lastname') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->user_lastname) ? $model->user_lastname : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('user_lastname'); ?>
            </div>
        </div>
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">Phone</label>
            <input type="text" id="form2Example1" name="user_phone"
                class="form-control  <?php echo $model->hasError('user_phone') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->user_phone) ? $model->user_phone : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('user_phone'); ?>
            </div>
        </div>
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">Address</label>
            <input type="text" id="form2Example1" name="user_address"
                class="form-control  <?php echo $model->hasError('user_address') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->user_address) ? $model->user_address : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('user_address'); ?>
            </div>
        </div>
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">Password</label>
            <input type="text" id="form2Example1" name="user_password"
                class="form-control  <?php echo $model->hasError('user_password') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->user_password) ? $model->user_password : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('user_password'); ?>
            </div>
        </div>
        <div class="form-outline mb-2 col-4">
            <label class="form-label" for="form2Example1">Status</label>
            <input type="text" id="form2Example1" name="status"
                class="form-control  <?php echo $model->hasError('status') ? 'is-invalid' : ''; ?>"
                value="<?php echo !empty($model->status) ? $model->status : ''; ?>" />
            <div class="invalid-feedback">
                <?php echo $model->getFirstError('status'); ?>
            </div>
        </div>

        <div class="fom-outline mb-4">
            <input class="btn btn-primary rounded" type="submit" value="Submit" />

        </div>
    </form>
</div>
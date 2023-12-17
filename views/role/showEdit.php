<div class="container">
    <div class="row justify-content-center align-items-center g-2 mt-5">
        <h2>Role Edit</h2>
    </div>
    <form action="edit" method="post">
        <input name="role_id" value="<?php echo !empty($model->role_name) ? $model->role_id : ''; ?>" hidden />
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Role name</label>
        <input type="text" id="form2Example1" name="role_name"
          class="form-control  <?php echo $model->hasError('role_name') ? 'is-invalid' : ''; ?>"
          value="<?php echo !empty($model->role_name) ? $model->role_name : ''; ?>" />
        <div class="invalid-feedback">
          <?php echo $model->getFirstError('role_name'); ?>
        </div>
      </div>
      <div class="fom-outline mb-4">
        <input class="btn btn-primary rounded" type="submit" value="Submit"/>

      </div>
    </form>
</div>
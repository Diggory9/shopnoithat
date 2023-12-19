<div class="container">
    <div class="row justify-content-center align-items-center g-2 mt-5">
        <h2>Chỉnh sửa danh mục</h2>
    </div>
    <form action="edit" method="post">
        <input name="category_id" value="<?php echo !empty($model->category_name) ? $model->category_id : ''; ?>" hidden />
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Tên danh mục</label>
        <input type="text" id="form2Example1" name="category_name"
          class="form-control  <?php echo $model->hasError('category_name') ? 'is-invalid' : ''; ?>"
          value="<?php echo !empty($model->category_name) ? $model->category_name : ''; ?>" />
        <div class="invalid-feedback">
          <?php echo $model->getFirstError('category_name'); ?>
        </div>
      </div>
      <!-- Password input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Mô tả</label>
          <textarea name="category_description" id="" cols="1" class="form-control <?php echo $model->hasError('category_description') ? 'is-invalid' : ''; ?>">
          <?php echo !empty($model->category_description) ? $model->category_description : ''; ?></textarea>
        <div class="invalid-feedback">
          <?php echo $model->getFirstError('category_description'); ?>
        </div>
      </div>
      <div class="fom-outline mb-4">
        <input class="btn btn-primary rounded" type="submit" value="Submit"/>

      </div>
    </form>
</div>
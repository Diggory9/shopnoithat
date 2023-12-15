<div class="container">

  <div class="col">
    <div class="row-3">
      <!-- chen hinh -->
    </div>
    <div class="row-6">

      <div class=" w-200 p-4 d-flex justify-content-center pb-4 mt-2">
        <form action="/register" method="POST" class="w-200">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <div data-mdb-input-init class="form-outline">
                <label class="form-label" for="FirstName">First name</label>
                <input type="text" name="user_firstname" id="FirstName"
                  value="<?php echo !empty($model->user_firstname) ? $model->user_firstname : ''; ?>"
                  class="form-control <?php echo $model->hasError('user_firstname') ? 'is-invalid' : ''; ?>" />
                <div class="invalid-feedback">
                  <?php echo $model->getFirstError('user_firstname'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div data-mdb-input-init class="form-outline">
                <label class="form-label" for="LastName">Last name</label>
                <input type="text" name="user_lastname" id="LastName"
                  value="<?php echo !empty($model->user_lastname) ? $model->user_lastname : ''; ?>"
                  class="form-control <?php echo $model->hasError('user_lastname') ? 'is-invalid' : ''; ?>" />
                <div class="invalid-feedback">
                  <?php echo $model->getFirstError('user_lastname'); ?>
                </div>
              </div>
            </div>
          </div>
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" id="Email" name="user_email"
              value="<?php echo !empty($model->user_email) ? $model->user_email : ''; ?>"
              class="form-control <?php echo $model->hasError('user_email') ? 'is-invalid' : ''; ?>" />
            <div class="invalid-feedback">
              <?php echo $model->getFirstError('user_email'); ?>
            </div>
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="Password" name="user_password"
              value="<?php echo !empty($model->user_password) ? $model->user_password : ''; ?>"
              class="form-control <?php echo $model->hasError('user_password') ? 'is-invalid' : ''; ?> " />
            <div class="invalid-feedback">
              <?php echo $model->getFirstError('user_password'); ?>
            </div>
          </div>
          <!-- confirm password -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example4">Confirm password</label>
            <input type="password" id="ConfirmPassword" name="ConfirmPassword"
              value="<?php echo !empty($model->ConfirmPassword) ? $model->ConfirmPassword : ''; ?>"
              class="form-control <?php echo $model->hasError('ConfirmPassword') ? 'is-invalid' : ''; ?>  " />
            <div class="invalid-feedback">
              <?php echo $model->getFirstError('ConfirmPassword'); ?>
            </div>
          </div>

          <!-- Checkbox -->
          <div class="form-check d-flex justify-content-center mb-4">
            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
            <label class="form-check-label" for="form2Example33">
              Subscribe to our newsletter
            </label>
          </div>

          <!-- Submit button -->
          <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign up</button>

          <!-- Register buttons -->
          <div class="text-center">
            <p>or sign up with:</p>
            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
              <i class="fab fa-google"></i>
            </button>

            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>

            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
              <i class="fab fa-github"></i>
            </button>
          </div>
        </form>
      </div>


    </div>
    <div class="row-3">
      <!-- chen hinh -->

    </div>
  </div>





</div>
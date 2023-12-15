
<div class="container">
  <div class="w-100 p-4 d-flex justify-content-center pb-4 mt-2">
    <form action="/login" method="post">
      <!-- Email input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Email address</label>
        <input type="email" id="form2Example1" name="email"
          class="form-control  <?php echo $models->hasError('email') ? 'is-invalid' : ''; ?>"
          value="<?php echo !empty($models->email) ? $models->email : ''; ?>" />
        <div class="invalid-feedback">
          <?php echo $models->getFirstError('email'); ?>
        </div>
      </div>

      <!-- Password input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Password</label>
        <input type="password" id="form2Example2" name="password"
          class="form-control  <?php echo $models->hasError('password') ? 'is-invalid' : ''; ?>"
          value="<?php echo !empty($models->password) ? $models->password : ''; ?>" />
        <div class="invalid-feedback">
          <?php echo $models->getFirstError('password'); ?>
        </div>
      </div>

      <!-- 2 column grid layout for inline styling -->
      <div class="row mb-4">
        <div class="col d-flex justify-content-center">
          <!-- Checkbox -->
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
            <label class="form-check-label" for="form2Example31"> Remember me </label>
          </div>
        </div>

        <div class="col">
          <!-- Simple link -->
          <a href="#!">Forgot password?</a>
        </div>
      </div>

      <!-- Submit button -->
      <input type="submit" class="btn btn-primary btn-block mb-4 w-100" value="Sign in" />

      <!-- Register buttons -->
      <div class="text-center">
        <p>Not a member? <a href="#!">Register</a></p>
        <p>or sign up with:</p>
        <button type="button" class="btn btn-link btn-floating mx-1">
          <i class="fab fa-facebook-f"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
          <i class="fab fa-google"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
          <i class="fab fa-twitter"></i>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-1">
          <i class="fab fa-github"></i>
        </button>
      </div>
    </form>
  </div>
  <!-- Pills navs -->

  <!-- Pills content -->
</div>
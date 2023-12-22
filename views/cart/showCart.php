<section class="h-100 h-custom" style="background-color: #aeaeae;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"></h6>
                  </div>
                  <hr class="my-4">
                  <?php
                  if (empty($_SESSION['cart']))
                  {
                    echo '<h2>Bạn chưa có sản phẩm nào trong giỏ hàng</h2>';

                    echo ' <h6 class="mb-0"><a href="/product" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back
                      to shop</a></h6>';
                  } else
                  {


                    $total = 0;
                    foreach ($_SESSION['cart'] as $key => $value): ?>
                      <div class="row mb-4 d-flex justify-content-between align-items-center">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <img src="<?php echo BASE__URL . 'images/uploads/' . $value['img'] ?>" class="img-fluid rounded-3"
                            alt="Cotton T-shirt">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                          <h6 class="text-black mb-0"><?php echo $value['product_name'] ?></h6>
                        </div>

                        <form action="cart-update" method="get" class="col-md-4 col-lg-3 col-xl-2 d-flex">
                          <input type="hidden" name="id" value=<?php echo $key ?>>

                          <button class="btn btn-link px-1 mx-1" type="submit"
                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            <i class="fas fa-minus"></i>
                          </button>

                          <input id="form1" min="0" name="quantity" value="<?php echo $value['sl'] ?>" type="number"
                            class="form-control form-control-sm" />

                          <button class="btn btn-link  px-1 mx-1" type="submit"
                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            <i class="fas fa-plus"></i>
                          </button>

                        </form>

                        <div class="col-md-2 col-lg-2 col-xl-2">
                          <h6 class="mb-0"><?php
                          $total += $value['sl'] * $value['product_price'];
                          $priceFormat = number_format($value['sl'] * $value['product_price'], 0, ',');
                          echo $priceFormat . ' đ' ?></h6>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                          <a href="/cart-remove?id=<?php echo $key; ?>" class="text-muted"><i class="fas fa-times"></i></a>
                        </div>
                      </div>

                      <hr class="my-4">
                    <?php endforeach; ?>
                    <div class="pt-5">
                      <h6 class="mb-0"><a href="/product" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back
                          to shop</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 bg-grey">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4">
                      <h5 class="text-uppercase">
                        <?php echo !empty($_SESSION['cart']) ? count($_SESSION['cart']) . " items" : 0 . ' item'; ?></h5>
                      <h5><?php
                      $totalFormat = number_format($total, 0, ',');
                      echo $totalFormat . ' đ' ?>

                      </h5>
                    </div>
                    <h5 class="text-uppercase mb-3">Shipping</h5>

                      
                    <div class="mb-4 pb-2">
                      <select class="select">
                        <option value="1">Ship hàng tận nơi 500.000 đ</option>
                      </select>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5><?php $totalFormat = number_format($total + 500000, 0, ',');
                      echo $totalFormat . ' đ' ?></h5>
                    </div>
                    <a href="/checkout">
                      <button type="button" class="btn btn-dark btn-block btn-lg"
                        data-mdb-ripple-color="dark">Checkout</button>
                    </a>

                  </div>
                </div>


                <?php
                  }

                  ?>
            </div>
          </div>

          
        </div>
      </div>
    </div>
  </div>
</section>
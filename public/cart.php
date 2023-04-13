<?php
  include "../partials/header.php";
  $total=0;
  if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
  	session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  }

  if(isset($_SESSION['carts'])){
    $count = count($_SESSION['carts']);
  }
 
?>

<section class="h-100 h-custom" style="background-color: #00c8ff;">
  
  <div class="container py-5 h-100">
    <div class="text-left text-primary font-weight-bold col-2 pb-3">
        <h5 class="mb-0"><a href="index.php" class=" text-white "><i
          class="fas fa-long-arrow-alt-left me-2 text-white"></i>Về cửa hàng</a>
        </h5>
    </div>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-2">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Giỏ Hàng</h1>
                    <h6 class="mb-0 text-muted"><?= $count?> sản phẩm</h6>
                  </div>
                  <hr class="my-4">
                  <?php  if(isset($_SESSION['carts'])){
                          foreach($_SESSION['carts'] as $cart){
                            $total+=($cart['so_luong']*$cart['gia']);
                  ?>
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="uploads/<?=$cart['hinh'] ?>"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted"><?=$cart['ten'] ?></h6>

                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2" >
                        <a href="<?=BASE_URL_PATH."themgiohang.php?tru=".$cart['id']?>"><i class="fas fa-minus"></i></a>
                      </button>

                      <input id="form1" min="0"  value="<?=$cart['so_luong']?>" type=""
                        class="form-control form-control-sm" />

                      <button class="btn btn-link px-2">
                        <a href="<?=BASE_URL_PATH."themgiohang.php?cong=".$cart['id']?>"><i class="fas fa-plus"></i></a>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0"><?=$cart['gia']*$cart['so_luong']?></h6>
                      <h6 class="mb-0">VNĐ</h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <a href="<?=BASE_URL_PATH."themgiohang.php?xoa=".$cart['id']?>" class="text-muted"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                  <?php
                        }
                      }else{

                      }
                    ?>
                  
                  <hr class="my-4">

                  
                </div>
              </div>
              <div class="col-lg-4 bg-grey border-left">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Hóa Đơn</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Tổng tiền</h5>
                    <h5><?=$total ?>VNĐ</h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Phí Vận Chuyển</h5>

                  <div class="mb-4 pb-2">
                    <select class="select">
                      <option value="1">Standard-Delivery-50.000VNĐ</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                    </select>
                  </div>

                  <h5 class="text-uppercase mb-3">Mã Khuyến Mãi</h5>

                  <div class="mb-5">
                    <div class="form-outline">
                      <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Nhập mã khuyến mãi</label>
                    </div>
                  </div>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Thanh Toán:</h5>
                    <h5><?php if($total > 0){
                      echo $total+50000;
                    }else{
                      echo $total;
                    }
                    ?>VNĐ</h5>
                  </div>
                  <form  action="themgiohang.php?thanhtoan=1" method="post">
                    <button type="submit" id="hoan-tat-dh" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Hoàn Tất Đặt Hàng</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    $("#hoan-tat-dh").click(function(event) {
      event.preventDefault(); 
      alert("Đặt hàng thành công!");
      $(this).closest("form").submit(); 
    });
  });
</script>


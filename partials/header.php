<?php
require_once '../bootstrap.php'; // tu dong nap lop,khong gian ten,dbconnect
use CT275\Labs\khach_hang;
use CT275\Labs\admin;

if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
  	session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
}

include __DIR__ . '/../function.php';

// $khach_hang= new khach_hang($PDO);

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/css_phone.css">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/css_header.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
       <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <style>

</style>

</head>
    <body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a href="#" class="navbar-brand">Shop<b>Phone</b></a>  		
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<a href="#" class="nav-item nav-link">Trang chủ</a>
			<a href="#" class="nav-item nav-link">Về chúng tôi</a>			
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Điện thoại</a>
				<div class="dropdown-menu">					
					<a href="#" class="dropdown-item">Iphone</a>
					<a href="#" class="dropdown-item">Sang Sung</a>
					<a href="#" class="dropdown-item">Oppo</a>
					<a href="#" class="dropdown-item">Khác</a>
                </div>
            </div>
		</div>
		<form class="navbar-form form-inline">
			<div class="input-group search-box">								
				<input type="text" id="search" class="form-control" placeholder="Tên sản phẩm...">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="material-icons">&#xE8B6;</i>
					</span>
				</div>
			</div>
		</form>
    
	<div class="navbar-nav ml-auto action-buttons">
    <form class="nav-form form-inline mr-2">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill"></i>
                        Cart
                        <span class="badge bg-dark text-white rounded-pill">4</span>
                    </button>
    </form>
	<?php if ((!isset($_SESSION['khach_hang_formdb']))): ?>
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4">Đăng Nhập</a>
                <div class="dropdown-menu action-form">
					<form  action="<?= BASE_URL_PATH . 'dangnhap.php' ?>"  method="post">
						<div class="form-group">
							<input name ="email" type="text" class="form-control" placeholder="Tài Khoản" required="required">
						</div>
						<div class="form-group">
							<input name ="mat_khau" type="password" class="form-control" placeholder="Mật khẩu" required="required">
						</div>
						<input type="submit" class="btn btn-primary btn-block" value="Đăng Nhập">
						<div class="text-center mt-2">
							<a href="#">Quên mật khẩu?</a>
						</div>
					</form>
                </div>
			</div>
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Đăng ký</a>
                <div class="dropdown-menu action-form">
					<form action="<?= BASE_URL_PATH . 'dangky.php' ?>" method="post">
						<p class="hint-text">Điền thông tin để đăng ký</p>
						<div class="form-group">
							<input name ="ten" type="text" class="form-control" placeholder="Họ và tên" required="required">
						</div>
						<div class="form-group">
							<input name ="email" type="email" class="form-control" placeholder="Tên tài khoản" required="required">
						</div>
						<div class="form-group">
							<input name ="dia_chi" type="text" class="form-control" placeholder="Địa chỉ" required="required">
						</div>
						<div class="form-group">
							<input name ="so_dien_thoai" type="number" class="form-control" placeholder="Số điện thoại" required="required">
						</div>
						<div class="form-group">
							<input name="mat_khau" type="password" class="form-control" placeholder="Mật khẩu" required="required">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Nhập lại mật khẩu" required="required">
						</div>
						<div class="form-group">
							<label class="form-check-label"><input type="checkbox" required="required"> Chấp nhận <a href="#">Điều Khoản &amp; Chính Sách</a></label>
						</div>
						<input type="submit" class="btn btn-primary btn-block" value="Đăng Ký">
					</form>
				</div>
			</div>
			<?php endif ?>
			<?php if (isset($_SESSION['khach_hang_formdb'])) : ?>
				<form class="nav-form form-inline mr-2" action="<?= BASE_URL_PATH . 'dangxuat.php' ?>" method="post">
				<div class="btn-group">
                <button type="button" class="btn btn-danger">Logout User</button>
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-caret-down-fill"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php"><?php echo  $_SESSION['ten'] ?></a>
                    <div class="dropdown-divider"></div>
                    <input type="submit" class="btn btn-danger btn-block" value="Đăng Xuất">
                </div>
          	  </div>
    		</form>
          <?php endif ?>
        </div>
	</div>
</nav>
</body>
<script>
// Prevent dropdown menu from closing when click inside the form
$(document).on("click", ".action-buttons .dropdown-menu", function(e){
	e.stopPropagation();
});
</script>

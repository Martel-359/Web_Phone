<?php
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
    session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  }
// require_once '../bootstrap.php';

use CT275\Labs\khach_hang;
include '../partials/header.php';
$errors = [];
$dangnhap=false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$khachhang = new khach_hang($PDO);
	$khachhang->fill($_POST);
	if ($khachhang->validate()) {
		$khachhang->save();
		$dangnhap=true;
		
	}
	$errors = $khachhang->getValidationErrors();
}



?>
<main>
	<section>
		<?php if($dangnhap=true) : ?>
			<div style="height: 200px; margin-top:200px" class="text-center">
			<h3><p>Chúc mừng bạn đã đăng ký thành công</p></h3>
			<a href="index.php"> <button class="btn btn-primary">Đi đến trang chủ</button></a>
			<a href="sanpham.php"> <button class="btn btn-primary">Đi đến trang sản phẩm</button></a>

			</div>

		<?php endif ?>
		<?php if($dangnhap=false) : ?>
			<div style="height: 200px;">
			<p> Bạn đã đăng ký không thành công</p>
			<a href="index.php"> <button>Quay về trang chủ</button></a>

			</div>

		<?php endif ?>
	</section>
</main>

<?php include('../partials/footer.php') ?>


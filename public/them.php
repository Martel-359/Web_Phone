<?php
require_once '../bootstrap.php';
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
	session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  }

  
use CT275\Labs\loai_hang_hoa;
use CT275\Labs\hang_hoa;

$loai_hang_hoa = new loai_hang_hoa($PDO);
$loai_hang_hoas = $loai_hang_hoa->all();

if(!isset($_SESSION['admin_formdb'])){
    echo('<div style="height: 300px; margin-top:150px;margin:" class="text-center">
    <h3><p>Bạn không có quyền truy xuất trang này</p></h3>
    <a href="index.php"> <button class="btn btn-primary">Đi đến trang chủ</button></a>
    <a href="hanghoa.php"> <button class="btn btn-primary">Đi đến trang sản phẩm</button></a>');
    exit();

}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$hang_hoa = new hang_hoa($PDO);
	$hang_hoa->fill($_POST, $_FILES); // $_FILE lấy hình ảnh.
	if ($hang_hoa->validate()) {
		$hang_hoa->save() && redirect('admin.php');
	}
	$errors = $hang_hoa->getValidationErrors();
}
include '../partials/header.php';
?>
<main class="container">
	<section class="nav--product row ">
	<div class=" col-7 mt-4 mb-4">
			<h7><a  style ="text-decoration : none;" class="text-black font-weight-bold" href="index.php">Trang chủ</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i> <a  style ="text-decoration : none;" class="text-black font-weight-bold" href="admin.php">Admin</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i> <a style ="text-decoration : none;" class="text-secondary" href="">Thêm sản phẩm</a></h7>
		</div>
		<div class=" col-12">
			<h5 class="text-center mt-4 display-6 font-weight-bold"><div class="text-black" href="">Thêm sản phẩm</div> </h5>
		</div>
	</section>
	<section class="row pb-5">
		<div class="col-3"></div>

		<form name="frm" id="frm" action="" method="post" class="col-md-6 col-md-offset-3 was-validated" enctype="multipart/form-data">
			<!-- Name -->
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="ten_hang_hoa" >Tên sản phẩm</label>
				<input type="text" name="ten_hang_hoa" class="form-control is-invalid" maxlen="255" id="ten_hang_hoa" placeholder="Nhập tên sản phẩm..." value="<?= isset($_POST['ten_hang_hoa']) ? htmlspecialchars($_POST['ten_hang_hoa']) : '' ?>" required>
				<?php if (isset($errors['ten_hang_hoa'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['ten_hang_hoa']) ?>
					</div>
				<?php endif ?>
			</div>

			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="gia">Giá sản phẩm</label>
				<input type="number" min="0" name="gia" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập giá sản phẩm..." value="<?= isset($_POST['gia']) ? htmlspecialchars($_POST['gia']) : '' ?>" required>

				<?php if (isset($errors['gia'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['gia']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="ten">Hình ảnh</label>
				<input type="file" name="hinh" class="form-control is-invalid" maxlen="255" id="name" placeholder="Nhập hình ảnh sản phẩm..." value="" required>

				<?php if (isset($errors['hinh'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['hinh']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="mo_ta" class="form-label">Mô tả sản phẩm</label>
				<input type="text" name="mo_ta" class="form-control is-invalid" maxlen="255" id="mo_ta" placeholder="Nhập mô tả sản phẩm..." value="<?= isset($_POST['mo_ta']) ? htmlspecialchars($_POST['mo_ta']) : '' ?>" required>
				<?php if (isset($errors['mo_ta'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['mo_ta']) ?>
					</div>
				<?php endif ?>
			</div>
			
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="loai_hang_hoa">Loại sản phẩm</label>
				<select name="id_loai" class="form-control">
					<?php foreach ($loai_hang_hoas as $loai_hang_hoa) : ?>
							<option value=" <?= $loai_hang_hoa->id ?>"> <?= $loai_hang_hoa->ten_loai ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="so_luong_hang">Số lượng</label>

				<input type="number" min="1" name="so_luong_hang" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập số lượng sản phẩm... " value="<?= isset($_POST['so_luong_hang']) ? htmlspecialchars($_POST['so_luong_hang']) : '' ?>" required>
				<?php if (isset($errors['so_luong_hang'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['so_luong_hang']) ?></strong>
					</div>
				<?php endif ?>
			</div>

			<!-- Submit -->
			<br>
			<button type="submit" name="submit" id="submit" class="btn btn-primary">Lưu sản phẩm</button>
		</form>
	</section>
</main>

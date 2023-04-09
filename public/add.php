<?php
require_once '../bootstrap.php';
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
	session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  }
use CT275\Labs\loai_hang_hoa;
use CT275\Labs\nhanvien;
use CT275\Labs\hang_hoa;
$loai_hang_hoa = new loai_hang_hoa($PDO);
$loai_hang_hoas = $loai_hang_hoa->all();

// $nhanvien = new nhanvien($PDO);
//$nhanvien->find($_SESSION['id_user']);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$hang_hoa = new hang_hoa($PDO);
	$hang_hoa->fill($_POST, $_FILES); // $_FILE lấy hình ảnh.
	if ($hang_hoa->validate()) {
		$hang_hoa->save() && redirect('nhanvien.php');
	}
	$errors = $hang_hoa->getValidationErrors();
}
include '../partials/header.php';
?>

<main class="container">
	<section class="nav--product row ">
		<div class=" col-7">
			<h5><a class="text-black" href="index.php">Trang chủ</a> / <a class="text-black" href="">Thêm sản phẩm</a> </h5>
		</div>
	</section>
	<section class="row">
		<div class="col-3"></div>

		<form name="frm" id="frm" action="" method="post" class="col-md-6 col-md-offset-3 was-validated" enctype="multipart/form-data">
			<!-- Name -->
			<div class="form-group">
				<label for="ten" class="form-label">Tên sản phẩm</label>
				<input type="text" name="ten" class="form-control is-invalid" maxlen="255" id="ten" placeholder="Nhập tên sản phẩm..." value="<?= isset($_POST['ten']) ? htmlspecialchars($_POST['ten']) : '' ?>" required>
				<?php if (isset($errors['ten'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['ten']) ?>
					</div>
				<?php endif ?>
			</div>

			<div class="form-group">
				<label for="gia">Giá sẩn phẩm</label>
				<input type="number" min="0" name="gia" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập giá sản phẩm..." value="<?= isset($_POST['gia']) ? htmlspecialchars($_POST['gia']) : '' ?>" required>

				<?php if (isset($errors['gia'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['gia']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label for="ten">Hình ảnh</label>
				<input type="file" name="hinhanh" class="form-control is-invalid" maxlen="255" id="name" placeholder="Nhập hình ảnh sản phẩm..." value="" required>

				<?php if (isset($errors['hinhanh'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['hinhanh']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				
				<input hidden type="number" name="id_nv" class="form-control is-invalid " maxlen="255" id="name" placeholder="Nhập hình ảnh sản phẩm..." value="<?= $_SESSION['id_user']?>" required>
			</div>
			<div class="form-group">
				<label for="gioitinh_hang_hoa">Giới tính sản phẩm</label>
				<select name="gioitinh_hang_hoa" class="form-control">
					<option value="1"> Nam</option>
					<option value="0"> Nữ</option>
				</select>
			</div>
			<div class="form-group">
				<label for="loai_hang_hoa">Loại sản phẩm</label>
				<select name="id_loai" class="form-control">
					<?php foreach ($loai_hang_hoas as $loai_hang_hoa) : ?>
						<option value=" <?= $loai_hang_hoa->id ?>"> <?= $loai_hang_hoa->ten_loai ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label for="soluong">Số lượng</label>

				<input type="number" min="1" name="soluong" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập số lượng sản phẩm... " value="<?= isset($_POST['soluong']) ? htmlspecialchars($_POST['soluong']) : '' ?>" required>
				<?php if (isset($errors['soluong'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['soluong']) ?></strong>
					</div>
				<?php endif ?>
			</div>

			<!-- Submit -->
			<br>
			<button type="submit" name="submit" id="submit" class="btn btn-primary">Lưu sản phẩm</button>
		</form>
	</section>
</main>
<?php include('../partials/footer.php') ?>
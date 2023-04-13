<?php
require_once '../bootstrap.php'; // tu dong nap lop,khong gian ten,dbconnect
use CT275\Labs\loai_hang_hoa;
use CT275\Labs\hang_hoa;
$hang_hoa = new hang_hoa($PDO);
$loai_hang_hoa = new loai_hang_hoa($PDO);
$loai_hang_hoas = $loai_hang_hoa->all();

$id = isset($_REQUEST['id']) ?
	filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
$hang_hoa->find($id);
//$loai_loai_hang_hoa ->find($id);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($hang_hoa->update($_POST, $_FILES)) {
		// Cập nhật dữ liệu thành công
		redirect('admin.php');
	}
	// Cập nhật dữ liệu không thành công
	$errors = $hang_hoa->getValidationErrors();
}
include '../partials/header.php';
?>
<main class="container">
	<section class="nav--product row ">
		<div class=" col-7 mt-4 mb-4">
			<h7><a  style ="text-decoration : none;" class="text-black font-weight-bold" href="index.php">Trang chủ</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i> <a  style ="text-decoration : none;" class="text-black font-weight-bold" href="admin.php">Admin</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i><a  style ="text-decoration : none;" class="text-secondary" href="">Chỉnh sửa sản phẩm</a></h7>
		</div>
		<div class=" col-12">
			<h5 class="text-center mt-4 display-6 font-weight-bold"><div class="text-black" href="">Chỉnh sản phẩm <span class="text-warning"><?=$hang_hoa->ten_hang_hoa ?></span></div> </h5>
		</div>
	</section>
	<section class="row pb-5">
		<div class="col-3"></div>

		<form name="frm" id="frm" action="" method="post" class="col-md-6 col-md-offset-3 was-validated" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= htmlspecialchars($hang_hoa->getId()) ?>">
			<input type="hidden" name="ten_loai" value="<?= htmlspecialchars($hang_hoa->ten_loai) ?>">
			<!-- Name -->
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="ten_hang_hoa" >Tên sản phẩm</label>
				<input type="text" name="ten_hang_hoa" class="form-control is-invalid" maxlen="255" id="ten_hang_hoa" placeholder="Nhập tên sản phẩm..." value="<?= htmlspecialchars($hang_hoa->ten_hang_hoa) ?>" required>
				<?php if (isset($errors['ten_hang_hoa'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['ten_hang_hoa']) ?>
					</div>
				<?php endif ?>
			</div>

			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="gia">Giá sản phẩm</label>
				<input type="number" min="0" name="gia" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập giá sản phẩm..." value="<?= htmlspecialchars($hang_hoa->gia) ?>" required>	
				<?php if (isset($errors['gia'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['gia']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="ten">Hình ảnh</label>
				<input type="file" name="hinh" class="form-control is-invalid" maxlen="255" id="name" placeholder="Nhập hình ảnh sản phẩm..." value="adad.pdf" required >
				<script>
					// Get a reference to our file input
					const fileInput = document.querySelector('input[type="file"]');

					// Create a new File object
					const myFile = new File(['Hello World!'], '<?= $hang_hoa->hinh ?>', {
						type: 'text/plain',
						lastModified: new Date(),
					});

					// Now let's create a DataTransfer to get a FileList
					const dataTransfer = new DataTransfer();
					dataTransfer.items.add(myFile);
					fileInput.files = dataTransfer.files;
				</script>
				<?php if (isset($errors['hinh'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['hinh']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="mo_ta" class="form-label">Mô tả sản phẩm</label>
				<input type="text" name="mo_ta" class="form-control is-invalid" maxlen="255" id="mo_ta" placeholder="Nhập mô tả sản phẩm..." value="<?= htmlspecialchars($hang_hoa->mo_ta) ?>" required>
				<?php if (isset($errors['mo_ta'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['mo_ta']) ?>
					</div>
				<?php endif ?>
			</div>
			
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="loai_hang_hoa">Loại sản phẩm</label>
				<select name="id_loai" class="form-control">
					<option value=" <?= $hang_hoa->id_loai ?>" selected> <?php  if ($hang_hoa->id_loai == 1) {
                                       echo ("Laptop");
                                   } if ($hang_hoa->id_loai == 2) {
                                       echo ("SamSung");
                                   } else if ($hang_hoa->id_loai == 3) {
                                       echo ("Iphone");
                                   } ?></option>
					<?php foreach ($loai_hang_hoas as $loai_hang_hoa) : ?>
						<?php if ($hang_hoa->id_loai != $loai_hang_hoa->id) : ?>
							<option value=" <?= $loai_hang_hoa->id ?>"> <?= $loai_hang_hoa->ten_loai ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="so_luong_hang">Số lượng</label>

				<input type="number" min="1" name="so_luong_hang" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập số lượng sản phẩm... " value="<?= htmlspecialchars($hang_hoa->so_luong_hang)?>" required>
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


<?php

include '../partials/header.php';
require_once '../bootstrap.php';
use CT275\Labs\hang_hoa;

$hang_hoa = new hang_hoa($PDO); // khoi tao de sd cac ham
// $count = $hang_hoa->COUNT();
//$order_by = 'ten_loai';
//$hang_hoas = $hang_hoa->order_by($order_by);
$hang_hoas = $hang_hoa->all();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sap_xep'])) {
    $hang_hoas = $hang_hoa->order_by($_POST['sap_xep']);
    //redirect('nhanvien.php');
}
if(!isset($_SESSION['admin_formdb'])){
    echo('<div style="height: 300px; margin-top:150px;margin:" class="text-center">
    <h3><p>Bạn không có quyền truy xuất trang này</p></h3>
    <a href="index.php"> <button class="btn btn-primary">Đi đến trang chủ</button></a>
    <a href="hang_hoa.php"> <button class="btn btn-primary">Đi đến trang sản phẩm</button></a>');
     include('../partials/footer.php');
    exit();

}
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
    session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
}
// echo  $_SESSION['ten'];
?>
<main class="container">
    <form class="nav--product row " action="nhanvien.php" method="post">
        <div class=" col-7">
            <h5><a class="text-black" href="">Trang chủ</a> / <a class="text-black" href="">Nhân viên</a></h5>
        </div>
        <!-- <div class="col-2 text-end">
            <p>
                Hiển thị <?= $count ?> kết quả</p>
        </div>                       -->
        <div class="col-2 mx-0  text-end">   
                <label class="visually-hidden" for="specificSizeSelect"></label>
                <select name="sap_xep" class="form-select" id="specificSizeSelect">
                    <option value="ten_nv">Sắp xếp theo giá trị mặc định</option>
                    <option value="ten_hang_hoa">Sắp xếp theo tên sản phẩm</option>
                    <option value="ngaynhap">Sắp xếp theo ngày nhập</option>
                    <option value="id_loai">Sắp xếp theo giới tính sản phẩm </option>
                    <option value="gia">Sắp xếp theo giá tiền sản phẩm</option>
                    <option value="so_luong_hang">Sắp xếp theo số lượng sản phẩm</option>
                    <option value="ten_loai">Sắp xếp theo loại sản phẩm</option>
                </select>
        </div>
        <div class="col-1 mx-0 ">
        <button  class=" btn btn-outline-primary" type="submit">Sắp xếp</button>
        </div>
    </form>

    <section>
        <a href="<?= BASE_URL_PATH . 'add.php' ?>" class="btn btn-primary" style="margin-bottom: 30px;">
            <i class="fa fa-plus"></i> Thêm sản phẩm</a>
        <table id="contacts" class="table table-striped table-responsive table-bordered">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">id</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Loại sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tên Admin</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($hang_hoas as $hang_hoa) : ?>
                    <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?= htmlspecialchars($hang_hoa->getID()) ?></td>
                        <td><?= htmlspecialchars($hang_hoa->ten_hang_hoa) ?></td>
                        <td><?= htmlspecialchars($hang_hoa->gia) . 'vnđ' ?></td>
                        <td><img class="card-img-top" src="<?=$hang_hoa->hinh ?>" alt="..." /></td>

                        <!-- <td><?= date("d-m-Y", strtotime($hang_hoa->ngaynhap)) ?></td> -->
                        <td><?php
                            if ($hang_hoa->id_loai == 1) {
                                echo ("Laptop");
                            } if ($hang_hoa->id_loai == 2) {
                                echo ("SamSung");
                            } else {
                                echo ("Iphone");
                            }
                            ?></td>
                        <td><?= htmlspecialchars($hang_hoa->so_luong_hang) ?></td>
                        <td><?php echo $_SESSION['ten']    ?></td>
                        <td>
                            <a href="<?= BASE_URL_PATH . 'edit.php?id=' . $hang_hoa->getId() ?>" class="btn btn-xs btn-warning">
                                <i alt="Edit" class="fa fa-pencil"> Edit</i></a>
                            <form class="delete" action="<?= BASE_URL_PATH . 'delete.php' ?>" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $hang_hoa->getId() ?>">
                                <button type="button" class="btn btn-xs btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $hang_hoa->getId() ?>">
                                    <i alt="Delete" class="fa fa-trash"></i>  Delete</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $hang_hoa->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Trang sức thông báo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc muốn xóa sản phẩm <span class="h5"><?= htmlspecialchars($hang_hoa->ten_hang_hoa) ?> </span> ?.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</main>
<?php include('../partials/footer.php') ?>
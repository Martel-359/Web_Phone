<?php

include '../partials/header.php';
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
<section class="py-5">

<main class="container">
       <form class="nav--product row " action="nhanvien.php" method="post">
           <div class="col-7 mt-2 mb-4">
               <h5><a style ="text-decoration : none;" class="text-black font-weight-bold" href="index.php">Trang chủ</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i> <a style ="text-decoration :none;" class="text-secondary" href="">Admin</a></h5>
           </div>
           <!-- <div class="col-2 text-end">
               <p>
                   Hiển thị <?= $count ?> kết quả</p>
           </div>                       -->
           </div>
           </form>
           <section">
               <a href="<?= BASE_URL_PATH . 'them.php' ?>" class="btn btn-primary" style="margin-bottom: 30px;">
                   <i class="fa fa-plus"></i> Thêm sản phẩm</a>
               <table id="addproduct" class="table table-hover table-bordered table-striped table-info">
                   <thead class="thead-dark text-center">
                       <tr class="text-uppercase">
                           <th scope="col">Stt</th>
                           <th scope="col">id</th>
                           <th scope="col">Tên</th>
                           <th scope="col">Giá</th>
                           <th scope="col">Hình ảnh</th>
                           <th scope="col">Loại sản phẩm</th>
                           <th scope="col">Số lượng</th>
                           <th scope="col">Ngày nhập</th>
                           <th scope="col">Hành động</th>
                       </tr>
                   </thead>
                   <tbody class="font-weight-bold">
                       <?php $i = 1; ?>
                       <?php foreach ($hang_hoas as $hang_hoa) : ?>
                           <tr>
                               <th scope="row"><?php echo $i++; ?></th>
                               <td><?= htmlspecialchars($hang_hoa->getID()) ?></td>
                               <td><?= htmlspecialchars($hang_hoa->ten_hang_hoa) ?></td>
                               <td><?= htmlspecialchars($hang_hoa->gia) . 'vnđ' ?></td>
                               <td><img style="width: 200px;" src="uploads/<?=$hang_hoa->hinh ?>" alt="..." /></td>
       
                               
                               <td><?php
                                   if ($hang_hoa->id_loai == 1) {
                                       echo ("Laptop");
                                   } if ($hang_hoa->id_loai == 2) {
                                       echo ("SamSung");
                                   } else if ($hang_hoa->id_loai == 3) {
                                       echo ("Iphone");
                                   }
                                   ?></td>
                              
                               <td ><?= htmlspecialchars($hang_hoa->so_luong_hang) ?></td>
                               <td><?= date("d-m-Y", strtotime($hang_hoa->ngaynhap)) ?></td>
                               <td >
                                   <a href="<?= BASE_URL_PATH . 'sua.php?id=' . $hang_hoa->getId() ?>" class="btn btn-xs btn-warning">
                                       <i alt="Edit" class="fa fa-pencil"> Edit</i></a>
                                       <form class="delete" action="<?= BASE_URL_PATH . 'xoa.php' ?>" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $hang_hoa->getId() ?>">
                                <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $hang_hoa->getId() ?>">
                                    <i alt="Delete" class="fa fa-trash"> Delete</i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $hang_hoa->getId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                Bạn có chắc muốn xóa sản phẩm <span class="h5 text-danger"><?php echo $hang_hoa->ten_hang_hoa . ' ?'  ?> </span> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary">Xóa</button>
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

    </section>
<?php
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
    session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
}
require_once '../bootstrap.php';
use CT275\Labs\admin;
use CT275\Labs\khach_hang;
$errors = [];
$message = "Đăng nhập thất bại - Vui lòng đăng nhập lại";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $khach_hang_db = new khach_hang($PDO);
    $khach_hang_formdbs = $khach_hang_db->all();
    $khach_hang_2 = new khach_hang($PDO);
    $khach_hang_dangnhap = $khach_hang_2->fill($_POST);
    foreach ($khach_hang_formdbs as $khach_hang_formdb) :
        if (($khach_hang_formdb->email == $khach_hang_dangnhap->email) && ($khach_hang_formdb->mat_khau) ==  $khach_hang_dangnhap->mat_khau) {
            $_SESSION['khach_hang_formdb'] = 'me';
            $_SESSION['role'] = 2;
            $_SESSION['id'] = $khach_hang_formdb->id;// id_kh
            $_SESSION['email'] = $khach_hang_formdb->email;
            $_SESSION['mat_khau'] = $khach_hang_formdb->mat_khau;
            $_SESSION['ten'] = $khach_hang_formdb->ten;
            //$_SESSION['vaitro']= $khach_hang_formdb->vaitro;
           // $khachhang->save_id_kh($khach_hang_formdb->getId());
           // echo ('ban da dang nhap th
            redirect('hanghoa.php');
           }   
    endforeach;
    
    

    $admin_db = new admin($PDO);
    $admin_formdbs = $admin_db->all();
    $admin_2 = new admin($PDO);
    $admin_dangnhap = $admin_2->fill($_POST);
    foreach ($admin_formdbs as $admin_formdb) :
        if (($admin_formdb->email == $admin_dangnhap->email) && $admin_formdb->mat_khau == $admin_dangnhap->mat_khau) {
        $_SESSION['admin_formdb'] = 'admin';
        $_SESSION['role'] = 1;
        //$_SESSION['id'] = $admin_formdb->id;// id_kh
        $_SESSION['email'] = $admin_formdb->email;
        $_SESSION['mat_khau'] = $admin_formdb->mat_khau;
       // $khachhang->save_id_kh($admin_formdb->getId());
       // echo ('ban da dang nhap thanh cong');
       $_SESSION['ten'] = $admin_formdb->ten;
   
        redirect('admin.php');
       }    
    endforeach;
 
    echo "<script type='text/javascript'>alert('$message');</script>";
    // include '../partials/header.php';
    echo  ('<div style="  padding-bottom: 100px; margin: auto; width: 50%; padding-top: 100px; position: relative;" class="text-center"> 
    <h1 style ="text-align: center;">
      <p>Đăng nhập thất bại</p>
    </h1>
    <span style ="position: absolute; transform: translate(-50%, -50%);left : 50%; margin-top: 20px">
    <a style ="text-align: center; padding: 70px 0" href="index.php"> <button 
    style ="background-color: #007bff; color: white; font-size: 14px;border: none; padding: 12px 26px;cursor: pointer;" class="btn btn-primary">Đi đến trang chủ</button></a>
    <a  href="sanpham.php"> <button style ="background-color: #008CBA; color: white; font-size: 14px;border: none; padding: 12px 26px;cursor: pointer;"class="btn btn-primary">Đi đến trang sản phẩm</button></a>
    </span>
  </div>');
}


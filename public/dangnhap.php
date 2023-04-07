<?php
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
    session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
}
require_once '../bootstrap.php';
use CT275\Labs\admin;
use CT275\Labs\khach_hang;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $khach_hang_db = new khach_hang($PDO);
    $khach_hang_formdbs = $khach_hang_db->all();
    $khach_hang_2 = new khach_hang($PDO);
    $khach_hang_dangnhap = $khach_hang_2->fill($_POST);
    foreach ($khach_hang_formdbs as $khach_hang_formdb) :
        if (($khach_hang_formdb->email == $khach_hang_dangnhap->email) && ($khach_hang_formdb->mat_khau) ==  $khach_hang_dangnhap->mat_khau) {
            $_SESSION['khach_hang_formdb'] = 'me';
            $_SESSION['id'] = $khach_hang_formdb->id;// id_kh
            $_SESSION['email'] = $khach_hang_formdb->email;
            $_SESSION['mat_khau'] = $khach_hang_formdb->mat_khau;
            $_SESSION['ten'] = $khach_hang_formdb->ten;
            //$_SESSION['vaitro']= $khach_hang_formdb->vaitro;
           // $khachhang->save_id_kh($khach_hang_formdb->getId());
           // echo ('ban da dang nhap th
            redirect('sanpham.php');
           }    
    endforeach;
    // echo ("Đăng nhập thất bại !!! Vui lòng đăng nhập lại");

    $admin_db = new admin($PDO);
    $admin_formdbs = $admin_db->all();
    $admin_2 = new admin($PDO);
    $admin_dangnhap = $admin_2->fill($_POST);
    foreach ($admin_formdbs as $admin_formdb) :
        if (($admin_formdb->email == $admin_dangnhap->email) && $admin_formdb->mat_khau == $admin_dangnhap->mat_khau) {
        $_SESSION['admin_formdb'] = 'admin';
        //$_SESSION['id'] = $admin_formdb->id;// id_kh
        $_SESSION['email'] = $admin_formdb->email;
        $_SESSION['mat_khau'] = $admin_formdb->mat_khau;
       // $khachhang->save_id_kh($admin_formdb->getId());
       // echo ('ban da dang nhap thanh cong');
   
        redirect('themsanpham.php');
       }    
    endforeach;
    echo ("Đăng nhập thất bại !!! Vui lòng đăng nhập lại");
}
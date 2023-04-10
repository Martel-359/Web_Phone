<?php
require_once '../bootstrap.php';
use CT275\Labs\hang_hoa;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['themgiohang'])) {
// session_destroy();
    $id = $_GET['id'];
    $so_luong = 1;
    $hang_hoa = new hang_hoa($PDO);
    $row = $hang_hoa->have_id($id);

    if($row) {
        $add_cart = array(
            'id' => $id,
            'ten' => $row[0]->ten_hang_hoa,
            'so_luong' => $so_luong,
            'gia' => $row[0]->gia,
            'hinh' => $row[0]->hinh
        );

        if(isset($_SESSION['carts'])) {
            $found = false;

            foreach($_SESSION['carts'] as &$cart) {
                if($cart['id'] == $id) {
                    $cart['so_luong'] += 1;
                    $found = true;
                }
            }

            if(!$found) {
                $_SESSION['carts'][] = $add_cart;
            }
        } else {
            $_SESSION['carts'][] = $add_cart;
        }
    }

    print_r($_SESSION['carts']);

}

?>
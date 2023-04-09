<?php
use CT275\Labs\hang_hoa;
// $cart=[];
// $so_luong=1;
$hang_hoa = new hang_hoa($PDO);
$hang_hoas = $hang_hoa->all();

if(isset($_POST['themgiohang'])){
    $id= $_GET['id'];
}


?>
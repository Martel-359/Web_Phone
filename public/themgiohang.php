<?php
require_once '../bootstrap.php';
use CT275\Labs\hang_hoa;
$cart=[];
$so_luong=1;


if(isset($_POST['themgiohang'])){
    $id= $_GET['id'];
    $hang_hoa = new hang_hoa($PDO);
    
}



?>
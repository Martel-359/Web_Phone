<?php
require_once '../bootstrap.php'; // tu dong nap lop,khong gian ten,dbconnect

use CT275\Labs\hang_hoa;

$hang_hoa = new hang_hoa($PDO);
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id'])
    && ($hang_hoa->find($_POST['id'])) !== null
) {
    $hang_hoa->delete();
}
redirect('admin.php');

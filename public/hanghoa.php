<?php 
include "../partials/header.php";

use CT275\Labs\hang_hoa;
use CT275\Labs\loai_hang_hoa;

$hang_hoa= new hang_hoa($PDO);

$loai_hang_hoa = new loai_hang_hoa($PDO);
$loai_hang_hoas = $loai_hang_hoa->all();



if(isset($_REQUEST['id'])){
    foreach ($loai_hang_hoas as $loai_hang_hoa) :
        if($_REQUEST['id']==$loai_hang_hoa->getId()){
            $hang_hoas= $hang_hoa->all_have_idloai($loai_hang_hoa->getId());
        }
    endforeach;
    
}


if(isset($_GET['search'])){
    $hang_hoas=$hang_hoa->all_have_ten($_GET['search']);
}


if (!isset($hang_hoas)){
    $hang_hoas=$hang_hoa->all();
}

$count = count($hang_hoas);




// if (!isset($_GET['search']) && !isset($_REQUEST['1']) && !isset($_REQUEST['2']) && ! ) {
//     $hang_hoas = $hang_hoa->all();
// }
// else{

// }


?>

<section class="py-5">
<div class="col-7 mb-4">
               <h5><a style ="text-decoration : none;" class="text-black font-weight-bold" href="hanghoa.php">Điện thoại</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i> <a style ="text-decoration : none;" class="text-secondary" href="">
               <?php foreach ($hang_hoas as $hang_hoa) :
                                   if ($hang_hoa->id_loai == 1) {
                                       echo ("Laptop");
                                       break;
                                   } else if ($hang_hoa->id_loai == 2) {
                                         echo ("Samsung");
                                         break;
                                   } else {
                                       echo ("Iphone");
                                       break;
                                   }
                                      endforeach ?>  
                                  
               </a>
            </h5>
           </div>
            <div class ="text-right text-primary font-weight-bold col-11 ">Hiển thị <span class="text-danger"><?=$count?></span> kết quả</div>
            <div class="container px-4 px-lg-5 mt-5">
            
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($hang_hoas as $hang_hoa) : ?>  
                <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="uploads/<?= $hang_hoa->hinh ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?=  $hang_hoa->ten_hang_hoa ?></h5>
                                    <!-- Product price-->
                                    <?= $hang_hoa->gia ?>VND
                                </div>
                            </div>
                           <!-- Product actions-->
                           <form action="themgiohang.php?id=<?= $hang_hoa->getId() ?>" method="POST">
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <input type="submit" name="themgiohang" value="Add to cart" class="btn btn-outline-dark mt-auto">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach ?>
                   
                            
                        </div>
                    </div>
                </div>
            </div>
</section>




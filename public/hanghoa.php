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
            $hang_hoas= $hang_hoa->all_have_id($loai_hang_hoa->getId());
        }
    endforeach;
    
}


if(isset($_GET['search'])){
    $hang_hoas=$hang_hoa->all_have_ten($_GET['search']);
}


if (!isset($hang_hoas)){
    $hang_hoas=$hang_hoa->all();
}








// if (!isset($_GET['search']) && !isset($_REQUEST['1']) && !isset($_REQUEST['2']) && ! ) {
//     $hang_hoas = $hang_hoa->all();
// }
// else{

// }


?>

<section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($hang_hoas as $hang_hoa) : ?>  
                <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?=$hang_hoa->hinh ?>" alt="..." />
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
                           <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                            
                        </div>
                    </div>
                <?php endforeach ?>
                   
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>



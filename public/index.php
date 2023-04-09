<?php
include('../partials/header.php');

use CT275\Labs\hang_hoa;
use CT275\Labs\loai_hang_hoa;

$hang_hoa = new hang_hoa($PDO);
$hang_hoas = $hang_hoa->all();
$loai_hang_hoa = new loai_hang_hoa($PDO);
$loai_hang_hoas = $loai_hang_hoa->all();


?>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($hang_hoas as $hang_hoa) : ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= $hang_hoa->hinh ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= $hang_hoa->ten_hang_hoa ?></h5>
                                <!-- Product price-->
                                <?= $hang_hoa->gia ?>VND
                            </div>
<<<<<<< HEAD
                           <!-- Product actions-->
                           <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                   
                            
=======
>>>>>>> 967c2d3dbf1409ca28ab09a5596a6a7cc7f7f259
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
<!-- Footer-->
<?php include('../partials/footer.php') ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>
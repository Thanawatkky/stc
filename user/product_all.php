<div class="container bg-white rounded-3 mt-3">
    <h4 class="text-center fw-bold pt-3">หมวดหมู่อาหาร</h4>
    <div class="row">
        <?php 
            $sql = $conn->query("SELECT * FROM tb_product_type WHERE shop_user='".$_REQUEST['shop_user']."' ");
            while($fet = $sql->fetch_object()) {
                
            
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 col-xl-2 mt-3">
            <div class="text-center">
                <a class="text-decoration-none text-muted" href="">
                    <img width="80" height="80" class="rounded-circle" src="../img/productType/<?= $fet->type_img; ?>" alt="">
                    <p><?= $fet->type_name; ?></p>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="container bg-white rounded-3 mt-3">
    <h4 class="text-center fw-bold pt-3">รายการอาหาร</h4>
    <div class="row">
        <?php 
            $sql_product = $conn->query("SELECT tb_product.*,tb_product_type.type_name FROM tb_product LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_product.shop_user = '".$_REQUEST['shop_user']."' ");
            while ($fet_product = $sql_product->fetch_object()) {
              
        ?>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-3">
            <div class="card">
                <div class="card-header rounded p-0">
                    <img width="100%" height="200" class="object-fit-cover rounded" src="../img/product/<?= $fet_product->pro_img; ?>" alt="">
                </div>
                <div class="card-body">
                    <h6 class="fw-bold text-center"><?= $fet_product->pro_name; ?></h6>
                    <p>รายละเอียด: <?= $fet_product->pro_detail; ?></p>
                    <p>ส่วนลด: <?= showSale($fet_product->pro_sale); ?></p>
                    <?php 
                        if ($fet_product->pro_sale != 0) {
                          
                    ?>
                        <del class="text-danger">ราคา: <?= $fet_product->pro_price; ?> ฿</del>
                        <p>ราคา: <?= sumsale($fet_product->pro_price, $fet_product->pro_sale); ?> ฿</p>
                    <?php }else{ ?>
                        <p>ราคา: <?= $fet_product->pro_price; ?> ฿</p>
                    <?php } ?>
                    <div class="text-center">
                        <button type="button" id="btn-cart" data-id="<?= $fet_product->pro_id; ?>" data-shop="<?= $fet_product->shop_user; ?>" class="btn btn-success">นำเข้าตะกร้าสินค้า</button> 
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    

    <h5 class="fw-bold mt-5">รีวิว/ความคิดเห็น</h5>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 col-xl-2 mt-3">
            <div class="card">
                <div class="card-header bg-white text-center">
                    :jeerayut
                </div>
                <div class="card-body text-center">
                    <small>คะแนนรีวิว: ⭐⭐⭐⭐⭐</small><br>
                    <small>ความคิดเห็น: d makkk</small>
                </div>
            </div>
        </div>
    </div>
</div>  

<div class="container mt-4 bg-white rounded-3 px-3">
    <h4 class="text-center fw-bold pt-3">ผลการค้นหา</h4>

    <div class="row">
    <?php 
    if (isset($_REQUEST['search'])) {
        $where = "AND tb_shop.shop_name LIKE '%".$_REQUEST['search']."%' ";
    }else{
        $where = "";
    }
            $sql = $conn->query("SELECT tb_user.*,tb_shop.shop_name,tb_shop.shop_type,tb_shop_type.type_name FROM tb_user LEFT JOIN tb_shop ON tb_user.user_id = tb_shop.user_id LEFT JOIN tb_shop_type ON tb_shop.shop_type = tb_shop_type.type_id WHERE tb_user.user_status = 1 $where");
            while($fet = $sql->fetch_object()) {
        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 py-3">
            <div class="card">
                <div class="card-header p-0">
                    <img width="100%" height="200" class="object-fit-cover" src="../img/profile/<?= $fet->user_img; ?>" alt="">
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="fw-bold"><?= $fet->shop_name; ?></h5>
                    </div>
                    <div class="text-center">
                        <p>คะแนนรีวิว: ⭐⭐⭐⭐⭐</p>
                        <p>ประเภทร้านอาหาร: <?= $fet->type_name; ?></p>
                        
                        <a href="index.php?p=product_all&shop_user=<?= $fet->user_id; ?>" class="btn btn-outline-success w-75">เลือกดูสินค้า</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
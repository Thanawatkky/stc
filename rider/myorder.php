<div class="col">
    <div class="container mt-4">
        <div class="rounded-3 bg-white px-3">
            <div class="text-center pt-3">
                <h4 class="fw-bold">รายการออเดอร์ของฉัน</h4>
            </div>
        
        <div class="row">
            <?php
                $sql = $conn->query("SELECT tb_order.*,tb_user.*,tb_shop.shop_name FROM tb_order LEFT JOIN tb_user ON tb_order.cus_name = tb_user.user_id LEFT JOIN tb_shop ON tb_user.user_id = tb_shop.user_id WHERE tb_order.order_status = 2 AND tb_order.r_id='".$_SESSION['user_id']."' ");
                $num = $sql->num_rows;
                if ($num <= 0) {
                    echo "<h5 class='text-center text-muted pt-3'>ไม่มีรายการออเดอร์</h5>";
                }
                while($fet = $sql->fetch_object()) {
                    $sql_product = $conn->query("SELECT tb_cart.*,tb_product.*,tb_product_type.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_cart.order_id = '".$fet->order_id."'");
                
            ?>
            <div class="col-12 col-lg-4 col-xl-4 py-3">
                <div class="card">
                    <div class="card-header text-center bg-white">
                        <div class="row">
                            <div class="col">
                                <h5 class="fw-bold text-start px-3">ออเดอร์: <?= $fet->order_id; ?></h5>
                            </div>
                            <div class="col">
                                <h5 class="fw-bold text-end px-3">ร้าน: <?= $fet->shop_name; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">
                                <p class="fw-bold">รายละเอียดผู้สั่ง</p>
                                <p>ชื่อ: <?= $fet->fullname; ?></p>
                                <p>ที่อยู่: <?= $fet->address; ?></p>
                                <p>เบอร์โทรศัพท์: <?= $fet->tel; ?></p>
                            </div>
                            <div class="col text-center">
                                <p class="fw-bold">รายการอาหาร</p>
                            <?php 
                                while($fet_product = $sql_product->fetch_object()) {
                            ?>
                                <p>เมนู: <?= $fet_product->pro_name; ?></p>
                                <p>รายละเอียด: <?= $fet_product->pro_detail; ?></p>
                                <p>จำนวน: <?= $fet_product->ca_qty; ?> รายการ</p>
                                <p>ราคา: <?= sumtotal($fet_product->pro_price, $fet_product->pro_sale, $fet_product->ca_qty); ?> บาท</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <?php 
                                if ($fet->order_status == 2) {
                                
                            ?>
                            <button type="button" data-id=<?= $fet->order_id; ?> class="btn btn-outline-success" id="btn-success">ยืนยันการส่งอาหาร</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
    </div>
</div>  
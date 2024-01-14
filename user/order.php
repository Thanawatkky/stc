<div class="bg-white rounded-3 container px-4 mt-2 py-4">
    <h4 class="text-center fw-bold pb-3">รายการออเดอร์</h4>
    <div class="row">
        <div class="col-lg-9">
            <div class="table-responsive">
            <table class="table table-hover text-center shadow-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>รูปภาพ</th>
                    <th>รายการอาหาร</th>
                    <th>รายละเอียด</th>
                    <th>ร้าน</th>
                    <th>จำนวน</th>
                    <th>ส่วนลด</th>
                    <th>ราคารวม</th>
                </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                    $shop = 0;
                        $sql = $conn->query("SELECT tb_cart.*,tb_product.*,tb_shop.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_shop ON tb_product.shop_user = tb_shop.user_id WHERE tb_cart.ca_user='".$_SESSION['user_id']."' AND tb_cart.order_id = 0 ");
                       $i=0;
                        while($fet = $sql->fetch_object()) {
                            $i++;
                        
                    ?>
                <tr>   
                    <td><?= $i; ?></td>
                    <td>
                    <img width="100" height="100" class="rounded"
                        src="../img/product/<?= $fet->pro_img; ?>" alt="">
                    </td>
                    <td><?= $fet->pro_name; ?></td>
                    <td><?= $fet->pro_detail; ?></td>
                    <td><?= $fet->shop_name; ?></td>
                    <td><?= $fet->ca_qty; ?></td>
                    <td><?= showsale($fet->pro_sale); ?></td>
                    <td><?= sumtotal($fet->pro_price, $fet->pro_sale, $fet->ca_qty); ?> บาท</td>
                </tr>
                <?php
                $shop = $fet->ca_shop;
            } 
            ?>
                </tbody>
            </table>
            </div>
            <h5 class="text-center">ราคารวมทั้งหมด <b><?= $_REQUEST['total']; ?></b> ฿</h5>
        </div>
        <div class="col-lg-3 mt-0 mt-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold text-center">ยืนยันการสั่งซื้อ</h5>
                    <div class="row mt-3">
                        <div class="col">
                            <h6 class="fw-bold">ชื่อ-นามสกุล:</h6>
                        </div>
                        <div class="col">
                            <h6><?= $_SESSION['fullname']; ?></h6>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <h6 class="fw-bold">ที่อยู่:</h6>
                        </div>
                        <div class="col">
                            <h6><?= $_SESSION['address']; ?></h6>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <h6 class="fw-bold">เบอร์โทรศัพท์:</h6>
                        </div>
                        <div class="col">
                            <h6><?= $_SESSION['tel']; ?></h6>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-success" id="btn-confirm"  data-shop="<?= $shop; ?>" data-total="<?= $_REQUEST['total']; ?>">ยืนยันการสั่งซื้อ</button>
                        <small class="text-muted"></small>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


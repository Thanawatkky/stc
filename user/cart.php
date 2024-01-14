<div class="container bg-white rounded-3 py-5 px-5 mt-5 pt-2">
    <div class="row">
        <div class="col-12 pb-4">
            <div class="mt-3">
                <h4>STC DELIVERY</h4>
            </div>
            <ol class="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="nav-link text-muted" href="index.php">หน้าหลัก</a>
                </li>
                <li class="breadcrumb-item active">
                    ตะกร้าสินค้า
                </li>
            </ol>
        </div>
        <?php 
            $sql = $conn->query("SELECT tb_cart.*,tb_shop.*,tb_product.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_shop ON tb_product.shop_user = tb_shop.user_id WHERE tb_cart.ca_user = '".$_SESSION['user_id']."' AND tb_cart.order_id <= 0 ");
                $sale = 0;
                $total = 0;
                ?>
        <div class="col-lg-7 mb-3 mb-lg-0">
            <div class="card">
                <div class="card-body">

                <?php while($fet = $sql->fetch_object()) { ?>
                        <table>
                            <tr class="border-top border-bottom">
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <img width="100%" height="100%" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                                        </div>
                                        <div class="col-9 mt-3">
                                            <p class="mb-0"><?= $fet->pro_name; ?></p>
                                            <small class="text-muted">ร้าน: <?= $fet->shop_name; ?></small> <br>
                                            
                                            <div class="d-inline">
                                                <h6 class="mb-0 d-inline-block fw-bold"><?= $fet->pro_price; ?>฿</h6>
                                                <div class="d-inline ms-4">
                                                    <button class="btn bi bi-dash"
                                                    id="btn-dash" data-id="<?= $fet->ca_id; ?>" type="button"></button>
                                                    <input style="width: 40px;" class="d-inline form-control p-0 border-0 text-center" type="number" name="ca_qty" id="ca_qty" disabled value="<?= $fet
                                                    ->ca_qty; ?>">
                                                    <button class="btn bi bi-plus" id="btn-plus" data-id="<?= $fet->ca_id; ?>" type="button"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <button class="btn-close btn-sm" id="btn-delCart" type="button" data-id="<?= $fet->ca_id; ?>" ></button>
                                </td>
                            </tr>
                                
                        </table>
                        <?php
        $price = $fet->pro_price * $fet->ca_qty;
        $total += $total + $price;
        $price = 0;
        $priceSale = $fet->pro_sale;
        $sale += $priceSale;
        $priceSale = 0;
     }
     
     ?>
                </div>
            </div>
        
     </div>
        <div class="col-lg-5">
            <div class="card px-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-start">ราคา</div>
                        <div class="col text-end"><?= $total; ?> ฿</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-start">ส่วนลด</div>
                        <div class="col text-end"><?= $sale; ?> %</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col text-start">ทั้งหมด</div>
                        <div class="col text-end"><?= sumsale($total, $sale); ?> บาท</div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="index.php?p=order&total=<?= $total; ?>" class="btn btn-success w-100 p-2" id="btn-conCart">ดำเนินการชำระเงิน</a>
                        <small class="text-muted mt-1">เมื่อทำการกดดำเนินการชำระเงินจะไม่สามารถยกเลิกได้</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    </style>
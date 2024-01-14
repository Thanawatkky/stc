<div class="col px-4">
    <div class="bg-white container rounded-3 px-4 mt-4 py-4">
            <h4 class="text-center fw-bold pb-3">สรุปยอดขาย</h4>

            <div class="text-end">
                <form action="index.php?p=salesum" method="post">
                  <select name="order_date" id="order_date">
                    <option selected value="" disabled>ว/ด/ป</option>
                    <?php 
                        $sql_date = $conn->query("SELECT order_date FROM tb_order WHERE shop_user='".$_SESSION['user_id']."' ");
                        while ($fet_date = $sql_date->fetch_object()) {
                        
                    ?>
                    <option value="<?= $fet_date->order_date; ?>"><?= date("d/m/Y",strtotime($fet_date->order_date)); ?></option>
                    <?php } ?>
                  </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm">ค้นหา</button>
                </form>
            </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover text-center shadow-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รูปภาพสินค้า</th>
                        <th>เมนู</th>
                        <th>รายละเอียด</th>
                        <th>หมวดหมู่อาหาร</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>ส่วนลด</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                    if (isset($_REQUEST['order_date'])) {
                        $txt = "สรุปยอดขายวันที่".date("d/m/Y",strtotime($_REQUEST['order_date']));;
                        $where = "AND tb_order.order_date = '".$_REQUEST['order_date']."' ";
                    }else{
                        $txt = "";
                        $where = "";
                    }
                        $sql = $conn->query("SELECT tb_order.*,tb_cart.*,tb_product.*,tb_product_type.type_name FROM tb_order LEFT JOIN tb_cart ON tb_order.order_id = tb_cart.order_id LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_order.shop_user = '".$_SESSION['user_id']."' AND tb_order.order_status = 3 $where");
                    $i=0;
                    echo '<h6 class="text-start">'.$txt.'</h6>';
                        while($fet = $sql->fetch_object()) {
                            $i++;
                    ?>
                    
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <img width="100" height="100" class="rounded" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                        </td>
                        <td><?= $fet->pro_name;  ?></td>
                        <td><?= $fet->pro_detail; ?></td>
                        <td><?= $fet->type_name; ?></td>
                        <td><?= $fet->ca_qty; ?> รายการ</td>
                        <td><?= $fet->pro_price; ?> บาท</td>
                        <td><?= showsale($fet->pro_sale); ?></td>
                        <td><?= sumtotal($fet->pro_price, $fet->pro_sale, $fet->ca_qty); ?> บาท</td>
                    </tr>
                    <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
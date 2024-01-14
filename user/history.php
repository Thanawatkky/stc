<div class="bg-white rounded-3 container px-4 mt-4 py-4">
    <h4 class="text-center fw-bold pb-3">ประวัติการสั่งซื้อ</h4>
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
            <th>สถานะ</th>
            <th>รีวิวสินค้า</th>
          </tr>
        </thead>
        <tbody class="align-middle table-group-divider text-primary">
          <?php
            $sql = $conn->query("SELECT tb_order.*,tb_cart.*,tb_product.*,tb_shop.shop_name FROM tb_order LEFT JOIN tb_cart ON tb_order.order_id = tb_cart.order_id LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_shop ON tb_product.shop_user = tb_shop.user_id WHERE tb_order.cus_name = '".$_SESSION['user_id']."' ");
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
            <td><?= showsale($fet->pro_sale); ?>%</td>
            <td><?= sumtotal($fet->pro_price, $fet->pro_sale, $fet->ca_qty); ?></td>
            <td><?= orderStatus($fet->order_status); ?></td>
            <td> 
              <?php 
                $sql_review = $conn->query("SELECT * FROM tb_review WHERE re_product='".$fet->pro_id."' AND re_order='".$fet->order_id."' AND re_shop='".$fet->shop_user."' AND re_user='".$_SESSION['user_id']."' ");
                $num_re = $sql_review->num_rows;
                if ($num_re <= 0) {
                 
              ?>
              <button class="btn btn-warning btn-sm" id="btn-review" data-id="<?= $fet->order_id; ?>" data-pro="<?= $fet->pro_id; ?>" data-shop="<?= $fet->shop_user; ?>" data- data-bs-toggle="modal"
                data-bs-target="#modalReview" <?php 
                  if ($fet->order_status != 3) {
                    echo "disabled";
                  }
                ?>>ให้คะแนนรีวิว</button>
                <?php 
                  }else{ 
                    echo "รีวิวรายการนี้แล้ว";
                    }
                  ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReview" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ให้คะแนนรีวิว</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../api/ac_review.php?ac=add" method="post" id="frm_review">
          <div class="">
            <label class="form-label" for="">รีวิว</label>
          </div>
                  <input type="hidden" name="re_product" id="re_product1">
                  <input type="hidden" name="re_order" id="re_order1">
                  <input type="hidden" name="re_shop" id="re_shop1">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="re_point" id="re_point" value="5">
              <label class="form-check-label" for="">ดีมาก</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="re_point" id="re_point" value="4">
              <label class="form-check-label" for="re_point">ดี</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="re_point" id="re_point" value="3">
              <label class="form-check-label" for="re_point">พอใช้</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="re_point" id="re_point" value="2">
              <label class="form-check-label" for="re_point">แย่</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="re_point" id="re_point" value="1">
              <label class="form-check-label" for="re_point">ปรับปรุง</label>
            </div>

            <div class="mt-2">
              <label class="form-label" for="">หมายเหตุ</label>
              <textarea name="re_detail" id="re_detail" cols="10" rows="3" class="form-control"></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
            <button  type="submit" class="btn btn-success">ยืนยัน</button>
          </form>
      </div>
    </div>
  </div>

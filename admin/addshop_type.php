<div class="col">
    <div class="col-10 m-auto rounded-3 card mt-5 border-0">
      <?php 
        if (isset($_REQUEST['type_id'])) {
            $sql = $conn->query("SELECT * FROM tb_shop_type WHERE type_id='".$_REQUEST['type_id']."' ");
            $fet = $sql->fetch_object();
      ?>
        <h4 class="text-center pt-5">แก้ไขประเภทร้านอาหาร</h4>

<div class="px-5">
    <form class="px-4" action="../api/ac_shopType.php?ac=edit&type_id=<?= $_REQUEST['type_id'] ?>" method="post" id="frm_shopType">
        <div class="mt-1">
            <label class="form-label" for="">ประเภทร้านอาหาร</label>
            <input class="form-control" type="text" name="type_name" value="<?= $fet->type_name; ?>" id="type_name" placeholder="กรอกประเภทร้านอาหาร">
        </div>
        <div class="mt-3">
            <label class="form-label" for="">รายละเอียด</label>
            <input class="form-control" value="<?= $fet->detail; ?>" type="text" name="detail" id="detail" placeholder="กรอกหมายเหตุ">
        </div>
        <div class="text-center py-4">
            <button tpye="reset" class="btn btn-outline-dark w-25 mx-1">ยกเลิก</button>
            <button type="submit" class="btn btn-outline-success w-25 mx-1">ยืนยัน</button>
        </div>
    </form>
</div>
      <?php }else{ ?>
        <h4 class="text-center pt-5">เพิ่มประเภทร้านอาหาร</h4>

<div class="px-5">
    <form class="px-4" action="../api/ac_shopType.php?ac=add" method="post" id="frm_shopType">
        <div class="mt-1">
            <label class="form-label" for="">ประเภทร้านอาหาร</label>
            <input class="form-control" type="text" name="type_name" id="type_name" placeholder="กรอกประเภทร้านอาหาร">
        </div>
        <div class="mt-3">
            <label class="form-label" for="">รายละเอียด</label>
            <input class="form-control" type="text" name="detail" id="detail" placeholder="กรอกหมายเหตุ">
        </div>
        <div class="text-center py-4">
            <button tpye="reset" onclick="window.location.replace('index.php');" class="btn btn-outline-dark w-25 mx-1">ยกเลิก</button>
            <button type="submit" class="btn btn-outline-success w-25 mx-1">ยืนยัน</button>
        </div>
    </form>
</div>
        <?php } ?>
    </div>
</div>
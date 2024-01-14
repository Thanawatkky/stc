<div class="col px-4">
    <div class="bg-white container rounded-3 px-4 mt-4 py-4">
            <h4 class="text-center fw-bold pb-3">รายการอาหาร</h4>

        <div class="table-responsive">
            <table class="table table-sm table-hover text-center shadow-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รูปภาพสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียด</th>
                        <th>หมวดหมู่อาหาร</th>
                        <th>ส่วนลด</th>
                        <th>ราคารวม</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                        $sql = $conn->query("SELECT tb_product.*,tb_product_type.type_name FROM tb_product LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_product.shop_user='".$_SESSION['user_id']."' ");
                        $i=0;
                        while ($fet = $sql->fetch_object()) {
                           $i++;
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <img width="100" height="100" class="rounded" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                        </td>
                        <td><?= $fet->pro_name; ?></td>
                        <td><?= $fet->pro_detail; ?></td>
                        <td><?= $fet->type_name; ?></td>
                        <td><?= showSale($fet->pro_sale); ?></td>
                        <td><?= $fet->pro_price; ?> บาท</td>
                        <td>
                            <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalEditProduct" id="btn-edit" data-id="<?= $fet->pro_id; ?>" data-detail="<?= $fet->pro_detail; ?>" data-name="<?= $fet->pro_name; ?>" data-price="<?= $fet->pro_price; ?>" data-sale="<?= $fet->pro_sale; ?>" data-type="<?= $fet->pro_type; ?>">แก้ไข</a>
                                </li>
                                <li>
                                    <button type="button" data-sale="<?= $fet->pro_sale; ?>" data-id="<?= $fet->pro_id; ?>" class="dropdown-item" type="button" id="btn-sale" data-bs-toggle="modal" data-bs-target="#modalAddSale">เพิ่มส่วนลด</button>
                                </li>
                                <li>
                                    <a class="dropdown-item" type="button">ลบ </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAddProduct" aria-expanded="false">เพิ่มรายการอาหาร</button>
        </div>
    </div>
</div>


<div class="modal fade" id="modalAddProduct" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มรายการอาหาร</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../api/ac_product.php?ac=add" id="frm_product" enctype="multipart/form-data" method="post">
                    <div class="">
                        <label for="" class="form-label">เพิ่มรายการอาหาร</label>
                        <input type="text" name="pro_name" id="" class="form-control" placeholder="กรอกรายการอาหาร">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รายละเอียด</label>
                        <input type="text" name="pro_detail" id="pro_detail" class="form-control" placeholder="กรอกรายละเอียดสินค้า">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">หมวดหมู่อาหาร</label>
                        <select class="form-select" name="pro_type" id="pro_type">
                            <option  value="" disable>เลือกหมวดหมู่อาหาร</option>
                            <?php 
                                $sql_ty = $conn->query("SELECT * FROM tb_product_type WHERE shop_user='".$_SESSION['user_id']."' ");
                                while ($fet_ty = $sql_ty->fetch_object()) {
                                 
                            ?>
                            <option value="<?= $fet_ty->type_id; ?>"><?= $fet_ty->type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ราคาสินค้า</label>
                        <input type="number" name="pro_price" id="pro_price" class="form-control" placeholder="กรอกราคาสินค้า">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ส่วนลด</label>
                        <input type="number" name="pro_sale" id="pro_sale" class="form-control" placeholder="กรอกส่วนลด">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รูปภาพสินค้า</label>
                        <input type="file" name="pro_img" id="pro_img" class="form-control">
                    </div>

                    <div class="text-center mt-3">
                        <a data-bs-dismiss="modal" class="btn btn-outline-secondary">ยกเลิก</a>
                        <button type="submit" class="btn btn-outline-success">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditProduct" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">แก้ไขรายการอาหาร</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form action="../api/ac_product.php?ac=edit" id="frm_productEdit" enctype="multipart/form-data" method="post">
                <div class="">
                        <label for="" class="form-label">เพิ่มรายการอาหาร</label>
                        <input type="text" name="pro_name" id="pro_name1" class="form-control" placeholder="กรอกรายการอาหาร">
                        <input type="hidden" name="pro_id" id="pro_id1" class="form-control" placeholder="กรอกรายการอาหาร">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รายละเอียด</label>
                        <input type="text" name="pro_detail" id="pro_detail1" class="form-control" placeholder="กรอกรายละเอียดสินค้า">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">หมวดหมู่อาหาร</label>
                        <select class="form-select" name="pro_type" id="pro_type1">
                            <option  value="" disable>เลือกหมวดหมู่อาหาร</option>
                            <?php 
                                $sql_ty1 = $conn->query("SELECT * FROM tb_product_type WHERE shop_user='".$_SESSION['user_id']."' ");
                                while ($fet_ty1 = $sql_ty1->fetch_object()) {
                                 
                            ?>
                            <option value="<?= $fet_ty1->type_id; ?>"><?= $fet_ty1->type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ราคาสินค้า</label>
                        <input type="number" name="pro_price" id="pro_price1" class="form-control" placeholder="กรอกราคาสินค้า">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ส่วนลด</label>
                        <input type="number" name="pro_sale" id="pro_sale1" class="form-control" placeholder="กรอกส่วนลด">
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รูปภาพสินค้า</label>
                        <input type="file" name="pro_img" id="pro_img" class="form-control">
                    </div>

                    <div class="text-center mt-3">
                        <a data-bs-dismiss="modal" class="btn btn-outline-secondary">ยกเลิก</a>
                        <button type="submit" class="btn btn-outline-success">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddSale" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มส่วนลด</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="../api/ac_product.php?ac=addSale" id="frm_sale" method="post">
                    <div class="mt-2">
                        <label for="" class="form-label">ส่วนลด</label>
                        <input type="number" name="pro_sale" id="pro_sale2" class="form-control" placeholder="กรอกส่วนลด">
                        <input type="hidden" name="pro_id" id="pro_id2" class="form-control" placeholder="กรอกส่วนลด">
                    </div>

                    <div class="text-center mt-3">
                        <a data-bs-dismiss="modal" class="btn btn-outline-secondary">ยกเลิก</a>
                        <button type="submit" class="btn btn-outline-success">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col">
    <div class="bg-white container px-4 mt-4 py-4">
            <h4 class="text-center fw-bold pb-3">การจัดการร้านอาหาร</h4>
        <div class="table-responsive">
            <table class="table table-hover text-center shadow-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ชื่อร้านอาหาร</th>
                        <th>ประเภทร้านอาหาร</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                        $sql = $conn->query("SELECT tb_user.*,tb_shop.shop_name,tb_shop.shop_type FROM tb_user LEFT JOIN tb_shop ON tb_user.user_id = tb_shop.user_id WHERE tb_user.user_role = 3");
                        $i = 0 ;
                        while($fet = $sql->fetch_object()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <img width="100" height="100" class="rounded" src="../img/profile/<?= $fet->user_img; ?>" alt="">
                        </td>
                        <td><?= $fet->username; ?></td>
                        <td><?= $fet->shop_name; ?></td>
                        <td><?= $fet->shop_type; ?></td>
                        <td><?= $fet->address; ?></td>
                        <td><?= $fet->tel; ?></td>
                        <td><?= status($fet->user_status, $fet->user_role); ?></td>
                        <td>
                        <?php 
                             if ($fet->user_status == 0) { ?>
                             <button class="btn btn-success btn-sm" id="btn-app" data-id="<?= $fet->user_id; ?>">อนุมัติการใช้งาน</button>
                            <?php  }else if($fet->user_status == 1) { ?>
                                <button class="btn btn-warning btn-sm" id="btn-block" data-id="<?= $fet->user_id; ?>">ยกเลิกการเข้าใช้งาน</button>
                           <?php  }?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
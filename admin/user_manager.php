<div class="col">
    <div class="bg-white container px-4 mt-4 py-4">
        <?php if (isset($_REQUEST['rider'])) { ?>
            <h4 class="text-center fw-bold pb-3">การจัดการไรเดอร์</h4>
      <?php  }else{ ?>
        <h4 class="text-center fw-bold pb-3">การจัดการผู้ใช้ทั่วไป</h4>
       <?php } ?>


        <div class="table-responsive">
            <table class="table table-hover text-center shadow-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>ชื่อ-สกุล</th>
                        <th>ที่อยู่</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                    if (isset($_REQUEST['rider'])) {
                        $where = "user_role = 4";
                    }else{
                        $where = "user_role = 2";
                    }
                        $sql = $conn->query("SELECT * FROM tb_user WHERE $where");
                        $i = 0;
                        while($fet = $sql->fetch_object()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <img width="100" height="100" class="rounded" src="../img/profile/<?= $fet->user_img; ?>" alt="">
                        </td>
                        <td><?= $fet->username; ?></td>
                        <td><?= $fet->fullname; ?></td>
                        <td><?= $fet->address; ?></td>
                        <td><?= $fet->tel; ?></td>
                        <td><?= status($fet->user_status,$fet->user_role); ?></td>
                        <td>
                            
                            <?php 
                             if ($fet->user_status == 0) { ?>
                             <button type="button" class="btn btn-success btn-sm" id="btn-app" data-id="<?= $fet->user_id; ?>">อนุมัติการใช้งาน</button>
                            <?php  }else if($fet->user_status == 1) { ?>
                                <button class="btn btn-warning btn-sm" id="btn-block" data-id="<?= $fet->user_id; ?>">ระงับการใช้งานชั่วคราว</button>
                           <?php  }else{
                            if ($fet->user_role == 2) {
                              
                            ?>
                            <button class="btn btn-danger btn-sm" id="btn-app" data-id="<?= $fet->user_id; ?>">ยกเลิกการระงับการใช้งาน</button>
                            <?php 
                            } 
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
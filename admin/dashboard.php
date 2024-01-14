<div class="col">
    <div class="container pt-3 px-4 mt-4">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-start">
                                <h5>ข้อมูลผู้ใช้ทั้งหมด</h5>
                                <h5 class="ms-1">1000</h5>
                            </div>
                            <div class="col text-end">
                                <i class="fa fa-users text-success fs-2 mx-1 pt-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-start">
                                <h5>ข้อมูลผู้ใช้ทั่วไป</h5>
                                <h5 class="ms-1">1000</h5>
                            </div>
                            <div class="col text-end">
                                <i class="fa fa-user text-muted fs-2 mx-1 pt-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-start">
                                <h5>ข้อมูลผู้ใช้ร้านอาหาร</h5>
                                <h5 class="ms-1">1000</h5>
                            </div>
                            <div class="col text-end">
                                <i class="fa fa-cutlery text-warning fs-2 mx-1 pt-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-start">
                                <h5>ข้อมูลผู้จัดส่งอาหาร</h5>
                                <h5 class="ms-1">1000</h5>
                            </div>
                            <div class="col text-end">
                                <i class="fa fa-motorcycle text-danger fs-2 mx-1 pt-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-12 px-4">
        <div class="bg-white rounded-2 container px-4 mt-4 py-4">
            <h4 class="text-center fw-bold pb-3">ประเภทร้านอาหารทั้งหมด</h4>
            <div class="table-responsive">
                <table class="table table-sm table-hover text-center shadow-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ประเภทร้านอาหาร</th>
                            <th>หมายเหตุ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle table-group-divider text-primary">
                        <?php
                            $sql = $conn->query("SELECT * FROM tb_shop_type");
                            $i=0;
                            while($fet = $sql->fetch_object()) {
                                $i++;
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $fet->type_name; ?></td>
                            <td><?= $fet->detail; ?></td>
                            <td>
                                <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">Action</button>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="index.php?p=addshop_type&type_id=<?= $fet->type_id; ?>">แก้ไข</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" id="btn-delShopType" onclick="return confirm('ต้องการลบประเภทร้านอาหารนี้ใช่ไหม?');" href="../api/ac_shopType.php?ac=del&type_id=<?= $fet->type_id; ?>">ลบ </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
</div>
</div>
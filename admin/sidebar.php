<?php 
    $sql_pf = $conn->query("SELECT * FROM tb_user WHERE user_id='".$_SESSION['user_id']."' ");
    $fet_pf = $sql_pf->fetch_object();
?>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="bg-dark col-auto col-lg-2 col-md-3 min-vh-100">
            <div class="bg-dark p-2">
                <a href="index.php" class="d-flex text-decoration-none align-items-center text-white mt-2">
                    <span class="fs-5 d-none d-sm-inline">STC ONLINE</span>
                </a>
                <div class="card"></div>

                <div class="card mt-3 bg-dark border-0">
                    <div class="card-header text-center  border-0">
                        <img width="60" height="60" class="rounded-circle"
                            src="../img/profile/<?= $fet_pf->user_img; ?>"
                            alt="profile">
                    </div>
                    <div class="card-body text-white p-0">
                        <div class="text-center">
                            <h6 class="fw-bold"><?= $fet_pf->fullname; ?></h6>
                        </div>
                        <div class="text-center">
                            <p>ประเภทผู้ใช้: Admin</p>
                        </div>
                    </div>

                </div>
            </div>


            <ul class="nav nav-pill flex-column">
                <li class="nav-item py-1">
                    <a href="index.php" class="nav-link text-white fs-6 text-center text-lg-start">
                        <i class="fs-5  fa fa-home me-2"></i><span class="d-none d-sm-inline">หน้าหลัก</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a href="#collapseExample" data-bs-toggle="collapse" aria-controls="collapseExample"
                        aria-expanded="false" role="button"
                        class="nav-link text-white fs-6 text-center text-lg-start dropdown-toggle">
                        <i class="fs-5  fa fa-list me-sm-0 me-lg-2 me-0"></i><span
                            class="d-none d-sm-inline">การจัดการ</span>
                    </a>

                    <div class="collapse" id="collapseExample">                   
                            <div>
                                <a class="nav-link text-white" href="index.php?p=user_manager">จัดการผู้ใช้ทั่วไป</a>
                            </div>
                            <div>
                                <a class="nav-link text-white" href="index.php?p=shop_manager">จัดการผู้ใช้ร้านอาหาร</a>
                            </div>
                            <div>
                                <a class="nav-link text-white" href="index.php?p=user_manager&rider=true">จัดการผู้จัดส่งอาหาร
                                </a>
                            </div>
                    </div>
                </li>
                <li class="nav-item py-1">
                    <a href="index.php?p=addshop_type" class="nav-link text-white fs-6 text-center text-lg-start">
                        <i class="fs-5  fa fa-cart-plus me-2"></i><span
                            class="d-none d-sm-inline">ประเภทร้านอาหาร</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a href="index.php?p=profile" class="nav-link text-white fs-6 text-center text-lg-start">
                        <i class="fs-5  fa fa-user me-2"></i><span class="d-none d-sm-inline">ข้อมูลส่วนตัว</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่หรือไม่?');" class="nav-link text-white fs-6 text-center text-lg-start">
                        <i class="fs-5  fa fa-sign-out me-2"></i><span class="d-none d-sm-inline">ออกจากระบบ</span>
                    </a>
                </li>
            </ul>
        </div>
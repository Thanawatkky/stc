<?php 
    $sql_pf = $conn->query("SELECT * FROM tb_user WHERE user_id='".$_SESSION['user_id']."' ");
    $fet_pf = $sql_pf->fetch_object();
?>
<div class="navbar bg-white d-flex d-lg-none">
        <button class="navbar-toggler px-4 col-auto border-0 d-flex d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-auto d-sm-none d-md-flex d-lg-flex collapse" id="navbarSupportedContent">
        <div class="flex-shrink-0 p-3 bg-white min-vh-100 fs-5" style="width: 280px;">
        <a href="index.php" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold">STC ONLINE</span>
        </a>

        <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <a href="index.php" class="btn btn-toggle align-items-center rounded fs-6 fw-bold">
            หน้าหลัก
            </a>
        </li>
        <li class="mb-1">
            <a href="index.php?p=myorder" class="btn btn-toggle align-items-center rounded collapsed fs-6 fw-bold">
            ออเดอร์ของฉัน
            </a>
        </li>
        <li class="mb-1">
            <a href="index.php?p=history" class="btn btn-toggle align-items-center rounded collapsed fs-6 fw-bold">
            ประวัติการรับออเดอร์
            </a>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed fw-bold" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
            บัญชีของฉัน
            </button>
            <div class="collapse px-3" id="account-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="index.php?p=profile" class="text-muted link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">แก้ไขข้อมูลส่วนตัว</a></li>
                <li><a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่ไหม?');" class="text-muted link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">ออกจากระบบ</a></li>
            </ul>
            </div>
        </li>
        </ul>
        <div class="row m-0 pb-2">
                <div class="col-4 text-center">
                    <img width="60" height="60" class="rounded-circle"
                        src="../img/profile/<?= $fet_pf->user_img; ?>"
                        alt="profile">
                </div>
                <div class="col-8 text-dark p-0">
                    <div class="text-center">
                        <h6 class="fw-bold"><?= $fet_pf->fullname; ?></h6>
                    </div>
                    <div class="text-center">
                        <h6>ประเภทผู้ใช้: ไรเดอร์</h6>
                    </div>
            </div>
        </div>
    </div>
</div>


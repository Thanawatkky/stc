<?php 
    $sql_pf = $conn->query("SELECT * FROM tb_user WHERE user_id='".$_SESSION['user_id']."' ");
    $fet_pf = $sql_pf->fetch_object();
?>
<nav class="navbar navbar-expand-lg sticky-top bg-white border-bottom">
    <div class="container-fluid px-3">
        <a href="index.php" class="navbar-brand fw-bold">STC ONLINE</a>
        <button class="navbar-toggler m-2" type="button" data-bs-toggle="collapse" data-bs-target="#Navbar" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="Navbar">
            <ul class="navbar-nav">
                <form action="index.php?p=search" method="post" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="ค้นหาร้านอาหาร" aria-label="Search">
                </form>
                <li class="nav-item mx-2">
                    <a class="nav-link" aria-current="page" href="index.php">หน้าหลัก</a>
                </li>   
                <li class="nav-item mx-2">
                    <?php 
                        $sql_sumcart = $conn->query("SELECT COUNT(ca_id) AS cart_max FROM tb_cart WHERE order_id <= 0 AND ca_user = '".$_SESSION['user_id']."' ");
                        $fet_sumcart = $sql_sumcart->fetch_object();
                    ?>
                    <a class="nav-link position-relative" href="index.php?p=cart">ตะกร้าสินค้า
                    <span class="position-absolute top-2 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php
                            echo  $fet_sumcart->cart_max;
                        ?>
                    </span>
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="index.php?p=history">ประวัติการสั่งซื้อ</a>
                </li>
                <li class="nav-item dropstart">
                    <img data-bs-toggle="dropdown" type="button" width="40" height="40" src="..\img\profile/<?= $fet_pf->user_img; ?>" alt="">

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="index.php?p=profile">แก้ไขข้อมูลส่วนตัว</a>
                        </li>
                        <li>
                            <a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่ไหม?')" class="dropdown-item">ออกจากระบบ</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
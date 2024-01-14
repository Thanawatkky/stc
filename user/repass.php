<div class="col">
    <div class="col-10 m-auto rounded-3 card mt-5 border-0">
        <div class="text-center pt-3">
            <h4 class="fw-bold">แก้ไขรหัสผ่าน</h4>
        </div>

        <div class="px-3">
            <form class="px-4" action="../api/ac_repass.php?ac=repass" method="post" id="frm_repass">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                        <div class="mt-2">
                            <label class="form-label" for="">ชื่อผู้ใช้</label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?= $_SESSION['username']; ?>" readonly>
                        </div>
                        <div class="mt-2">
                            <label class="form-label" for="">รหัสผ่านปัจจุบัน</label>
                            <input class="form-control" type="password" name="oldpass" id="oldpass" placeholder="รหัสผ่านปัจจุบัน">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                        <div class="mt-2">
                            <label class="form-label" for="">รหัสผ่านใหม่</label>
                            <input class="form-control" type="password"  name="newpass" id="newpass" placeholder="รหัสผ่านที่ต้องการจะเปลี่ยน">
                        </div>
                        <div class="mt-2">
                            <label class="form-label" for="">ยืนยันรหัสผ่านใหม่</label>
                            <input class="form-control" type="password"  name="compass" id="compass" placeholder="ยืนยันรหัสผ่านที่ต้องการจะเปลี่ยน">
                        </div>

                    </div>
                </div>

                <div class="text-center py-4">
                    <button class="btn btn-outline-dark w-25 mx-1" onclick="window.location.replace('index.php?p=profile');">ยกเลิก</button>
                    <button class="btn btn-outline-success w-25 mx-1" type="submit">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</div>
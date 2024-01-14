<div class="col">

    <div class="col-10 m-auto rounded-3 card mt-2 border-0">

        <div class="text-center pt-3">
            <img width="150" height="150" class="rounded-circle"
                src="../img/profile/<?= $fet_pf->user_img; ?>" alt="">
            <h4 class="">แก้ไขข้อมูลส่วนตัว</h4>
        </div>

        <div class="px-3">
            <form class="px-4" action="../api/ac_profile.php?ac=edit" method="post" enctype="multipart/form-data" id="frm_profile">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                        <div class="mt-2">
                            <label class="form-label" for="">ชื่อผู้ใช้</label>
                            <input class="form-control" type="text" value="<?= $fet_pf->username; ?>" name="username" id="username"
                                placeholder="Username" readonly>
                        </div>
                        <div class="mt-2">
                            <label class="form-label" for="">ชื่อ-สกุล</label>
                            <input class="form-control" value="<?= $fet_pf->fullname; ?>" type="text" name="fullname" id="fullname"
                                placeholder="Fullname">
                        </div>
                        <div class="mt-2">
                            <label class="form-label" for="">เบอร์โทรศัพท์</label>
                            <input class="form-control" value="<?= $fet_pf->tel; ?>" type="tel" pattern="[0-9]{10}" name="tel" id="tel"
                                placeholder="Tel">
                        </div>

                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                        <div class="mt-2">
                            <label class="form-label" for="">ที่อยู่</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="4"
                                placeholder="Address"><?= $fet_pf->address; ?></textarea>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" for="">รูปโปรไฟล์</label>
                            <input class="form-control" type="file" name="user_img" id="user_img">
                        </div>
                    </div>
                </div>

                <div class="text-center py-4">
                    <p>ต้องการเปลี่ยนรหัสผ่าน? <a class="text-decoration-none" href="index.php?p=repass">คลิ๊ก!</a></p>

                    <button class="btn btn-outline-dark w-25 mx-1" type="button" onclick="window.location.replace('index.php');">ยกเลิก</button>
                    <button class="btn btn-outline-success w-25 mx-1" type="submit">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</div>
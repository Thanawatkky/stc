<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>STC ONLINE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div id="loader" class="vh-100 d-flex justify-content-center align-items-center position-relative opacity-25 hidden" style="background-color: #ccc;">
        <div class="spinner-border text-secondary m-auto d-block" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
        <div class="container mt-1 rounded" id="content">
            <div class="row shadow">
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 p-0">
                    <img class="w-100 h-100 rounded object-fit-cove" src="img/background/5214643.jpg" alt="">
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 px-4 shadow-sm">
                    
                            <div id="alert" class="d-none alertMsg">
                                    <p id="txt" class="text-center px-5 py-2"></p>
                            </div>

                    <h3 class="text-center fw-bold pt-3 pb-2">ลงทะเบียน</h3>
                    <form action="api/ac_register.php?ac=regis" id="frm_regis" method="post" enctype="multipart/form-data">
                        <div class="form-floating mt-1">
                            <input class="form-control" type="text" name="username" id="username" placeholder="username">
                            <label for="" class="form-label">ชื่อผู้ใช้</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input class="form-control" type="text" name="fullname" id="fullname" placeholder="fullname">
                            <label for="" class="form-label">ชื่อ-สกุล</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input class="form-control" type="password" name="password" id="password" placeholder="password">
                            <label for="" class="form-label">รหัสผ่าน</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea class="form-control" name="address" id="address" placeholder="address" cols="30" rows="10"></textarea>
                            <label for="" class="form-label">ที่อยู่</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input class="form-control" type="tel" pattern="[0-9]{10}" name="tel" id="tel" placeholder="tel">
                            <label for="" class="form-label">เบอร์โทรศัพท์</label>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label px-3">รูปโปรไฟล์</label>
                            <input class="form-control" type="file" name="user_img" id="user_img" placeholder="profile">
                        </div>

                        <div class="mt-3 text-center">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="user_role" id="user_role" class="form-check-input" value="2">
                                <label for="" class="form-check-label">ผู้ใช้งานทั่วไป</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="user_role" id="user_role" class="form-check-input" value="3">
                                <label for="" class="form-check-label">ร้านอาหาร</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="user_role" id="user_role" class="form-check-input" value="4">
                                <label for="" class="form-check-label">ผู้จัดส่งอาหาร</label>
                            </div>
                        </div>
                                
                        <div class="text-center py-3">
                            <p>มีบัญชีอยู่แล้วใช่ไหม? <a class="text-decoration-none" href="login.php">เข้าสู่ระบบเลย</a></p>
                            <button type="submit" class="btn btn-outline-primary w-75">ลงทะเบียน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
           $(document).ready(function() {
            $("#content").addClass("d-none");
            setTimeout(() => {
                $("#content").removeClass("d-none");
                $("#loader").addClass("d-none");
            }, 800);
        })
        $(document).on("submit","#frm_regis",function(){
            let url = $(this).attr("action");
            let data = new FormData(this);
            $.ajax({
                url: url,
                type: $(this).attr("method"),
                dataType: "json",
                data: data,
                processData: false,
                contentType: false,
                success:(data,status) => {
                    if (data.status) {
                      if (data.role === "3" ) {
                            window.location.replace("shopdetails.php");
                      }else{
                        alertMsg(data.alertMsg, data.type)
                        setTimeout(function(){
                            window.location.replace("login.php");
                        }, 3000);

                      }  
                    } else{
                        if (data.msg === "haved") {
                            alertMsg(data.alertMsg, data.type);
                        }
                    }
                },error: (err) => {
                    console.log(err);
                }
            })
            
            return false;
        });
    </script>

</body>
</html>
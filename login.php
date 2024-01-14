<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>STC ONLINE</title>
</head>
<body>
<div id="loader" class="vh-100 d-flex justify-content-center align-items-center position-relative opacity-25 hidden" style="background-color: #ccc;">
        <div class="spinner-border text-secondary m-auto d-block" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="container m-auto" id="content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 pt-1 m-auto display">
                <img width="100%" height="550" class="img-brand object-fit-cover" src="img/background/6206973.jpg" alt="">
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 pt-5 card border-0 rounded-3 shadow m-auto">
                <div class="d-sm-none">
                    <img class="img-fluid rounded-4" src="img/background/people-taking-photos-food.jpg" alt="">
                </div>
            <div class="text-center pt-5">
                    <h3 class="fw-bolder">เข้าสู่ระบบ</h3>
                </div>
                <div class="px-5 mt-4">
                <div id="alert" class="d-none alertMsg">
                        <p id="txt" class="text-center px-5 py-2"></p>
                </div>
                    <form class="needs-" action="api/ac_login.php?ac=login" method="post" id="frm_login">
                        <div class="form-floating mt-3">
                            <input class="form-control" type="text" name="username" id="username" placeholder="username">
                            <label for="" class="form-label">ชื่อผู้ใช้</label>
                        </div>
                        
                        <div class="form-floating mt-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="password">
                            <label for="" class="form-label">รหัสผ่าน</label>
                        </div>
                        <div class="row pt-1">
                            <div class="col">
                                <div class="text-start form-check">
                                    <input class="form-check-input" type="checkbox" name="sh_p" onclick="showPass()" id="sh_p">
                                    <small class="form-check-label text-muted">แสดงรหัสผ่าน</small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <small class="mx-1"><a class="text-decoration-none text-muted" href="forgotpass.php">ลืมรหัสผ่าน?</a></small>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4 d-grid">
                                <p>ไม่มีรหัสผ่านใช่ไหม? <a class="text-decoration-none text-primary" href="register.php">สมัครใช้งาน</a></p>
                                <button type="submit" class="btn btn-primary btn-grid text-white mb-5 shadow">เข้าสู่ระบบ</button>
                            </div>
                    </form>
                </div>
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
        $(document).on("submit","#frm_login",function() {
            let url = $(this).attr("action");
            let data = new FormData(this);
            $.ajax({
                url: url,
                type: $(this).attr("method"),
                dataType: "json",
                data: data,
                processData: false,
                contentType: false,
                success: function(data, status){
                    if (data.status) {
                            window.location.replace(data.role+"/index.php");
                    }else{
                        alertMsg(data.alertMsg, data.type);
                    }
                },error:function(err) {
                    console.log(err);
                }
            })
            return false;
        })
    </script>
</body>
</html>
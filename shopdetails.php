<?php 
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>STC ONLINE</title>
</head>
<body>
        <div class="container mt-5 rounded">
        <div id="alert" class="d-none alertMsg">
                <p id="txt" class="text-center px-5 py-2"></p>
        </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 p-0">
                    <img class="w-100 h-100 rounded" src="https://mastercms.alhilalgroup.com/source/TA/2023/10/18/TA_20231018232544066_414711.jpg" alt="">
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 mt-5 px-4">
                    <h3 class="text-center fw-bold pt-3 pb-2">ข้อมูลร้านอาหาร</h3>

                    <form action="api/ac_register.php?ac=nextStep" method="post" id="frm_shopDetail">
                        <div class="form-floating mt-4">
                            <input class="form-control" type="text" name="shop_name" id="shop_name" placeholder="ชื่อร้านอาหาร">
                            <label for="" class="form-label">ชื่อร้านอาหาร</label>
                        </div>
                        <div class="mt-4">
                            <select class="form-select py-3" name="shop_type" id="shop_type">
                                <option disible>เลือกประเภทร้านอาหาร</option>
                                <?php 
                                    $sql = $conn->query("SELECT * FROM tb_shop_type");
                                    while ($fet = $sql->fetch_object()) {
                                      
                                ?>
                                <option value="<?= $fet->type_id; ?>"><?= $fet->type_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                                                        
                        <div class="text-center pt-5">
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
        $(document).on("submit","#frm_shopDetail",function() {
            let url = $(this).attr("action");
            let data = new FormData(this);
            $.ajax({
                url: url,
                type: $(this).attr("method"),
                dataType: "json",
                data: data,
                processData: false,
                contentType: false,
                success:function(data, status){
                    if (data.status) {
                        alertMsg(data.alertMsg, data.type);
                        setTimeout(function(){
                            window.location.replace("login.php");
                        }, 3000);
                    }else{
                        console.log(data.msg);
                    }
                },error:function(err) {
                    console.log(err);
                }
            })
            return false;
        });
    </script>
</body>
</html>
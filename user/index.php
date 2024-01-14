<?php 
session_start();
    include '../connect.php';
    include '../api/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../icon/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>STC ONLINE</title>
</head>
<body class="bg-light">
<div id="alert" class="d-none alertMsg">
                <p id="txt" class="text-center px-5 py-2"></p>
            </div>
    <!-- <div id="preLoading" class="vh-100 d-flex justify-content-center align-items-center position-relative opacity-25" style="background-color: #ccc;">
        <div class="spinner-border text-secondary m-auto d-block" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div id="loader" class="vh-100 d-flex justify-content-center align-items-center position-relative opacity-25 hidden" style="background-color: #ccc;">
        <div class="spinner-border text-secondary m-auto d-block" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

      <div id="content">
      <?php 
            include('navbar.php');
        ?>

        <?php 
            if (isset($_REQUEST['p'])) {
                include($_REQUEST['p']. '.php');
            }else {
        ?>

        <?php 
            include('dashboard.php');
        }
        ?>
      </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
               $(document).ready(function() {
            $("#content").addClass("d-none");
            setTimeout(() => {
                $("#content").removeClass("d-none");
                $("#loader").addClass("d-none");
            }, 800);
        })
            $(document).on("click","#btn-plus",function() {
                let id = $(this).data("id");
                $.ajax({
                    url: "../api/ac_cart.php?ac=add_qty",
                    type: "post",
                    dataType: "json",
                    data: {
                        ca_id: id
                    },success:function(data,status) {
                        if (data.status) {
                            window.location.reload();
                        }else{
                            console.log(data.msg);
                        }
                    }  
                })
                return false;
            })
            $(document).on("click","#btn-delCart",function() {
                let id = $(this).data("id");
                $.ajax({
                    url: "../api/ac_cart.php?ac=delCart",
                    type: "post",
                    dataType: "json",
                    data: {
                        ca_id: id
                    },success:function(data,status) {
                        if (data.status) {
                            alertMsg(data.alertMsg, data.type);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }else{
                            console.log(data.msg);
                        }
                    },error:function(err) {
                        console.log(err);
                    }
                })
                return false;
            })


            $(document).on("click","#btn-dash",function() {
                let id = $(this).data("id");
                $.ajax({
                    url: "../api/ac_cart.php?ac=del_qty",
                    type: "post",
                    dataType: "json",
                    data: {
                        ca_id: id
                    },success:function(data,status) {
                        if (data.status) {
                            window.location.reload();
                        }else{
                            console.log(data.msg);
                        }
                    }  
                })
                return false;
            })
        $(document).on("click","#btn-cart",function() {
            let pro_id = $(this).data('id')
            let shop_id = $(this).data('shop')
            $.ajax({
                url: "../api/ac_cart.php?ac=add",
                type: "post",
                dataType: "json",
                data: {
                    pro_id: pro_id,
                    shop_user: shop_id
                },success:function(data) {
                    if (data.status) {
                        alertMsg(data.alertMsg, data.type);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }else{
                        console.log(data.msg)
                    }
                },error:function(err) {
                    console.log(err);
                }
            })
            return false;
        })

    $(document).on("submit","#frm_profile",function() {
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
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }else{
                console.log(data.msg);
            }
        },error:function(err){
            console.log(err);
        }
    })
    return false;
})
$(document).on("submit","#frm_repass",function() {
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
                setTimeout(() => {
                    window.location.reload()
                }, 2000);
            }else{
                alertMsg(data.alertMsg, data.type);
                setTimeout(() => {
                    window.location.reload()
                }, 2000);
            }
        },error:function(err) {
            console.log(err);
        }
    })
    return false;
})
$(document).on('click','#btn-confirm',function() {
    let total = $(this).data('total')
    let shop = $(this).data('shop')
    $.ajax({
        url: "../api/ac_order.php?ac=add",
        type: "get",
        dataType: "json",
        data: {
            total_price: total,
            shop_user: shop
        
        },success:function(data) {
            if (data.status) {
                alertMsg(data.alertMsg, data.type);
                setTimeout(() => {
                    window.location.replace('index.php?p=history');
                }, 2000);
            }
        },error:function(err) {
            console.log(err);
        }
    })
})
$(document).on("click","#btn-review",function() {
    $("#re_product1").val($(this).data("pro"))
    $("#re_shop1").val($(this).data("shop"))
    $("#re_order1").val($(this).data("id"))
    return false;
})
$(document).on("submit","#frm_review",function() {
    let url = $(this).attr("action");
    let data = new FormData(this);
    $.ajax({
        url: url,
        type: $(this).attr("method"),
        dataType: "json",
        data: data,
        processData: false,
        contentType: false,
        success:function(data){
            if (data.status) {
                alertMsg(data.alertMsg, data.type);
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            }else{
                console.log(data);
            }
        }
    })
    return false;
})
    </script>
</body>
</html>
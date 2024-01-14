<?php 
session_start();
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'edit':
                if ($_FILES['user_img']['name'] != "") {
                    $file = $_FILES['user_img']['name'];
                    move_uploaded_file($_FILES['user_img']['tmp_name'],"../img/profile/".$file);
                }else{
                    $sql_img = $conn->query("SELECT user_img FROM tb_user WHERE user_id='".$_SESSION['user_id']."' ");
                    $fet_img = $sql_img->fetch_object();
                    $file = $fet_img->user_img;
                }
                $sql = $conn->query("UPDATE tb_user SET fullname='".$_REQUEST['fullname']."',address='".$_REQUEST['address']."',tel='".$_REQUEST['tel']."',user_img='".$file."' WHERE user_id='".$_SESSION['user_id']."' ");
                if ($sql) {
                    echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"แก้ไขข้อมูลส่วนตัวสำเร็จ","type"=>"success"),JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode(array("status"=>false,"msg"=>"{$conn->error}"));
                break;
                }
        }
    }
?>
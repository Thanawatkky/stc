<?php 
    session_start();
    include '../connect.php';
    $sql = $conn->query("INSERT INTO tb_review(re_point, re_detail, re_user, re_product, re_order, re_shop) VALUES('".$_REQUEST['re_point']."','".$_REQUEST['re_detail']."','".$_SESSION['user_id']."','".$_REQUEST['re_product']."','".$_REQUEST['re_order']."','".$_REQUEST['re_shop']."')");
    if ($sql) {
        echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"รีวิวสำเร็จ", "type"=>"success"));
    }else{
        echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"));
    }
?>
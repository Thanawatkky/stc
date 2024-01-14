<?php
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'app-user':
                $sql = $conn->query("UPDATE tb_user SET user_status = 1 WHERE user_id='".$_REQUEST['user_id']."' ");
                if ($sql) {
                    echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"อนุมัติการเข้าใช้งานสำเร็จ", "type"=>"success"));
                }else{
                    echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"));
                }
                break;
            case 'block-user':
                $sql = $conn->query("UPDATE tb_user SET user_status = 2 WHERE user_id='".$_REQUEST['user_id']."' ");
                if ($sql) {
                    echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"ระงับการเข้าใช้งานสำเร็จ", "type"=>"success"));
                }else{
                    echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"));
                }
                break;
            
        }
    }
?>
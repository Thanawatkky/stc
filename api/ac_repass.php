<?php 
    session_start();
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'repass':
                $sql = $conn->query("SELECT * FROM tb_user WHERE user_id='".$_SESSION['user_id']."'");
                $fet = $sql->fetch_object();
                if ($_REQUEST['newpass'] != $_REQUEST['compass']) {
                    echo json_encode(array("status"=>false,"msg"=>"failed","alertMsg"=>"รหัสผ่านไม่ตรงกัน","type"=>"error"),JSON_UNESCAPED_UNICODE);
                }else{
                    if (password_verify($_REQUEST['oldpass'],$fet->password)) {
                        $hash = password_hash($_REQUEST['newpass'],PASSWORD_BCRYPT);
                        $sql_update = $conn->query("UPDATE tb_user SET password='".$hash."' WHERE user_id='".$_SESSION['user_id']."' ");
                        if ($sql_update) {
                            echo json_encode(array("status"=>true,"msg"=>"OK","alertMsg"=>"เปลี่ยนรหัสผ่านสำเร็จ","type"=>"success"),JSON_UNESCAPED_UNICODE);
                        }else{
                            echo json_encode(array("status"=>false,"msg"=>"failed","alertMsg"=>"{$conn->error}","type"=>"error"),JSON_UNESCAPED_UNICODE);
                        }
                    }else{
                        echo json_encode(array("status"=>false,"msg"=>"failed","alertMsg"=>"รหัสผ่านไม่ถูกต้อง","type"=>"error"),JSON_UNESCAPED_UNICODE);
                    }
                }
                break;
        }
    }
?>
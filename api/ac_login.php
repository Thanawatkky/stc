<?php 
session_start();
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'login':
                $sql = $conn->query("SELECT * FROM tb_user WHERE username='".$_REQUEST['username']."' ");
                $fet = $sql->fetch_object();
                $num = $sql->num_rows;
                if ($num <= 0) {
                    echo json_encode(array("status" => false, "msg"=>"user", "alertMsg" => "Username ไม่ถูกต้อง", "type" => "error"), JSON_UNESCAPED_UNICODE);
                }else{
                    if (password_verify($_REQUEST['password'], $fet->password)) {
                        if ($fet->user_status == 0) {
                            echo json_encode(array("status" => false, "msg"=>"noapp", "alertMsg" => "รอการอนุมัติการเข้าใช้งาน","type" => "error"), JSON_UNESCAPED_UNICODE);
                        }else if($fet->user_status == 1) {
                            $_SESSION['user_id'] = $fet->user_id;
                            $_SESSION['username'] = $fet->username;
                            $_SESSION['fullname'] = $fet->fullname;
                            $_SESSION['address'] = $fet->address;
                            $_SESSION['tel'] = $fet->tel;
                            if ($fet->user_role == 1) {
                                echo json_encode(array("status" => true, "msg" => "admin", "alertMsg" => "ยินดีต้อนรับ Admin", "type" => "success", "role" => "admin"), JSON_UNESCAPED_UNICODE);
                            }else if ($fet->user_role == 3) {
                                echo json_encode(array("status" => true, "msg" => " shop", "alertMsg" => "ยินดีต้อนรับเข้าใช้งาน", "type" => "success", "role" => "shop"), JSON_UNESCAPED_UNICODE);
                            }else if($fet->user_role == 4) {
                                echo json_encode(array("status" => true, "msg" => " rider", "alertMsg" => "ยินดีต้อนรับเข้าใช้งาน", "type" => "success", "role" => "rider"), JSON_UNESCAPED_UNICODE);
                            }else{
                                echo json_encode(array("status" => true, "msg" => " user", "alertMsg" => "ยินดีต้อนรับเข้าใช้งาน", "type" => "success", "role" => "user"), JSON_UNESCAPED_UNICODE);
                            }
                        }else{
                            echo json_encode(array("status" => false, "msg" => "block", "alertMsg" => "บัญชีของคุณโดนระงับการเข้าใช้งานชั่วคราว", "type" => "error"), JSON_UNESCAPED_UNICODE);
                        }
                    }else{
                        echo json_encode(array("status" => false, "msg"=>"nopsss", "alertMsg" => "รหัสผ่านไม่ถูกต้อง", "type" => "error"),JSON_UNESCAPED_UNICODE);
                    }
                }
                break;
        }
    }

?>
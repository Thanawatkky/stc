<?php 
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'regis':
                    if ($_FILES['user_img']['name'] != "") {
                        $file = $_FILES['user_img']['name'];
                        move_uploaded_file($_FILES['user_img']['tmp_name'],"../img/profile/".$file);
                    }else{
                        $file = "avatar.jpg";
                    }
                    $sql_check = $conn->query("SELECT username FROM tb_user WHERE username='".$_REQUEST['username']."'");
                    $num = $sql_check->num_rows;
                    
                    if ($num <= 0) {
                        $hash = password_hash($_REQUEST['password'],PASSWORD_BCRYPT);
                        $sql = $conn->query("INSERT INTO tb_user(fullname, username, password, address, tel, user_img, user_role) VALUES('".$_REQUEST['fullname']."','".$_REQUEST['username']."','".$hash."','".$_REQUEST['address']."','".$_REQUEST['tel']."','".$file."','".$_REQUEST['user_role']."') ");
                        
                        if ($sql) {
                            if($_REQUEST['user_role'] == 3) {
                                $Msg="สมัครขั้นตอนสุดท้าย";
                            }else{
                                $Msg="สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบก่อนเข้าใช้งาน";
                            }
                            echo json_encode(array("status" => true, "msg" => "OK", "alertMsg"=>"{$Msg}","type" => "success","role"=>"{$_REQUEST['user_role']}"), JSON_UNESCAPED_UNICODE);
                        }else{
                            echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"),JSON_UNESCAPED_UNICODE);
                        } 

                    }else{
                        echo json_encode(array("status"=>false, "msg"=>"haved","alertMsg"=>"มีusernameดังกล่าวอยู่ในระบบแล้วกรุณาลองใหม่อีกครั้ง","type"=>"error"),JSON_UNESCAPED_UNICODE);
                    }
                break;
                case 'nextStep':
                    $sql_ch = $conn->query("SELECT MAX(user_id) AS user_max FROM tb_user WHERE user_role=3");
                    $fet_ch = $sql_ch->fetch_object();
                    $sql = $conn->query("INSERT INTO tb_shop(shop_name,user_id,shop_type) VALUES('".$_REQUEST['shop_name']."','".$fet_ch->user_max."','".$_REQUEST['shop_type']."') ");
                    if ($sql && $sql_ch) {
                        echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"สมัครสมาชิกสำหรับร้านอาหารสำเร็จ","type"=>"success"),JSON_UNESCAPED_UNICODE);
                    }else{
                        echo json_encode(array("status"=>false,"msg"=>"{$conn->error}"));
                    }
                    break;
        }
    }
?>
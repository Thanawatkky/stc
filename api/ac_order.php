<?php 
session_start();
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'add':
                $sql = $conn->query("INSERT INTO tb_order(cus_name,total_price,shop_user,order_date) VALUES('".$_SESSION['user_id']."','".$_REQUEST['total_price']."','".$_REQUEST['shop_user']."',now()) ");
                if ($sql) {
                    $sql_max = $conn->query("SELECT MAX(order_id) AS order_max FROM tb_order WHERE cus_name='".$_SESSION['user_id']."' ");
                    $fet_max = $sql_max->fetch_object();
                    if ($sql_max) {
                        $sql_update = $conn->query("UPDATE tb_cart SET order_id='".$fet_max->order_max."' WHERE ca_user='".$_SESSION['user_id']."' AND order_id = 0 ");
                        if ($sql_update) {
                            echo json_encode(array("status" => true, "msg"=>"OK", "alertMsg"=>"สั่งซื้อรายการอาหารของคุณเรียบร้อยแล้ว กรุณารอร้านทำอาหารสักครู่", "type" => "success"));
                        }else{
                            echo json_encode(array("status" => false, "msg"=>"{$conn->error}"));
                        }
                    }else{
                        echo json_encode(array("status" => false, "msg"=>"{$conn->error}"));
                    }
                }else{
                    echo json_encode(array("status" => false, "msg"=>"{$conn->error}"));
                }
                break;
                case 'shopCon':
                    $sql = $conn->query("UPDATE tb_order SET order_status = 2 WHERE order_id = '".$_REQUEST['order_id']."' ");
                    if($sql) {
                        echo json_encode(array("status"=>true, "alertMsg"=>"ยืนการทำอาหารสำเร็จ","type"=>"success"));
                    }else{
                        echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"));
                    }
                    break;
                    case 'riderOrder':
                        $sql = $conn->query("UPDATE tb_order SET order_status = 1,r_id='".$_SESSION['user_id']."' WHERE order_id='".$_REQUEST['order_id']."' ");
                        if($sql) {
                            echo json_encode(array("status"=>true, "alertMsg"=>"ยืนยันการรับออเดอร์สำเร็จ","type"=>"success"));
                        }else{
                            echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"));
                        }
                        break;
                    case 'success':
                        $sql = $conn->query("UPDATE tb_order SET order_status = 3 WHERE order_id='".$_REQUEST['order_id']."' ");
                        if($sql) {
                            echo json_encode(array("status"=>true, "alertMsg"=>"ยืนยันการรับออเดอร์สำเร็จ","type"=>"success"));
                        }else{
                            echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"));
                        }
                        break;
        }
    }
?>
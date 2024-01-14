<?php 
session_start();
    include "../connect.php";
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'add':
                $sql = $conn->query("SELECT ca_product FROM tb_cart WHERE ca_product='".$_REQUEST['pro_id']."' AND order_id <= 0 ");
                $num = $sql->num_rows;
                if($num <= 0) {
                    $sql_add1 = $conn->query("INSERT INTO tb_cart(ca_product,ca_user,ca_shop,ca_qty) VALUES('".$_REQUEST['pro_id']."','".$_SESSION['user_id']."','".$_REQUEST['shop_user']."',1) ");
                    if ($sql_add1) {
                       echo json_encode(array("status"=>true,"alertMsg"=>"เพิ่มสินค้าเข้าตะกร้าของคุณแล้ว","type"=>"success"));
                    }else{
                        echo json_encode(array("status"=>false,"msg"=>"{$conn->error}"));
                    }
                }else{
                    $sql_add = $conn->query("UPDATE tb_cart SET ca_qty=ca_qty+1 WHERE ca_user='".$_SESSION['user_id']."' AND ca_product='".$_REQUEST['pro_id']."' ");
                    if ($sql_add) {
                        echo json_encode(array("status" => true, "alertMsg" => "เพิ่มสินค้าเข้าตะกร้าของคุณแล้ว", "type" => "success"),JSON_UNESCAPED_UNICODE);
                    }else{
                        echo json_encode(array("status" => false, "msg" => "{$conn->error}"));
                    }
                }
                break;
                case 'add_qty':
                    $sql = $conn->query("UPDATE tb_cart SET ca_qty=ca_qty+1 WHERE ca_id='".$_REQUEST['ca_id']."' ");
                    if ($sql) {
                            echo json_encode(array("status"=>true));
                    }else{
                        echo json_encode(array("status"=>true, "msg"=>"{$conn->error}"));
                    }
                    break;
                case 'del_qty':
                    $sql = $conn->query("UPDATE tb_cart SET ca_qty=ca_qty-1 WHERE ca_id='".$_REQUEST['ca_id']."' ");
                    if ($sql) {
                            echo json_encode(array("status"=>true));
                    }else{
                        echo json_encode(array("status"=>true, "msg"=>"{$conn->error}"));
                    }
                    break;
                    case 'delCart':
                        $sql = $conn->query("DELETE FROM tb_cart WHERE ca_id='".$_REQUEST['ca_id']."' ");
                        if ($sql) {
                            echo json_encode(array("status"=>true,"msg"=>"Ok","alertMsg"=>"ลบรายการสินค้าออกจากตะกร้าของคุณแล้ว","type"=>"success"));
                        }else{
                            echo json_encode(array("status"=>true, "msg"=>"{$conn->error}"));
                        }
                        break;
        }
    }
?>
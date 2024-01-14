<?php 
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'add':
                $sql = $conn->query("INSERT INTO tb_shop_type(type_name, detail) VALUES('".$_REQUEST['type_name']."','".$_REQUEST['detail']."') ");
                if ($sql) {
                    echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"เพิ่มประเภทร้านอาหารสำเร็จ", "type"=>"success"),JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"),JSON_UNESCAPED_UNICODE);
                }
                break;
                case 'edit':
                    $sql = $conn->query("UPDATE tb_shop_type SET type_name='".$_REQUEST['type_name']."',detail='".$_REQUEST['detail']."' WHERE type_id='".$_REQUEST['type_id']."' ");
                    if ($sql) {
                        echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"แก้ไขประเภทร้านอาหารสำเร็จ", "type"=>"success"),JSON_UNESCAPED_UNICODE);
                    }else{
                        echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"),JSON_UNESCAPED_UNICODE);
                    }
                    break;
                    case 'del':
                        $sql = $conn->query("DELETE FROM tb_shop_type WHERE type_id='".$_REQUEST['type_id']."' ");
                        if ($sql) {
                            echo json_encode(array("status"=>true, "msg"=>"OK", "alertMsg"=>"ลบประเภทร้านอาหารสำเร็จ", "type"=>"success"),JSON_UNESCAPED_UNICODE);
                        }else{
                            echo json_encode(array("status"=>false, "msg"=>"{$conn->error}"),JSON_UNESCAPED_UNICODE);
                        }
                        break;
        }
    }
?>
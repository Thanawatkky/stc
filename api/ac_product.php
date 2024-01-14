<?php
session_start();
    include '../connect.php';
    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'addType':
                if ($_FILES['type_img']['name'] != "") {
                    move_uploaded_file($_FILES['type_img']['tmp_name'],"../img/productType/".$_FILES['type_img']['name']);
                }else{
                    echo json_encode(array("status"=>false,"msg"=>"failed","alertMsg"=>"กรุณาแนบรูป","type"=>"error"));
                }
                $sql = $conn->query("INSERT INTO tb_product_type(type_name,shop_user,type_img) VALUES('".$_REQUEST['type_name']."','".$_SESSION['user_id']."','".$_FILES['type_img']['name']."') ");
                if ($sql) {
                    echo json_encode(array("status"=>true, "msg"=>"OK","alertMsg"=>"เพิ่มประเภทร้านอาหารสำเร็จ","type"=>"success"));
                }else{
                    echo json_encode(array("status"=>false,"msg"=>"{$conn->error}"));
                }

                break;
                case 'add':
                    if ($_FILES['pro_img']['name'] != "") {
                        move_uploaded_file($_FILES['pro_img']['tmp_name'],"../img/product/".$_FILES['pro_img']['name']);
                    }else{
                        echo json_encode(array("status"=>false,"msg"=>"failed","alertMsg"=>"กรุณาแนบรูป","type"=>"error"));
                    }
                    $sql = $conn->query("INSERT INTO tb_product(pro_name,pro_detail,pro_price,pro_sale,pro_type,pro_img,shop_user) VALUES('".$_REQUEST['pro_name']."','".$_REQUEST['pro_detail']."','".$_REQUEST['pro_price']."','".$_REQUEST['pro_sale']."','".$_REQUEST['pro_type']."','".$_FILES['pro_img']['name']."','".$_SESSION['user_id']."') ");
                    if ($sql) {
                        echo json_encode(array("status"=>true, "alertMsg"=>"เพิ่มรายการอาหารสำเร็จ","type"=>"success"));
                    }else{
                        echo json_encode(array("status"=>false,"msg"=>"{$conn->error}","type"=>"success"));
                    }
                    break;
                case 'edit':
                    if ($_FILES['pro_img']['name'] != "") {
                        $file=$_FILES['pro_img']['name'];
                        move_uploaded_file($_FILES['pro_img']['tmp_name'],"../img/product/".$file);
                    }else{
                        $sql_img = $conn->query("SELECT pro_img FROM tb_product WHERE pro_id='".$_REQUEST['pro_id']."'");
                        $fet_img = $sql_img->fetch_object();
                        $file = $fet_img->pro_img;
                    }
                    $sql = $conn->query("UPDATE tb_product SET pro_name='".$_REQUEST['pro_name']."',pro_detail='".$_REQUEST['pro_detail']."',pro_price='".$_REQUEST['pro_price']."',pro_sale='".$_REQUEST['pro_sale']."',pro_type='".$_REQUEST['pro_type']."',pro_img='".$file."' WHERE pro_id='".$_REQUEST['pro_id']."' ");
                    if ($sql) {
                        echo json_encode(array("status"=>true, "alertMsg"=>"แก้ไขรายการอาหารสำเร็จ","type"=>"success"));
                    }else{
                        echo json_encode(array("status"=>false,"msg"=>"{$conn->error}"));
                    }
                    break;
                    case 'del':
                        $sql = $conn->query("DELETE FROM tb_product WHERE pro_id='".$_REQUEST['pro_id']."' ");
                        if ($sql) {
                            echo json_encode(array("status"=>true, "alertMsg"=>"ลบรายการอาหารสำเร็จ","type"=>"success"));
                        }else{
                            echo json_encode(array("status"=>false,"msg"=>"{$conn->error}","type"=>"success"));
                        }
                        break;
                        case 'addSale':
                           $sql = $conn->query("UPDATE tb_product SET pro_sale='".$_REQUEST['pro_sale']."' WHERE pro_id='".$_REQUEST['pro_id']."' ");
                           if ($sql) {
                            echo json_encode(array("status"=>true, "alertMsg"=>"กำหนดส่วนลดสำเร็จ","type"=>"success"));
                            }else{
                                echo json_encode(array("status"=>false,"msg"=>"{$conn->error}","type"=>"success"));
                            }
                            break;
        }
    }
?>
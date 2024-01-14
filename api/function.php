<?php 
    function status($status, $role) {
        if ($status == 0) {
            echo "รอการอนุมัติการเข้าใช้งาน";
        }else if($status == 1) {
            echo "อนุมัติการเข้าใช้งานแล้ว";
        }else{
            if ($role == 2) {
                echo "ระงับการเข้าใช้งานชั่วคราว";
            }else{
                echo "ยกเลิกการเข้าใช้งาน";
            }
        }
    }
    function showSale($sale) {
        if ($sale != 0) {
           echo $sale." %";
        }else{
            echo "ไม่มีส่วนลด";
        }
    }
    function sumsale($price, $sale) {
        $sum = $price - (($price * $sale)/100);
        return $sum;
    }
    function sumtotal($price, $sale,$qty) {
        $sum = $price - (($price * $sale)/100);
        $total = $sum*$qty;
        return $total;
    }

    function orderStatus($status) {
        if ($status == 0) {
            echo "กำลังหาไรเดอร์";
        }else if($status == 1) {
            echo "ร้านกำลังเตรียมอาหาร";
        }else if($status == 2){
            echo "เตรียมอาหารเสร็จสิ้น กำลังนำส่ง";
        }else if($status == 3) {
            echo "ส่งอาหารและชำระเงินเสร็จสิ้น";
        }
    }

?>
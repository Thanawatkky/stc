
<?php
include '../connect.php';
include '../api/function.php';
require_once __DIR__.'/../mpdf/vendor/autoload.php';
$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
$fontDir = $defaultConfig['fontDir'];
$defaultFont = (new \Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFont['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf8',
    'format' => [200, 75],
    'fontDir' => array_merge($fontDir,[
        __DIR__.'/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabun.ttf',
            'B' => 'THSarabun Bold.ttf',
        ],
    ],
    'default_font' => 'sarabun',
]);
$mpdf->AddPage('A4');
$mpdf->WriteHTML('<h1 style="text-align: center; margin-bottom: 20px;>ใบเสร็จการสั่งซื้อ</h1>');
$mpdf->setColumns(2);
$sql = $conn->query("SELECT tb_order.*,tb_user.fullname,tb_user.address,tb_user.tel FROM tb_order LEFT JOIN tb_user ON tb_order.cus_name = tb_user.user_id WHERE tb_order.order_id='".$_REQUEST['order_id']."'");
while($fet = $sql->fetch_object()) {
        $sql_product = $conn->query("SELECT tb_cart.*,tb_product.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id WHERE tb_cart.order_id = '".$fet->order_id."' ");
        while($fet_product = $sql_product->fetch_object()) {
$html = '
            รายการสินค้า:'.$fet_product->pro_name.'
            ราคา:  '.$fet_product->pro_price.' บาท
            จำนวน: '.$fet_product->ca_qty.' ชิ้น
            ส่วนลด: '.showsale($fet_product->pro_sale).' %
            รวม: '.sumtotal($fet_product->pro_price, $fet_product->pro_sale, $fet_product->ca_qty).' บาท
        
    ';
        }
$html1 = '  
            ชื่อ-นามสกุล: '.$fet->fullname.'
            ที่อยู่: '.$fet->address.'
            เบอร์โทรศัพท์: '.$fet->tel.'
            วันที่สั่งซื้อ: '.date("d/m/Y",strtotime($fet->order_date)).'
        
    ';
}
    $mpdf->WriteHTML($html);
    $mpdf->AddColumn();
    $mpdf->WriteHTML($html1);

    $mpdf->Output("bill.pdf", "F");
    ob_end_flush();
?>








































<?php

    // require_once __DIR__.'/../mpdf/vendor/autoload.php';
    // $defaultCon = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    // $font = $defaultCon['fontDir'];
    // $defaultFont = (new \Mpdf\Config\FontVariables())->getDefaults();
    // $fontData = $defaultFont['fontdata'];

    // $mpdf = new \Mpdf\Mpdf([
    //     'mode' => 'utf8',
    //     'format' => [200, 75],
    //     'fontDir' => array_merge($font, [
    //         __DIR__.'/tmp',
    //     ]),
    //     'fontdata' => $fontData + [
    //         'sarabun' => [
    //             'R' => 'THSarabun.ttf',
    //             'B' => 'THSarabun Bold.ttf',
    //         ],
    //     ],
    //     'default_font' => 'sarabun',
    // ]);

    // $mpdf->AddPage("A4");
    // ob_start();
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จ</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            margin: auto;
            align-items: center;
            display: block;
            justify-content: center;
            max-width: 75mm; /* ปรับขนาดหน้ากระดาษเป็น 75mm */
            max-height: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <h4>STC ONLINE</h4>
            <p>ร้านลุงชัย</p>
            <p>ที่อยู่ : วิทยาลัยเทคนิคสุพรรณบุรี</p>
        
        <hr>
        <div>
            <h5>ลูกค้า : ธนวัฒน์ เชื้อหนองปรง
            <p>สถานะ : ชำระเงินแล้ว</p>
            <h4>เวลา 12:40 </h4>
        
        <hr>
        <div>
            <h5>เมนู
            <p>2X</p>
            <p>ข้าวขาหมู THB 40</p>
            <h5>เมนู
            <p>2X</p>
            <p>ข้าวขาหมู THB 40</p>
        
        <hr>
        <div>
            <h4>รวม</h4>
            <h5>THB 60.00
            <h5>ส่วนลด
            <h5>THB 0.00
        
        <hr>
        <div>
            <h2>ทั้งหมด</h2>
            <h1>THB 60.00</h1>
        
    


</body>
</html> -->
<?php 
    // $html = ob_get_contents();
    // $mpdf->WriteHTML($html);
    // $mpdf->Output('bill.pdf', "F");
    // ob_end_flush();
?>
<?php
session_start();
include("config/config.php");
include("config/database.php");
//include("header1.php");   
ini_set('display_errors', 1);
require 'config/vendor/pdfcrowd/pdfcrowd/pdfcrowd.php';
if(empty($_SESSION["username"]))
{
    header("Location:".URL."index.php");
}
if(isset($_GET["id"])){
  $id=(int)$_GET["id"];
}else {
  header("Location:".URL."show_user.php");
}
if(isset($_GET["shippername"])){
  $shippername=$_GET["shippername"];
}
if(isset($_GET["status"])){
  $status=$_GET["status"];
}
if($status !=2){
    header("Location:".URL."order_detail.php?id=".$id."&shippername=".$shippername."&status=".$status);
}

$db = new Database(db_host, db_name, db_username, db_password);
$query="SELECT * FROM order1 WHERE id=".$id;
$result=$db->Select($query);
$data = json_decode($result[0]["cart"],true);


if(!defined('STDERR')) define('STDERR', fopen('php://stderr', 'wb'));
try {
    $client = new \Pdfcrowd\HtmlToPdfClient("username", "apikey");
    $pdf = $client->convertUrl("Location:".URL."makepdf.php?id=".$id."&shippername=".$shippername."&status=".$status);

    header("Content-Type: application/pdf");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: inline; filename=\"e-invoice-.pdf\"");

    echo $pdf;
}
catch(\Pdfcrowd\Error $why) {
    fwrite(STDERR, "Pdfcrowd Error: {$why}\n");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/e-invoice.css">
</head>
<body>

    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
     <?php
        foreach($result as $key => $value){
            echo '<div class="card-header p-4">
            <h1 style="text-align: center;">HÓA ĐƠN ĐIỆN TỬ</h1>
            <div class="float-right">
                <h3 class="mb-0">Hóa đơn số '.$value["id"].' </h3>
                Ngày '.date("d/m/Y",strtotime($value["deliverydate"])).
            '</div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h3 class="mb-3">Đơn vị bán hàng: <strong>Lâm Kim Sơn</strong> </h3>
                    <div>Địa chỉ: 299/30</div>
                    <div>Email: lamkimson1998@gmail.com</div>
                    <div>Điện thoại: (+84)0335678089 </div>
                </div>
                <div class="col-sm-6 ">
                    <h3 class="mb-3">Người mua hàng: <strong>'.$value["name"].'</strong></h3>
                    <div>Địa chỉ: '.$value["address"].'</div>
                    <div>Email: '.$value["email"].'</div>
                    <div>Điện thoại: '.$value["phone"].'</div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h3 class="mb-3">Người giao hàng: <strong>'.$value["shipper"].'</strong> </h3>
                </div>    
            </div>';
        }
        ?>

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">STT</th>
                            <th>Tên hàng</th>
                            <th class="right">Đơn giá</th>
                            <th class="center">Số lượng</th>
                            <th class="right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($data as $key=> $value){
                                $key = $key+1;
                                echo '<tr>
                                <td class="center">'.$key.'</td>
                                <td class="left strong">'.$value["product_name"].'</td>
                                <td class="right">'.number_format($value["product_price"]).'VNĐ</td>
                                <td class="center">'.$value["count1"].'</td>
                                <td class="right">'.number_format($value["product_price"]*$value["count1"]).'</td>
                            </tr>';
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-5 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Tổng cộng</strong> </td>
                                <td class="right" style="text-align:right">
                                    <strong class="text-dark" >
                                    <?php
                                        foreach($result as $key => $value){
                                            echo number_format($value["total"]).' VNĐ';
                                        }
                                    ?>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
                          
    ?>
         

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
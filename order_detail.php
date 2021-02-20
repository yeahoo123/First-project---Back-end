<?php
session_start();
include("config/config.php");
include("config/database.php");
include("header1.php");   
ini_set('display_errors', 1);
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
$mess="";
$db = new Database(db_host, db_name, db_username, db_password);
$query="SELECT cart FROM order1 WHERE id=".$id;
$result=$db->Select($query);
$queryMoney="SELECT * FROM order1 WHERE id=".$id;
$resultMoney=$db->Select($queryMoney);
$data = json_decode($result[0]["cart"],true);
$queryStatic = "SELECT * from statical";
$staticData =$db->Select($queryStatic);

if(isset($_POST["submit"])){
  $sql = "UPDATE order1 set order_check = 1, shipper ='".$_POST["shippername"]."', deliverydate = now() where id=".$id;
  $sql2 = "UPDATE shipper set shipper_status=1 where shippername ='".$_POST["shippername"]."'";
  $result=$db->Update($sql);
  $result2=$db->Update($sql2);
}
if(isset($_POST["submit2"])){
  $sql = "UPDATE order1 set order_check = 2 where id=".$id;
  $sql2 = "UPDATE shipper set shipper_status = 0 where shippername ='".$_GET["shippername"]."'";
  foreach($data as $key=>$value){
    $sql3 = "UPDATE product set product_qty=product_qty-".$value["count1"]." where product_id=".$value["product_id"];
    $result3=$db->Update($sql3);
  }
  if(isset($staticData)){
    
    foreach($resultMoney as $key => $value){
      $insertStatic = "INSERT INTO statical(invesment, collected, create_date) value('".$value["total2"]."','".$value["total"]."','".$value["create_date"]."')";
      $resultStatic = $db->Insert($insertStatic);
    }
  }

  $result=$db->Update($sql);
  $result3=$db->Update($sql2);
  // $result3=$db->Update($sql3);
} 
if(isset($_POST["submit3"])){
  $sql = "UPDATE order1 set order_check = 3, canceldate = now() where id=".$id;
  $sql2 = "UPDATE shipper set shipper_status=0 where shippername ='".$_GET["shippername"]."'";
  $result=$db->Update($sql);
  $result2=$db->Update($sql2);
}
$query2 = "SELECT * from shipper where shipper_status = 0";
$result2=$db->Select($query2);
$query3 = "SELECT * from order1 where id=".$id;
$result3=$db->Select($query3);
    // echo "<pre>";print_r($result2);echo "</pre>";die;
?>
<style>
    .error {
      background: red;
      text-align: center;
  }
  .error-text {
      color: yellow;
      font-size: 18px;
      margin: 0;
  }
  .btn-container{
    display: flex;
  }
  .btn-container div~div {
    margin-left: 10px;
  }
</style>
<div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title" style="display: flex; justify-content: space-between">
                                <h2>Chi tiết đơn hàng</h2>
                                <?php
                                    echo '<a href="'.URL.'show_order.php">Trở về</a>';
                                ?> 
                                <div class="clearfix" style="position: absolute; right: 0"></div>
                            </div>
                            <div class="x_content">
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th>Mã sản phẩm</th>
              <th>Tên danh mục</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng mua</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($data){
            foreach($data as $key=> $value){
                $key = $key+1;
                echo '<tr>
                <td style="text-align: center">'.$key.'</td>
                <td style="text-align: center">'.$value["product_id"].'</td>
                <td style="text-align: center">'.$value["category_name"].'</td>
                <td>'.$value["product_name"].'</td>
                <td style="text-align: center">'.$value["count1"].'</td>
                <td style="text-align: right">'.number_format($value["product_price"]).'VNĐ</td>
                <td style="text-align: right">'.number_format($value["product_price"]*$value["count1"]).'VNĐ</td>
              </tr>';
            }
          }else{
              echo '<tr><td colspan="11" align="center">Không có dữ liệu</td></tr>';
          }
          
            ?>
          </tbody>
        </table>
        <p style="text-align: end;">Tổng cộng:
          <?php
            $sql1="SELECT total from order1 where id=".$id;
            $total=$db->Select($sql1);
            // echo "<pre>";print_r($total);echo "</pre>";die;
            foreach($total as $key => $value)
            echo number_format($value["total"])."VNĐ";
          ?>
      </p>
        <form action="" method="POST" class="btn-container <?php
          foreach($result3 as $key =>$value){
            if($value["order_check"]==2 ||$value["order_check"]==3){
              echo "hidden";
            }
          }
        ?>">
          <div style="display: flex" class="<?php
            foreach($result3 as $key =>$value){
              if($value["order_check"]==1){
                echo "hidden";
              }
            }
          ?>">
            <div class="form-group">
              <label for="shippername">Người giao:</label>
              <select class="form-control" name="shippername" id="shippername">
              <?php
                  foreach( $result2 as $key =>$value){
                    if($value) $sel="selected='selected'";else $sel="";
                      echo '<option '.$sel.' value="'.$value["shippername"].'">'.$value["shippername"].'</option>';
                  }
              ?>
              </select>
              </div>
              <div>
                <input type="submit" name="submit" value="Xác nhận giao" >
              </div>
          </div>
          <div class="<?php
            foreach($result3 as $key =>$value){
              if($value["order_check"]==0){
                echo "hidden";
              }
            }
          ?>">
            <input type="submit" name="submit2" value="Hoàn thành" >
          </div>
          <div>
            <input type="submit" name="submit3" value="Hủy đơn hàng">
          </div>
          <div class="error">
            <p class="error-text"><?php if($mess!="") echo $mess; ?></p>
          </div>
        </form>
        
            <?php
            foreach($result3 as $key => $value){
              if($value["order_check"]==2){
                echo "<div class='error'><p style='margin-top: 5px' class='error-text'>Hàng đã được giao</p></div>";
                echo "<a href='".URL."makepdf.php?id=".$id."&shippername=".$shippername."&status=".$status."'>In hóa đơn</a>";
              }else if($value["order_check"]==3){
                echo "<div class='error'><p style='margin-top: 5px' class='error-text'>Đơn hàng đã hủy</p></div>";
              }else if($value["order_check"]==1){
                echo "<div class='error'><p style='margin-top: 5px' class='error-text'>Hàng đang được giao</p></div>";
              }
            }
            ?>

          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
    include("footer.php")
?>
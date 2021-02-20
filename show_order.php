<?php
    session_start();
    include("config/config.php");
    if(empty($_SESSION["username"]))
    {
        header("Location:".URL."index.php");
    }
    include("header1.php");
    include("config/database.php");
    if(isset($_GET["page"])){
        $page=(int)$_GET["page"];
    }else{
        $page=1;
    }  
    if(isset($_GET["search"])){ 
        $search=$_GET["search"];
    }else {
        $search="";
    }
    if(isset($_GET["check"])){ 
        $check=(int)$_GET["check"];
    }else {
        $check=4;
    }
    
    $where="";$where1="";

    if($search!=""){
        $where=" AND phone like '%".$search."%'";
    }else $where="";
    if($check!=4){
        $where1=" AND order_check=".$check;
    }else $where1="";
    $offset=$page*LIMIT-LIMIT;
    
    $db = new Database(db_host, db_name, db_username, db_password);
    $sql="SELECT * FROM order1 where 1=1".$where.$where1." ORDER By create_date DESC LIMIT ".$offset.",".LIMIT;
    //   echo $sql;exit;
    $result = $db->Select($sql);
  
?>
    <style>
        .toggler{
            display: block;
    width: 80px;
    margin: 0 auto;
        }
        .hidden1 {
        max-width: 200px;
 overflow: hidden;
 text-overflow: ellipsis;
 white-space: nowrap;
    }
    </style>
        <!-- page content area main -->
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
                                <h2>Quản lý đơn hàng</h2>
                                <?php
                                    if($search!=""){
                                    echo '<a href="'.URL.'show_order.php">Trở về</a>';
                                    }else echo '';
                                ?> 
                                <div class="clearfix" style="position: absolute; right: 0"></div>
                            </div>
                            <div class="x_content">
                                <form method="GET" name="form" style="width:300px">
                                        <input name="search" type="text"   placeholder="Nhập đơn hàng">
                                        <input type="submit" name="submit" onclick="getSearch(this.value)" value="Tìm kiếm">
                                </form>
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th>Mã đơn hàng</th>
              <th>Người mua</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Địa chỉ</th>
              <th>Tổng cộng</th>
              <th>Người giao</th>
              <th>Tình trạng
              <select style="display: block;margin: 0 auto; width: 70px" name="product_status" onchange="getCheck(this.value)">
                    <option value="4">Tất cả</option>
                    <?php
                    foreach($arrCheck as $key=>$value){
                        if($check==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                </select>
              </th>
              <th>Ngày giao</th>
              <th>Ngày hủy</th>
              <th>Ngày tạo</th>
              <th style="text-align: center;">Tùy chỉnh</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($result){
            foreach($result as $key=>$value){
                $key=$key+$page*LIMIT-LIMIT+1;
                echo '<tr>
                <td>'.$key.'</td>
                <td>'.$value["id"].'</td>
                <td>'.$value["name"].'</td>
                <td>'.$value["email"].'</td>
                <td>'.$value["phone"].'</td>
                <td>'.$value["address"].'</td>
                <td>'.number_format($value["total"]).'VNĐ</td>
                <td>'.$value["shipper"].'</td>
                <td>'.$arrCheck[$value["order_check"]].'</td>
                <td style="text-align: center">'.$value["deliverydate"].'</td>
                <td style="text-align: center">'.$value["canceldate"].'</td>
                <td style="text-align: center">'.$value["create_date"].'</td>
                <td style="text-align: center"><a href="'.URL.'order_detail.php?id='.$value["id"].'&shippername='.$value["shipper"].'&status='.$value["order_check"].'">Chi tiết</a></td>
              </tr>';
            }
          }else{
              echo '<tr><td colspan="12" align="center">Không có dữ liệu</td></tr>';
          }
            ?>
          
          </tbody>
        </table>
        <?php
                echo "<div style='float: right; display: flex; flex-direction: row-reverse;';>";
                  if($page>0 && $result){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_order.php?search=".$search."&check=".$check."&page=".($page+1).'"><i class="fa fa-angle-right"></i></a>';
                }
                if($page>=2){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_order.php?search=".$search."&check=".$check."&page=".($page-1).'"><i class="fa fa-angle-left"></i></a>';
                }
                echo"</div>"
        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
        <script>
var search='<?php echo $search;?>';
var check='<?php echo $check;?>';
function getSearch(value){
    window.location.href = '<?php echo URL;?>show_order.php?search='+value+'&check='+check;
}
function getCheck(value){
    window.location.href = '<?php echo URL;?>show_order.php?check='+value+'&search='+search;
}
</script>  
<?php
    include("footer.php")
?>
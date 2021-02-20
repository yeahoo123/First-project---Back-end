<?php
    session_start();
    include("config/config.php");
    if(empty($_SESSION["username"]))
    {
        header("Location:".URL."index.php");
    }
    include("header1.php");
    include("config/database.php");
    if(isset($_GET["status"])){
      $status=(int)$_GET["status"];
    }else{
      $status=2;
    }   
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

    $where="";$where2="";

    if($status!=2)
    {
        $where=" AND shipper_status=".$status;
    }else $where="";
    if($search!=""){
        $where2=" AND shippername like '%".$search."%'";
    }else $where2="";
    $offset=$page*LIMIT-LIMIT;
    
    $db = new Database(db_host, db_name, db_username, db_password);
    $sql="SELECT * FROM shipper where 1 =1 ".$where.$where2." ORDER By create_date DESC LIMIT ".$offset.",".LIMIT;
    //   echo $sql;exit;
    $result = $db->Select($sql);
  
?>
    <style>
        .toggler{
            display: block;
    width: 80px;
    margin: 0 auto;
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
                                <h2>Quản lý shipper</h2>
                                <?php
                                    if($search!=""){
                                    echo '<a href="'.URL.'show_shipper.php">Trở về</a>';
                                    }else echo '';
                                ?> 
                                <div class="clearfix" style="position: absolute; right: 0"></div>
                            </div>
                            <div class="x_content">
                                <form method="GET" name="form" style="width:300px">
                                        <input name="search" type="text"   placeholder="Nhập tên shipper">
                                        <input type="submit" name="submit" onclick="getSearch(this.value)" value="Tìm kiếm">
                                </form>
                                <div style="float: right">
                                  <a href="add_shipper.php">Thêm shipper</a>
                                </div>
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th>Họ tên</th>
              <th>Email</th>
              <th>Điện thoại</th>
              <th>Địa chỉ</th>
              <th>Tình trạng
              <select class="toggler" name="shipper_status" onchange="getStatus(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrShip as $key=>$value){
                        if($status==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?></th>
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
                <td>'.$value["shippername"].'</td>
                <td>'.$value["email"].'</td>
                <td>'.$value["phone"].'</td>
                <td>'.$value["address"].'</td>
                <td style="text-align: center">'.$arrShip[$value["shipper_status"]].'</td>
                <td style="text-align: center">'.$value["create_date"].'</td>
                <td style="text-align: center"><a href="'.URL.'shipper_detail.php?id='.$value["shipper_id"].'">Sửa</a> | <a href="'.URL.'shipper_delete.php?id='.$value["shipper_id"].'&status='.$status.'&search='.$search.'&page='.$page.'">Xóa</a></td>
              </tr>';
            }
          }else{
              echo '<tr><td colspan="10" align="center">Không có dữ liệu</td></tr>';
          }
            ?>
          
          </tbody>
        </table>
        <?php
                echo "<div style='float: right; display: flex; flex-direction: row-reverse;';>";
                  if($page>0 && $result){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_shipper.php?status=".$status."&search=".$search."&page=".($page+1).'"><i class="fa fa-angle-right"></i></a>';
                }
                if($page>=2){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_shipper.php?status=".$status."&search=".$search."&page=".($page-1).'"><i class="fa fa-angle-left"></i></a>';
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
var status='<?php echo $status;?>';
var search='<?php echo $search;?>';
var page='<?php echo $page;?>';

function getStatus(value){
    window.location.href = '<?php echo URL;?>show_shipper.php?status='+value+'&search='+search+'&page='+page;
}
function getSearch(value){
    window.location.href = '<?php echo URL;?>show_shipper.php?search='+value+'&status='+status+'&page='+page;
}
</script>  
<?php
    include("footer.php")
?>
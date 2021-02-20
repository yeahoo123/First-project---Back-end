<?php
    session_start();
    include("config/config.php");
    include("config/database.php");
    $db = new Database(db_host, db_name, db_username, db_password);
    $arrCategory = getMenu($db);
     //echo "<pre>";print_r($arrCategory); echo "</pre>";
     //die();
    if(empty($_SESSION["username"]))
    {
        header("Location:".URL."index.php");
    }
   include("header1.php");


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
      $where=" AND news_ctgr_status=".$status;
  }else $where="";

  if($search!="")
  {
    $where2=" AND news_ctgr_name like '%".$search."%'";
  }else $where2="";

  $offset=$page*LIMIT-LIMIT;
   
  $sql="SELECT * FROM newscategory WHERE 1=1 ".$where.$where2." ORDER By create_date DESC LIMIT ".$offset.",".LIMIT;
  //echo $sql;exit;
  $result = $db->Select($sql);
  
?>

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
                                <h2>Quản lý danh mục tin tức</h2>
                                <?php
                                    if($search!=""){
                                    echo '<a href="'.URL.'show_newscategory.php">Trở về</a>';
                                    }else echo '';
                                ?> 
                                <div class="clearfix" style="position: absolute; right: 0"></div>
                            </div>
                            <div class="x_content">
                                <form method="GET" name="form" style="width:300px">
                                        <input name="search" type="text"   placeholder="Nhập tên danh mục">
                                        <input type="submit" name="submit" onclick="getSearch(this.value)" value="Tìm kiếm">
                                </form>
                                <div style="float: right">
                                  <a href="add_newscategory.php">Thêm danh mục tin tức</a>
                                </div>
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th>Tên danh mục
              <th>Tình trạng
              <select name="category_status" onchange="getStatus(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrStatus as $key=>$value){
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
                <td style="text-align: center">'.$key.'</td>
                <td>'.$value["news_ctgr_name"].'</td>
                <td style="text-align: center">'.$arrStatus[$value["news_ctgr_status"]].'</td>
                <td style="text-align: center">'.$value["create_date"].'</td>
                <td style="text-align: center"><a href="'.URL.'newscategory_detail.php?id='.$value["news_ctgr_id"].'">Sửa</a> | <a href="'.URL.'newscategory_delete.php?id='.$value["news_ctgr_id"].'&status='.$status.'&search='.$search.'&page='.$page.'">Xóa</a></td>
              </tr>';
            }
          }else{
              echo '<tr><td colspan="11" align="center">Không có dữ liệu</td></tr>';
          }
            ?>
          
          </tbody>
        </table>
        <?php
                echo "<div style='float: right; display: flex; flex-direction: row-reverse;';>";
                  if($page>0 && $result){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_newscategory.php?status=".$status."&search=".$search."&page=".($page+1).'"><i class="fa fa-angle-right"></i></a>';
                }
                if($page>=2){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_newscategory.php?status=".$status."&search=".$search."&page=".($page-1).'"><i class="fa fa-angle-left"></i></a>';
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
var parentid='<?php  echo $parentid;?>';

function getStatus(value){
    window.location.href = '<?php echo URL;?>show_newscategory.php?status='+value+'&search='+search+'&parentid='+parentid;
}
function getSearch(value){
    window.location.href = '<?php echo URL;?>show_newscategory.php?search='+value+'&status='+status+'&parentid='+parentid;
}
</script>  
<?php
    include("footer.php")
?>
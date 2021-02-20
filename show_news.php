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
  if(isset($_GET["ishot"])){
      $ishot=(int)$_GET["ishot"];
  }else{
      $ishot=2;
  }    
  if(isset($_GET["ishome"])){
      $ishome=(int)$_GET["ishome"];
  }else{
      $ishome=2;
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
  if(isset($_GET["search"])){ 
    $search=$_GET["search"];
  }else {
    $search="";
  }
  if(isset($_GET["category"])){
    $category=(int)$_GET["category"];
  }else{
    $category=999;
  } 
  $where="";$where1="";$where2="";$where3="";$where4="";
  if($status!=2)
  {
      $where=" AND news_status=".$status;
  }else $where="";
  
  if($ishot!=2)
  {
      $where1=" AND news_isHot=".$ishot;
  }else $where1="";
  if($ishome!=2)
  {
      $where4=" AND news_isHome=".$ishome;
  }else $where4="";

  if($search!=""){
    $where2=" AND news_title like '%".$search."%'";
  }else $where2="";
  $offset=$page*LIMIT-LIMIT;
  if($category!=999)
  {
      $where3=" AND news_ctgr_id=".$category;
  }else $where3="";
  $db = new Database(db_host, db_name, db_username, db_password);
  $sql="SELECT * FROM news WHERE 1=1 ".$where.$where1.$where2.$where3.$where4." ORDER By create_date DESC LIMIT ".$offset.",".LIMIT;
  //echo $sql;exit;
  $result = $db->Select($sql);
  $sql2="SELECT * FROM newscategory ORDER By create_date asc";
  $arrCate = $db->Select($sql2);
?>
<style>
    .flex {
        display: flex;
    flex-direction: column;
    justify-content: center;
    }
    td {
        vertical-align: middle !important;
    }

    .hidden1 {
        max-width: 100px;
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
                        <h2>Quản lý tin tức</h2>
                        <?php
                            if($search!=""){
                            echo '<a href="'.URL.'show_news.php">Trở về</a>';
                            }else echo '';
                        ?> 
                        <div class="clearfix" style="position: absolute; right: 0"></div>
                    </div>
                    <div class="x_content">
                        <form method="GET" name="form" style="width:300px">
                                <input name="search" type="text"   placeholder="Nhập tiêu đề tin tức">
                                <input type="submit" name="submit" onclick="getSearch(this.value)" value="Tìm kiếm">
                        </form>
                        <div style="float: right">
                                  <a href="add_news.php">Thêm tin tức</a>
                                </div>
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th>Danh mục
                <select style="width: 80px; margin: 0 auto;display: block; " name="news_ctgr_id" onchange="getCategory(this.value)" >
                  <option value="999">Tất cả</option>
                    <?php
                    foreach($arrCate as $val){
                      if($category==$val["news_ctgr_id"]) $sel="selected='selected'";else $sel="";
                    echo '<option '.$sel.' value="'.$val["news_ctgr_id"].'">'.$val["news_ctgr_name"].'</option>';
                    }
                    ?>
                </select>
              </th>
              <th>Tiêu đề</th>
              <th>Ảnh tiêu đề</th>
              <th>Nội dung</th>
              <th>Miêu tả</th>
              <th>Tác giả</th>
              <th>
                  <div class="flex">
                  Hiện trang chủ?
                <select style="width: 80px; margin: 0 auto; display: block; " name="news_isHot" onchange="getHome(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrHome as $key=>$value){
                        if($ishome==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                </select>
                  </div>
             </th>
              <th>
                  <div class="flex">
                  Hot
                <select style="width: 80px; margin: 0 auto; display: block; " name="news_isHot" onchange="getHot(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrHot as $key=>$value){
                        if($ishot==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                </select>
                  </div>
             </th>
              <th>
                  <div>
                  Tình trạng
                    <select style="width: 80px; margin: 0 auto; display: block; " name="news_status" onchange="getStatus(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrStatus as $key=>$value){
                        if($status==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                  </div>
            </th>
              <th>Ngày tạo</th>
              <th style="text-align: center;">Tùy chỉnh</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($result){
                $time=date("Ym");
            foreach($result as $key=>$value){
                $cate= "SELECT news_ctgr_name from newscategory where news_ctgr_id=".$value["news_ctgr_id"];
                $categoryName = $db->Select($cate);
                $key=$key+$page*LIMIT-LIMIT+1;
                echo '<tr>
                <td style="text-align:center">'.$key.'</td>
                <td style="text-align:center">'.$categoryName[0]["news_ctgr_name"].'</td>
                <td class="news__title hidden1">'.$value["news_title"].'</td>
                <td style="text-align:center"><img src='.URL.'images/'.'news/'.$time.'/'.$value["news_image"].' width="50px"/></td>
                <td class="hidden1">'.$value["news_content"].'</td>
                <td class="hidden1">'.$value["news_description"].'</td>
                <td style="text-align:center">'.$value["news_author"].'</td>
                <td style="text-align:center">'.$arrHome[$value["news_isHome"]].'</td>
                <td style="text-align:center">'.$arrHot[$value["news_isHot"]].'</td>
                <td style="text-align:center">'.$arrStatus[$value["news_status"]].'</td>
                <td style="text-align:center">'.$value["create_date"].'</td>
                <td style="text-align:center"><a href="'.URL.'news_detail.php?id='.$value["news_id"].'">Chi tiết</a> | <a href="'.URL.'news_delete.php?id='.$value["news_id"].'&category='.$category.'&ishot='.$ishot.'&ishome='.$ishome.'&status='.$status.'&search='.$search.'&page='.$page.'">Xóa</a></td>
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
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_news.php?status=".$status."&ishot=".$ishot."&ishome=".$ishome."&search=".$search."&page=".($page+1).'"><i class="fa fa-angle-right"></i></a>';
                }
                if($page>=2){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_news.php?status=".$status."&ishot=".$ishot."&ishome=".$ishome."&search=".$search."&page=".($page-1).'"><i class="fa fa-angle-left"></i></a>';
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
var ishot='<?php echo $ishot;?>';
var ishome='<?php echo $ishome;?>';
var status='<?php echo $status;?>';
var search='<?php echo $search;?>';
var category='<?php echo $category;?>';

function getStatus(value){
    window.location.href = '<?php echo URL;?>show_news.php?status='+value+'&ishot='+ishot+'&search='+search+'&category='+category+'&ishome='+ishome;
}
function getHot(value){
    window.location.href = '<?php echo URL;?>show_news.php?ishot='+value+'&status='+status+'&search='+search+'&category='+category+'&ishome='+ishome;
}
function getSearch(value){
    window.location.href = '<?php echo URL;?>show_news.php?search='+value+'&status='+status+'&ishot='+ishot+'&category='+category+'&ishome='+ishome;
}
function getCategory(value){
    window.location.href = '<?php echo URL;?>show_news.php?category='+value+'&status='+status+'&ishot='+ishot+'&search='+search;
}
function getHome(value){
    window.location.href = '<?php echo URL;?>show_news.php?ishome='+value+'&status='+status+'&ishot='+ishot+'&search='+search+'&category='+category;
}
</script>  
<?php
    include("footer.php")
?>
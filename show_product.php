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

  if(isset($_GET["category"])){
    $category=(int)$_GET["category"];
  }else{
    $category=999;
  }
  if(isset($_GET["parentid"])){
    $parentid=(int)$_GET["parentid"];
  }else{
    $parentid=999;
  }
  
  if(isset($_GET["ishome"])){
    $ishome=(int)$_GET["ishome"];
  }else{
    $ishome=2;
  } 
  
  $where="";$where1="";$where2="";$where3="";$where4="";$where5="";
  if($status!=2)
  {
      $where=" AND product_status=".$status;
  }else $where="";
  
  if($ishot!=2)
  {
      $where1=" AND product_isHot=".$ishot;
  }else $where1="";

  if($search!=""){
    $where2=" AND product_name like '%".$search."%'";
  }else $where2="";

  if($category!=999)
  {
      $where3=" AND category_id=".$category;
  }else $where3="";
  if($parentid!=999)
  {
      $where5=" AND parent_id=".$parentid;
  }else $where5="";
  
  if($ishome!=2)
  {
      $where4=" AND product_isHome=".$ishome;
  }else $where4="";
  $offset=$page*LIMIT-LIMIT;
  
  $db = new Database(db_host, db_name, db_username, db_password);
  $sql="SELECT * FROM product WHERE 1=1 ".$where.$where1.$where2.$where3.$where4.$where5." ORDER By create_date DESC LIMIT ".$offset.",".LIMIT;
  // echo $sql;exit;
  $result = $db->Select($sql);
  $sql2="SELECT * FROM category where parent_id >0 ORDER By create_date asc";
  $arrCate = $db->Select($sql2);
  $sql3="SELECT * FROM category where parent_id = 0 ORDER By create_date asc";
  $arrCate2 = $db->Select($sql3);
  // echo '<pre>',print_r($arrCate2),'</pre>';
  // die;
?>
<style>
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
                                <h2>Quản lý sản phẩm</h2>
                                <?php
                                    if($search!=""){
                                    echo '<a href="'.URL.'show_product.php">Trở về</a>';
                                    }else echo '';
                                ?> 
                                <div class="clearfix" style="position: absolute; right: 0"></div>
                            </div>
                            <div class="x_content">
                                <form method="GET" name="form" style="width:300px">
                                        <input name="search" type="text"   placeholder="Nhập tên sản phẩm">
                                        <input type="submit" name="submit" onclick="getSearch(this.value)" value="Tìm kiếm">
                                </form>
                                <div style="float: right">
                                  <a href="add_product.php">Thêm sản phẩm</a>
                                </div>
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th style="width: 80px">Tên sản phẩm</th>
              <th>Ảnh sản phẩm</th>
              <th>Danh mục
                <select style="width: 64px; margin: 0 auto;display:block " name="category_id" onchange="getParentId(this.value)" >
                  <option value="999">Tất cả</option>
                    <?php
                    foreach($arrCate2 as $val){
                      if($parentid==$val["category_id"]) $sel="selected='selected'";else $sel="";
                    echo '<option '.$sel.' value="'.$val["category_id"].'">'.$val["category_name"].'</option>';
                    
                    }
                    ?>
                </select>
              </th>
              <th>Danh mục con
                <select style="width: 64px; margin: 0 auto; display:block " name="category_id" onchange="getCategory(this.value)" >
                  <option value="999">Tất cả</option>
                    <?php
                    foreach($arrCate as $val){
                      if($category==$val["category_id"]) $sel="selected='selected'";else $sel="";
                    echo '<option '.$sel.' value="'.$val["category_id"].'">'.$val["category_name"].'</option>';
                    
                    }
                    ?>
                </select>
              </th>
              <th>Số lượng</th>
              <th style="width: 120px">Giá bán</th>
              <th style="width: 120px">Giá nhập</th>
              <th>Hiện trang chủ?
                <select style="width: 80px; margin: 0 auto; display: block; "name="product_isHome" onchange="getHome(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrHome as $key=>$value){
                        if($ishome==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                </select></th>
              <th style="width: 70px">Hot
                <select style="width: 60px; margin: 0 auto "name="product_isHot" onchange="getHot(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrHot as $key=>$value){
                        if($ishot==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?>
                </select></th>
              <th style="text-align: center;">Tình trạng
              <select style="display: block;margin: 0 auto; width: 70px" name="product_status" onchange="getStatus(this.value)">
                    <option value="2">Tất cả</option>
                    <?php
                    foreach($arrStatus as $key=>$value){
                        if($status==$key) $sel="selected='selected'";else $sel="";
                        echo '<option '.$sel.' value="'.$key.'">'.$value.'</option>';
                    }
                    ?></th>
              <th style="width: 100px">Ngày tạo</th>
              <th style="text-align: center;">Tùy chỉnh</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($result){
              $time=date("Ym");
            foreach($result as $key=>$value){
                $cate1 = "SELECT category_name from category where category_id=".$value["parent_id"];
                $cate2 = "SELECT category_name from category where category_id=".$value["category_id"];
                $categoryName1 = $db->Select($cate1);
                $categoryName2 = $db->Select($cate2);
                $key=$key+$page*LIMIT-LIMIT+1;
                echo '<tr>
                <td style="text-align: center">'.$key.'</td>
                <td style="width: 80px">'.$value["product_name"].'</td>
                <td style="text-align: center"><img src='.URL.'images/'.$time.'/'.$value["product_image"].' width="50px"/></td>
                <td style="text-align: center">'.$categoryName1[0]["category_name"].'</td>
                <td style="text-align: center">'.$categoryName2[0]["category_name"].'</td>
                <td style="text-align: center">'.$value["product_qty"].'</td>
                <td style="text-align: end">'.number_format($value["product_price"],0).' VNĐ</td>
                <td style="text-align: end">'.number_format($value["import_price"],0).' VNĐ</td>
                <td style="text-align: center">'.$arrHome[$value["product_isHome"]].'</td>
                <td style="text-align: center">'.$arrHot[$value["product_isHot"]].'</td>
                <td style="text-align: center">'.$arrStatus[$value["product_status"]].'</td>
                <td style="text-align: center">'.$value["create_date"].'</td>
                <td style="text-align: center"><a href="'.URL.'product_detail.php?id='.$value["product_id"].'">Sửa</a> | <a href="'.URL.'product_delete.php?id='.$value["product_id"].'&category='.$category.'&parentid='.$parentid.'&status='.$status.'&ishot='.$ishot.'&ishome='.$ishome.'&search='.$search.'&page='.$page.'">Xóa</a></td>
              </tr>';
            }
          }else{
              echo '<tr><td colspan="13" align="center">Không có dữ liệu</td></tr>';
          }
            ?>
          
          </tbody>
        </table>
        <?php
                echo "<div style='float: right; display: flex; flex-direction: row-reverse;';>";
                  if($page>0 && $result){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_product.php?status=".$status."&ishot=".$ishot."&category=".$category."&parentid=".$parentid."&search=".$search."&ishome=".$ishome."&page=".($page+1).'"><i class="fa fa-angle-right"></i></a>';
                }
                if($page>=2){
                    echo '<a style="margin:0 10px; font-size: 20px" href="'.URL."show_product.php?status=".$status."&ishot=".$ishot."&category=".$category."&parentid=".$parentid."&search=".$search."&ishome=".$ishome."&page=".($page-1).'"><i class="fa fa-angle-left"></i></a>';
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
var status='<?php echo $status;?>';
var search='<?php echo $search;?>';
var category='<?php echo $category;?>';
var ishome='<?php echo $ishome;?>';
var parentid='<?php echo $parentid;?>';

function getStatus(value){
    window.location.href = '<?php echo URL;?>show_product.php?status='+value+'&ishot='+ishot+'&search='+search+'&category='+category+'&ishome='+ishome+'&parentid='+parentid;
}
function getHot(value){
    window.location.href = '<?php echo URL;?>show_product.php?ishot='+value+'&status='+status+'&search='+search+'&category='+category+'&ishome='+ishome+'&parentid='+parentid;
}
function getSearch(value){
    window.location.href = '<?php echo URL;?>show_product.php?search='+value+'&status='+status+'&ishot='+ishot+'&category='+category+'&ishome='+ishome+'&parentid='+parentid;
}
function getCategory(value){
    window.location.href = '<?php echo URL;?>show_product.php?category='+value+'&status='+status+'&ishot='+ishot+'&search='+search+'&ishome='+ishome+'&parentid='+parentid;
}
function getHome(value){
    window.location.href = '<?php echo URL;?>show_product.php?ishome='+value+'&status='+status+'&ishot='+ishot+'&search='+search+'&category='+category+'&parentid='+parentid;
}
function getParentId(value){
    window.location.href = '<?php echo URL;?>show_product.php?parentid='+value+'&status='+status+'&ishot='+ishot+'&search='+search+'&category='+category+'&ishome='+ishome;
}
</script>  
<?php
    include("footer.php")
?>
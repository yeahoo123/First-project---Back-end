<?php
session_start();
include("config/config.php");
include("config/database.php");
include("header1.php");
ini_set('display_errors',0 );
if(empty($_SESSION["username"]))
{
    header("Location:".URL."index.php");
}
if(isset($_GET["mess"])){
  $mess=$_GET["mess"];
}else $mess="";


if(isset($_POST["submit"])){

$sql="INSERT INTO newscategory(news_ctgr_name, news_ctgr_status, create_date) values('".$_POST["news_ctgr_name"]."', '".$_POST["news_ctgr_status"]."', now())";
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->Insert($sql);
    if($result1){
      $mess="Thêm thành công";
      header("Location:".URL."add_newscategory.php?mess=".$mess);
    }
  }
  
$sql="SELECT * FROM newscategory";
$db = new Database(db_host, db_name, db_username, db_password);
$arrCate = $db->Select($sql);
?>
<style>
.product__content{
  display: flex;
  flex-direction: column;
}
  .form-group {
    display: flex;
  }
  .form-group label {
    font-size: 17px;
    margin: 0;
    width: 200px;
    display: flex;
    align-items: center;
  }
  .btn {
    width: 100px;
  }

  .error {
      background: red;
      text-align: center;
  }
  .error-text {
      color: yellow;
      font-size: 18px;
      margin: 0;
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
                                <h2>Thêm danh mục tin tức</h2>
                                
                                <?php
                                    echo '<a href="'.URL.'show_newscategory.php">Trở về</a>'
                                ?>
                                <div class="clearfix" style="position: absolute; right: 0">
                                  
                                </div>
                            </div>
                            <div class="x_content">
                              <!-- <?php
                                echo "<pre>";print_r($result);echo "</pre>";
                              ?> -->
                              <div class="product__detail" style="display: flex;     justify-content: space-evenly;">

                                  <form method="POST" action="" class="product__content" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label for="news_ctgr_name">Tên danh mục: </label>
                                          <input type="text" class="form-control" id="news_ctgr_name" name="news_ctgr_name" >
                                      </div>
                                        <div class="form-group">
                                            <label for="news_ctgr_status">Tình trạng </label>
                                            <select class="form-control" name="news_ctgr_status" id="news_ctgr_status">
                                            <option value="0">Không hiệu lực</option>
                                            <option value="1">Hiệu lực</option>
                                            </select>
                                      </div>
                                      <button type="submit" name="submit" value="submit" class="btn btn-primary">Thêm</button>
                                      <div class="error">
                                            <p class="error-text"><?php if($mess!="") echo $mess; ?></p>
                                    </div>
                                  </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->    
<?php
   include("footer.php")
?>
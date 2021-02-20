<?php
session_start();

include("config/config.php");
include("config/database.php");
include("header1.php");
ini_set('display_errors', 0);
if(empty($_SESSION["username"]))
{
    header("Location:".URL."index.php");
}

if(isset($_GET["id"])){
  $id=(int)$_GET["id"];
}else {
  header("Location:".URL."show_category.php");
}
if(isset($_GET["mess"])){
  $mess=$_GET["mess"];
}else $mess="";
    if(isset($_POST['submit'])){
        $sql = "UPDATE newscategory set news_ctgr_name ='".$_POST["news_ctgr_name"]."', news_ctgr_status =".$_POST["news_ctgr_status"].", create_date = NOW() where news_ctgr_id =".$id;
        $db = new Database(db_host, db_name, db_username, db_password);
        $result1 = $db->Update($sql);
        if($result1){
          $mess="Sửa thành công";
        }
    }      
    $db = new Database(db_host, db_name, db_username, db_password);
    $query="SELECT * FROM newscategory WHERE news_ctgr_id=".$id;
    $result=$db->Select($query);
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
                                <h2>Sửa danh mục tin tức</h2>
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
                              <div class="category__detail">
                                </div>
                                  <form class="product__content" method="POST">
                                      <div class="form-group">
                                          <label for="news_ctgr_id">ID danh mục: </label>
                                          <input type="text" class="form-control" id="news_ctgr_id" name="news_ctgr_id" value="<?php echo $result[0]["news_ctgr_id"];?> " disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="news_ctgr_name">Tên danh mục:  </label>
                                          <input type="text" class="form-control" id="news_ctgr_name" name="news_ctgr_name" value="<?php echo $result[0]["news_ctgr_name"];?>" >
                                      </div>
                                      <div class="form-group">
                                      <label for="news_ctgr_status">Tình trạng</label>
                                            <select class="form-control" name="news_ctgr_status" id="news_ctgr_status">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrStatus == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["news_ctgr_status"]==1){
                                                      echo '<option '.$sel.' value="'.$value["news_ctgr_status"].'">'.$arrStatus[$value["news_ctgr_status"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_ctgr_status"]-1).'">'.$arrStatus[$value["news_ctgr_status"]-1].'</option>';
                                                    }else if($value["news_ctgr_status"]==0){
                                                      echo '<option '.$sel.' value="'.$value["news_ctgr_status"].'">'.$arrStatus[$value["news_ctgr_status"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_ctgr_status"]+1).'">'.$arrStatus[$value["news_ctgr_status"]+1].'</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                      </div>
                                      <input class="btn"type="submit" name="submit" value="Sửa" >
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
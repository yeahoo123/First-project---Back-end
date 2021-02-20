<?php
session_start();
include("config/config.php");
include("config/database.php");
include("header1.php");
ini_set('display_errors',0);
if(empty($_SESSION["username"]))
{
    header("Location:".URL."index.php");
}
if(isset($_GET["mess"])){
  $mess=$_GET["mess"];
}else $mess="";
if(isset($_GET["id"])){
  $id=$_GET["id"];
}else $id="";
$time=date("Ym");

if(isset($_POST["submit"])){
  $time=date("Ym");
  $filename=time().$_FILES["fileToUpload"]["name"];
  if (!file_exists(ROOTDIR."images/news/".$time)) {
    echo mkdir(ROOTDIR."images/news/".$time, 0700);
}
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],ROOTDIR."images/news/".$time."/".$filename))
  {
    $sql="UPDATE news set news_ctgr_id=".$_POST["news_ctgr_id"].", news_title='".$_POST["news_title"]."', news_image='".$filename."', news_content='".$_POST["news_content"]."', news_description='".$_POST["news_description"]."', news_author='".$_POST["news_author"]."', news_isHome=".$_POST["news_isHome"].", news_isHot=".$_POST["news_isHot"].", news_status=".$_POST["news_status"].", create_date = now() where news_id=".$id;
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->UPDATE($sql);
    if($result1){
      $mess="thêm thành công";
      header("Location:".URL."news_detail.php?id=".$id."&mess=".$mess);
    }
  }else{
    $sql="UPDATE news set news_ctgr_id=".$_POST["news_ctgr_id"].", news_title='".$_POST["news_title"]."', news_content='".$_POST["news_content"]."', news_description='".$_POST["news_description"]."', news_author='".$_POST["news_author"]."', news_isHome=".$_POST["news_isHome"].", news_isHot=".$_POST["news_isHot"].", news_status=".$_POST["news_status"].", create_date = now() where news_id=".$id;
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->UPDATE($sql);
    if($result1){
      $mess="sửa thành công";
      header("Location:".URL."news_detail.php?id=".$id."&mess=".$mess);
    }
  }
  
  
}
$db = new Database(db_host, db_name, db_username, db_password);
$sql="SELECT * FROM news WHERE news_id=".$id;
//echo $sql;exit;
$result = $db->Select($sql);

$sql1="SELECT * FROM newscategory";
$arrCate = $db->Select($sql1);
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
                                <h2>Sửa thông tin tin tức</h2>
                                
                                <?php
                                    echo '<a href="'.URL.'show_news.php">Trở về</a>'
                                ?>
                                <div class="clearfix" style="position: absolute; right: 0">
                                  
                                </div>
                            </div>
                            <div class="x_content">
                              <!-- <?php
                                echo "<pre>";print_r($result);echo "</pre>";
                              ?> -->
                              <div class="product__detail" style="display: flex;     justify-content: space-evenly;">
                              <div class="img">
                                    <img src="<?php echo URL.'images/'.'news/'.$time.'/'.$result[0]["news_image"]?>" alt="" width="400">
                                  </div>
                                  <form method="POST" action="" class="product__content" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label for="news_id">ID: </label>
                                          <input type="text"  class="form-control" id="news_id" name="news_id" value="<?php echo $result[0]["news_id"];?>" disabled></input>
                                      </div>
                                      <div class="form-group">
                                            <label for="exampleInputEmail1">Danh mục</label>
                                            
                                            <select class="form-control" name="news_ctgr_id" id="news_ctgr_id">
                                            <?php
                                            foreach($arrCate as $val){
                                            echo '<option value="'.$val["news_ctgr_id"].'">'.$val["news_ctgr_name"].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                      <div class="form-group">
                                          <label for="news_title">Tựa: </label>
                                          <textarea class="form-control" id="news_title" name="news_title" style="height: 200px;"><?php echo $result[0]["news_title"];?></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Hình ảnh</label>
                                        <input type="file" id="fileToUpload" name="fileToUpload" />
                                        </div>
                                      <div class="form-group">
                                          <label for="news_content">Nội dung tin tức: </label>
                                          <textarea class="form-control" id="news_content" name="news_content" style="height: 200px;"><?php echo $result[0]["news_content"];?></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="news_description">Miêu tả tin tức: </label>
                                          <textarea  class="form-control" id="news_description" name="news_description" style="height: 200px;"><?php echo $result[0]["news_description"];?></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="news_author">Người viết: </label>
                                          <input type="text" class="form-control" id="news_author" name="news_author" value="<?php echo $result[0]["news_author"];?>" >
                                      </div>
                                      <div class="form-group">
                                      <label for="news_isHome">Hiện trang chủ</label>
                                            <select class="form-control" name="news_isHome" id="news_isHome">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrHome == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["news_isHome"]==1){
                                                      echo '<option '.$sel.' value="'.$value["news_isHome"].'">'.$arrHome[$value["news_isHome"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_isHome"]-1).'">'.$arrHome[$value["news_isHome"]-1].'</option>';
                                                    }else if($value["news_isHome"]==0){
                                                      echo '<option '.$sel.' value="'.$value["news_isHome"].'">'.$arrHome[$value["news_isHome"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_isHome"]+1).'">'.$arrHome[$value["news_isHome"]+1].'</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                      <label for="news_isHot">Hot?</label>
                                            <select class="form-control" name="news_isHot" id="news_isHot">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrHot == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["news_isHot"]==1){
                                                      echo '<option '.$sel.' value="'.$value["news_isHot"].'">'.$arrHot[$value["news_isHot"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_isHot"]-1).'">'.$arrHot[$value["news_isHot"]-1].'</option>';
                                                    }else if($value["news_isHot"]==0){
                                                      echo '<option '.$sel.' value="'.$value["news_isHot"].'">'.$arrHot[$value["news_isHot"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_isHot"]+1).'">'.$arrHot[$value["news_isHot"]+1].'</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                      <label for="news_status">Tình trạng</label>
                                            <select class="form-control" name="news_status" id="news_status">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrStatus == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["news_status"]==1){
                                                      echo '<option '.$sel.' value="'.$value["news_status"].'">'.$arrStatus[$value["news_status"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_status"]-1).'">'.$arrStatus[$value["news_status"]-1].'</option>';
                                                    }else if($value["news_status"]==0){
                                                      echo '<option '.$sel.' value="'.$value["news_status"].'">'.$arrStatus[$value["news_status"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["news_status"]+1).'">'.$arrStatus[$value["news_status"]+1].'</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                      </div>
                                      <button type="submit" name="submit" value="submit" class="btn btn-primary">Sửa</button>
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
        <script>
            function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}
            setInputFilter(document.getElementById("intTextBox"), function(value) {
            return /^-?\d*$/.test(value); });
        </script>
<?php
   include("footer.php")
?>
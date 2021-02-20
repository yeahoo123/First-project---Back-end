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
$time=date("Ym");
if(isset($_GET["id"])){
  $id=(int)$_GET["id"];
}else {
  header("Location:".URL."show_product.php");
}
if(isset($_GET["mess"])){
  $mess=$_GET["mess"];
}else $mess="";
if(isset($_POST["submit"])){
  $time=date("Ym");
  $filename=time().$_FILES["fileToUpload"]["name"];
  if (!file_exists(ROOTDIR."images/".$time)) {
    echo mkdir(ROOTDIR."images/".$time, 0700);
}
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],ROOTDIR."images/".$time."/".$filename))
  {
    $sql="UPDATE product set category_id='".$_POST["category_id"]."', parent_id='".$_POST["parent_id"]."',
    product_name='".$_POST["product_name"]."', product_qty='".$_POST["product_qty"]."', product_image='".$filename."', product_price=".$_POST["product_price"].", import_price=".$_POST["import_price"].", product_description='".$_POST["product_description"]
    ."', product_isHome=".$_POST["product_isHome"]
    .", product_isHot=".$_POST["product_isHot"]
    .",product_status=".$_POST["product_status"].", create_date = NOW() Where product_id=".$id;
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->Update($sql);
    if($result1){
      $mess="Sửa thành công";
      header("Location:".URL."show_product.php?product_id=".$_POST["product_id"]."&mess=".$mess);
    }
  }else {
    $sql="UPDATE product set category_id='".$_POST["category_id"]."', parent_id='".$_POST["parent_id"]."',
    product_name='".$_POST["product_name"]."', product_qty='".$_POST["product_qty"]."', product_price=".$_POST["product_price"].", import_price=".$_POST["import_price"].", product_description='".$_POST["product_description"]
    ."', product_isHome=".$_POST["product_isHome"]
    .",product_isHot=".$_POST["product_isHot"]
    .", product_status=".$_POST["product_status"].", create_date = NOW() Where product_id=".$id;
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->Update($sql);
    if($result1){
      $mess="Sửa thành công";
      header("Location:".URL."show_product.php?product_id=".$_POST["product_id"]."&mess=".$mess);
    }
  }
}
$db = new Database(db_host, db_name, db_username, db_password);
$sql="SELECT * FROM product WHERE product_id=".$id;
//echo $sql;exit;
$result = $db->Select($sql);
$sql1="SELECT * FROM category   where parent_id >0 ";
$arrCate = $db->Select($sql1);
$sql2="SELECT * FROM category   where parent_id =0 ";
$arrCate2 = $db->Select($sql2);
//echo "<pre>";print_r($result );echo "</pre>";exit;
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
                                <h2>Sửa thông tin sản phẩm</h2>
                                
                                <?php
                                    echo '<a href="'.URL.'show_product.php">Trở về</a>'
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
                                    <img src="<?php echo URL.'images/'.$time.'/'.$result[0]["product_image"]?>" alt="" width="300">
                                  </div>
                                  <form method="POST" action="" class="product__content" enctype="multipart/form-data">
                                  <div class="form-group">
                                          <label for="product_id">ID sản phẩm: </label>
                                          <input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo $result[0]["product_id"];?>" disabled>
                                      </div>
                                        <div class="form-group" > 
                                            <label for="exampleInputEmail1">Danh mục</label>
                                            
                                            <select class="form-control" name="parent_id" id="parent_id">
                                            <?php
                                            foreach($arrCate2 as $val){
                                              if($result[0]["parent_id"]==$val["category_id"]) $sel="selected='selected'";else $sel="";
                                            echo '<option '.$sel.' value="'.$val["category_id"].'">'.$val["category_name"].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="form-group" > 
                                            <label for="exampleInputEmail1">Danh mục con</label>
                                            
                                            <select class="form-control" name="category_id" id="category_id">
                                            <?php
                                            foreach($arrCate as $val){
                                              if($result[0]["category_id"]==$val["category_id"]) $sel="selected='selected'";else $sel="";
                                            echo '<option '.$sel.' value="'.$val["category_id"].'">'.$val["category_name"].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                      <!-- <div class="form-group">
                                          <label for="category_id">ID danh mục: </label>
                                          <input type="text" class="form-control" id="category_id" name="category_id" value="<?php //echo $result[0]["category_id"];?>" >
                                      </div> -->
                                      <!-- <div class="form-group">
                                          <label for="category_name">Tên danh mục:  </label>
                                          <input type="text" class="form-control" id="category_name" name="category_name" value="<?php //echo $result[0]["category_name"];?>" >
                                      </div> -->
                                      <div class="form-group">
                                          <label for="product_name">Tên sản phẩm: </label>
                                          <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $result[0]["product_name"];?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Ảnh</label>
                                        <input type="file" id="fileToUpload" name="fileToUpload" />
                                        </div>
                                      <div class="form-group">
                                          <label for="product_qty">Số lượng: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="product_qty" value="<?php echo $result[0]["product_qty"];?>" >
                                      </div>
                                      <div class="form-group">
                                          <label for="product_price">Giá bán: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="product_price" value="<?php echo $result[0]["product_price"];?>" >
                                      </div>
                                      <div class="form-group">
                                          <label for="import_price">Giá nhập: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="import_price" value="<?php echo $result[0]["import_price"];?>" >
                                      </div>
                                      <div class="form-group">
                                          <label for="product_description">Chi tiết: </label>
                                          <textarea type="text" class="form-control" id="product_description" name="product_description" style="height: 200px;"><?php echo $result[0]["product_description"];?></textarea>
                                      </div>

                                      <div class="form-group">
                                      <label for="product_isHome">Hiện trang chủ</label>
                                            <select class="form-control" name="product_isHome" id="product_isHome">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrHome == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["product_isHome"]==1){
                                                      echo '<option '.$sel.' value="'.$value["product_isHome"].'">'.$arrHome[$value["product_isHome"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["product_isHome"]-1).'">'.$arrHome[$value["product_isHome"]-1].'</option>';
                                                    }else if($value["product_isHome"]==0){
                                                      echo '<option '.$sel.' value="'.$value["product_isHome"].'">'.$arrHome[$value["product_isHome"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["product_isHome"]+1).'">'.$arrHome[$value["product_isHome"]+1].'</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                      <label for="product_isHot">Hot?</label>
                                            <select class="form-control" name="product_isHot" id="product_isHot">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrHot == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["product_isHot"]==1){
                                                      echo '<option '.$sel.' value="'.$value["product_isHot"].'">'.$arrHot[$value["product_isHot"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["product_isHot"]-1).'">'.$arrHot[$value["product_isHot"]-1].'</option>';
                                                    }else if($value["product_isHot"]==0){
                                                      echo '<option '.$sel.' value="'.$value["product_isHot"].'">'.$arrHot[$value["product_isHot"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["product_isHot"]+1).'">'.$arrHot[$value["product_isHot"]+1].'</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                      <label for="product_status">Tình trạng</label>
                                            <select class="form-control" name="product_status" id="product_status">
                                            <?php
                                                foreach( $result as $key =>$value){
                                                    if($arrStatus == $key) $sel="selected='selected'";else $sel="";
                                                    if($value["product_status"]==1){
                                                      echo '<option '.$sel.' value="'.$value["product_status"].'">'.$arrStatus[$value["product_status"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["product_status"]-1).'">'.$arrStatus[$value["product_status"]-1].'</option>';
                                                    }else if($value["product_status"]==0){
                                                      echo '<option '.$sel.' value="'.$value["product_status"].'">'.$arrStatus[$value["product_status"]].'</option>';
                                                      echo '<option '.$sel.' value="'.($value["product_status"]+1).'">'.$arrStatus[$value["product_status"]+1].'</option>';
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
   //include("footer.php")
?>
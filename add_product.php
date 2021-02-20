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
  $time=date("Ym");
  $filename=time().$_FILES["fileToUpload"]["name"];
  if (!file_exists(ROOTDIR."images/".$time)) {
    echo mkdir(ROOTDIR."images/".$time, 0700);
}
  if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],ROOTDIR."images/".$time."/".$filename))
  {
    $sql="INSERT INTO product(category_id,parent_id,product_name,product_image,product_qty, count1, product_price,  import_price, product_description,product_isHome,product_isHot,	product_status,	create_date) VALUES('".$_POST["category_id"]."','".$_POST["parent_id"]."','".$_POST["product_name"]."','".$filename."','".$_POST["product_qty"]."',1,'".$_POST["product_price"]."','".$_POST["import_price"]."','".$_POST["product_description"]."','".$_POST["product_isHome"]."','".$_POST["product_isHot"]."','".$_POST["product_status"]."',NOW())";
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->Insert($sql);
    if($result1){
      $mess="thêm thành công";
      header("Location:".URL."add_product.php?mess=".$mess);
    }
  }else{
    $mess="Sai dữ liệu hình ảnh";
  }
  
  
}
$sql="SELECT * FROM category where parent_id >0";
$sql2="SELECT * FROM category where parent_id = 0";
$db = new Database(db_host, db_name, db_username, db_password);
$arrCate = $db->Select($sql);
$arrCate2 = $db->Select($sql2);
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
                                <h2>Thêm sản phẩm</h2>
                                
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

                                  <form method="POST" action="" class="product__content" enctype="multipart/form-data">
                                      <div class="form-group">
                                            <label for="exampleInputEmail1">Danh mục</label>
                                            
                                            <select class="form-control" name="parent_id" id="parent_id">
                                            <?php
                                            foreach($arrCate2 as $val){
                                            echo '<option value="'.$val["category_id"].'">'.$val["category_name"].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                      <div class="form-group">
                                            <label for="exampleInputEmail1">Danh mục con</label>
                                            
                                            <select class="form-control" name="category_id" id="category_id">
                                            <?php
                                            foreach($arrCate as $val){
                                            echo '<option value="'.$val["category_id"].'">'.$val["category_name"].'</option>';
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
                                          <input type="text" class="form-control" id="product_name" name="product_name" >
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Image</label>
                                        <input type="file" id="fileToUpload" name="fileToUpload" />
                                        </div>
                                      <div class="form-group">
                                          <label for="product_qty">Số lượng: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="product_qty" >
                                      </div>
                                      <div class="form-group">
                                          <label for="product_price">Giá bán: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="product_price" >
                                      </div>
                                      <div class="form-group">
                                          <label for="import_price">Giá nhập: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="import_price" >
                                      </div>
                                      <div class="form-group">
                                          <label for="product_description">Chi tiết: </label>
                                          <textarea type="text" class="form-control" id="product_description" name="product_description" style="height: 200px;" ></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="product_isHome">Hiện trang chủ? </label>
                                          <select class="form-control" name="product_isHome" id="product_isHome">
                                            <option value="0">Không</option>
                                            <option value="1">Có</option>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="product_isHot">Độ hot </label>
                                          <select class="form-control" name="product_isHot" id="product_isHot">
                                            <option value="0">Không</option>
                                            <option value="1">Hot</option>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="product_status">Tình trạng </label>
                                          <select class="form-control" name="product_status" id="product_status">
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
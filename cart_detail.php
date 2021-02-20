<?php
session_start();

include("config/config.php");
include("config/database.php");
include("header1.php");
ini_set('display_errors', 1);
if(empty($_SESSION["username"]))
{
    header("Location:".URL."index.php");
}
if(isset($_GET["id"])){
  $id=(int)$_GET["id"];
}else {
  header("Location:".URL."show_user.php");
}
if(isset($_GET["mess"])){
  $mess=$_GET["mess"];
}else $mess="";
    if(isset($_POST['submit'])){
        $sql = "UPDATE cart set email ='".$_POST["email"]."', phone ='".$_POST["phone"]."', address ='".$_POST["address"]."', goods ='".$_POST["goods"]."', create_date = NOW() where user_id =".$id;
        $db = new Database(db_host, db_name, db_username, db_password);
        $result1 = $db->Update($sql);
        if($result1){
          $mess="Sửa thành công";
        }
    }      
    $db = new Database(db_host, db_name, db_username, db_password);
    $query="SELECT * FROM cart WHERE cart_id=".$id;
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
                                <h2>Sửa danh mục sản phẩm</h2>
                                <?php
                                    echo '<a href="'.URL.'show_user.php">Trở về</a>'
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
                                          <label for="cart_id">ID mua hàng: </label>
                                          <input type="text" class="form-control" id="cart_id" name="cart_id" value="<?php echo $result[0]["cart_id"];?> " disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="username">Tài khoản: </label>
                                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $result[0]["username"];?> " disabled>
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email: </label>
                                          <input type="text" class="form-control" id="email" name="email" value="<?php echo $result[0]["email"];?> " >
                                      </div>
                                      <div class="form-group">
                                          <label for="phone">Điện thoại: </label>
                                          <input type="text" class="form-control" id="intTextBox" name="phone" value="<?php echo $result[0]["phone"];?> ">
                                      </div>
                                      <div class="form-group">
                                          <label for="address">Địa chỉ: </label>
                                          <input type="text" class="form-control" id="address" name="address" value="<?php echo $result[0]["address"];?> ">
                                      </div>
                                      <div class="form-group">
                                          <label for="goods">Đơn hàng: </label>
                                          <textarea type="text" class="form-control" id="goods" name="goods"><?php echo $result[0]["goods"];?></textarea>
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
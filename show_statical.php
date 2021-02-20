<?php
    session_start();
    include("config/config.php");
    if(empty($_SESSION["username"]))
    {
        header("Location:".URL."index.php");
    }
    include("header1.php");
    include("config/database.php");

    $db = new Database(db_host, db_name, db_username, db_password);
    $sql="SELECT * FROM statical";
    //   echo $sql;exit;
    $result = $db->Select($sql)
  
?>
    <style>
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
                                <h2>Thống kê</h2>
                                <div class="clearfix" style="position: absolute; right: 0"></div>
                            </div>
                            <div id="myfirstchart" style="height: 250px;">
                         </div>
                            <div class="x_content">
        <table class="table table-bordered table-sm" style="margin-top: 20px">
          <thead>
            <tr>
              <th style="text-align: center;">STT</th>
              <th>Vốn</th>
              <th>Thu được</th>
              <th>Lợi nhuận</th>
              <th>Ngày</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($result){
            foreach($result as $key=>$value){
                $key=$key+1;
                echo '<tr>
                <td>'.$key.'</td>
                <td style="text-align: right">'.number_format($value["invesment"]).' VNĐ</td>
                <td style="text-align: right">'.number_format($value["collected"]).' VNĐ</td>
                <td style="text-align: right">'.number_format($value["collected"]-$value["invesment"]).' VNĐ</td>
                <td style="text-align: right">'.Date("d/m/Y",strtotime($value["create_date"])).'</td>
              </tr>';
            }
          }else{
              echo '<tr><td colspan="12" align="center">Không có dữ liệu</td></tr>';
          }
            ?>
          
          </tbody>
        </table>
                            </div>
                            <div style="text-align: right">Doanh thu: <?php
                                $total = 0 ;
                                if($result){
                                    foreach($result as $key=>$value){
                                        $total += $value["collected"]-$value["invesment"];
                                       
                                    }
                                    echo number_format($total)." VNĐ";
                                }
                            ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php
    include("footer.php")
?>


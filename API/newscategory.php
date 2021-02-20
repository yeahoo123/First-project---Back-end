<?php
    include("../config/config.php");
    include("../config/database.php");
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
  $db = new Database(db_host, db_name, db_username, db_password);
  $sql="SELECT * FROM newscategory WHERE 1=1 ".$where.$where2." ORDER By create_date DESC LIMIT ".$offset.",".LIMIT;
  //echo $sql;exit;
  $result = $db->Select($sql);
    echo json_encode($result);
    // echo "<pre>";print_r($result);echo "</pre>";
?>

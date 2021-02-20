<?php

    include("../config/config.php");
    include("../config/database.php");
    header('Access-Control-Allow-Origin: http://localhost:3000/');
    header('Access-Control-Allow-Credentials: true *');

    if(isset($_GET["status"])){
        $status=(int)$_GET["status"];
      }else{
        $status=2;
      }
  
      if(isset($_GET["parentid"])){
          $parentid=(int)$_GET["parentid"];
      }else{
          $parentid=999;
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
  
      $where="";$where2="";$where3="";
  
      if($status!=2)
      {
          $where=" AND category_status=".$status;
      }else $where="";
  
      if($search!="")
      {
          $where2=" AND category_name like '%".$search."%'";
      }else $where2="";
  
      if($parentid!=999)
      {
          $where3=" AND parent_id=".$parentid;
      }else $where3="";

      $db = new Database(db_host, db_name, db_username, db_password);
      $sql="SELECT * FROM category WHERE 1=1 ".$where.$where2.$where3;
      //echo $sql;exit;
      $result = $db->Select($sql);
    echo json_encode($result);
    // echo "<pre>";print_r($result);echo "</pre>";
?>

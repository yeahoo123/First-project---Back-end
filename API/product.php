<?php
    include("../config/config.php");
    include("../config/database.php");
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
  $sql="SELECT *, category.category_name FROM product INNER JOIN category  WHERE 1=1 ".$where.$where1.$where2.$where3.$where4.$where5." and category.category_id = product.category_id  ";
  $result = $db->Select($sql);
  echo json_encode($result);
    // echo "<pre>";print_r($result);echo "</pre>";
?>
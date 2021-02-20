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
    if(isset($_GET["ishome"])){
        $ishome=(int)$_GET["ishome"];
    }else{
        $ishome=2;
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
    $where="";$where1="";$where2="";$where3="";$where4="";
    if($status!=2)
    {
        $where=" AND news_status=".$status;
    }else $where="";
    
    if($ishot!=2)
    {
        $where1=" AND news_isHot=".$ishot;
    }else $where1="";
    if($ishome!=2)
    {
        $where4=" AND news_isHome=".$ishome;
    }else $where4="";
  
    if($search!=""){
      $where2=" AND news_title like '%".$search."%'";
    }else $where2="";
    $offset=$page*LIMIT-LIMIT;
    if($category!=999)
    {
        $where3=" AND news_ctgr_id=".$category;
    }else $where3="";
    $db = new Database(db_host, db_name, db_username, db_password);
    $sql="SELECT *, newscategory.news_ctgr_name FROM news  INNER JOIN newscategory WHERE 1=1 ".$where.$where1.$where2.$where3.$where4." and news.news_ctgr_id = newscategory.news_ctgr_id ORDER By news.create_date DESC ";
    //echo $sql;exit;
    $result = $db->Select($sql);
    echo json_encode($result);
    // echo "<pre>";print_r($result);echo "</pre>";
?>

<?php
    session_start();
    include("config/config.php");
    include("config/database.php");
    if(empty($_SESSION["username"]))
    {
        header("Location:".URL."show_news.php");
    }
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
    $pid=$_GET["id"];
    $query="DELETE FROM news WHERE news_id=".$pid."";
    $db = new Database(db_host, db_name, db_username, db_password);
    $result=$db->Remove($query);
    header("Location:".URL."show_news.php?category=".$category."&ishome=".$ishome."&ishot=".$ishot."&status=".$status."&search=".$search);
?>
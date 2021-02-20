<?php
    session_start();
    include("config/config.php");
    include("config/database.php");
    if(empty($_SESSION["username"]))
    {
        header("Location:".URL."show_newscategory.php");
    }
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
    $pid=$_GET["id"];
    $query="DELETE FROM newscategory WHERE news_ctgr_id=".$pid."";
    $db = new Database(db_host, db_name, db_username, db_password);
    $result=$db->Remove($query);
    header("Location:".URL."show_newscategory.php?status=".$status."&priority=".$priority."&parentid=".$parentid."&search=".$search."&page=".$page);
?>
<?php
session_start();
include("../config/config.php");
include("../config/database.php");
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');
$json = json_decode(file_get_contents('php://input'),true);
// echo "<pre>";print_r($json);    
if(isset($json)){
    $sql="INSERT into order1(name, email, phone, address, total, total2, cart, order_check, create_date) values('".$json["name"]."','".$json["email"]."','".$json["phone"]."','".$json["address"]."','".$json["total"]."','".$json["totalInvest"]."','".json_encode($json["cart"])."',0,now())";
    $db = new Database(db_host, db_name, db_username, db_password);
    $result1 = $db->Insert($sql);
}
?>
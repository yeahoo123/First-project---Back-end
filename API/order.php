<?php
    include("../config/config.php");
    include("../config/database.php");    
    $db = new Database(db_host, db_name, db_username, db_password);
    $sql = "SELECT * from order1";
    $result = $db->Select($sql);
    echo json_encode($result);
?>
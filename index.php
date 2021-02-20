<?php
    session_start();
    include("config/config.php");
    include("config/database.php");
    $error = "";
    if(isset($_POST["submit"]))
    {
        $db = new Database(db_host,db_name,db_username,db_password);
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = "SELECT * FROM user WHERE username='".$username."' && password='".$password."'";
        $result = $db->Select($query);
        echo "<pre>";print_r($result);echo "</pre>";
        if($result){
            $_SESSION["username"] = $result[0]["username"];
            $_SESSION["email"] = $result[0]["email"];
            // print_r($_SESSION);
            // exit;
            header("Location:".URL."show_statical.php");
            exit;
        }else{
            $error="<div class=\"alert alert-danger col-lg-6 col-lg-push-3\">
                    <strong style=\"color:white\">Lỗi! </strong> Sai tên tài khoản hoặc mật khẩu.
                    </div>";
        }
        // echo "<pre>";print_r($result);echo "</pre>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quản trị</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/animate.min.css" >
    <link rel="stylesheet" href="css/custom.min.css" >

    <!-- Jquery -->
    <link rel="stylesheet" href="js/jquery.min.js" >
    <link rel="stylesheet" href="css/jquery.css" >

    <!-- Custom Css -->
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background-color: #f1f4f7 !important;
        }
    </style>
</head>

<br>

<div class="col-lg-12 text-center " >
<body class="login">
<div class="login_wrapper">
    <section class="login_content">
        <form name="form" action="" method="post" >
            <h1 data-translate="login">Quản trị viên</h1>
            <div>
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required=""/>
            </div>
            <div>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required=""/>
            </div>
            <div class="login" style="align-items: center">
                <input class="btn btn-default submit" type="submit" name="submit" value="Đăng nhập">
            </div>
            </div>
        </form>
    </section>
</div>
<?php 
    if($error!="") 
    echo $error; 
?>
</body>
</html>


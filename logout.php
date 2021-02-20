<?php
    session_start();
    session_unset();
    include("config/config.php");
    header("Location:".URL."index.php");
?>
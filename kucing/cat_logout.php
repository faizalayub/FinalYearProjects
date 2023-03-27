<?php
    session_start(); 
    session_destroy();
    header("location:./cat_login.php");
?>
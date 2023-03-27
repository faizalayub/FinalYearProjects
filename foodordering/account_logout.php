<?php
    session_start(); 
    session_destroy();
    header("location:./account_login.php");
?>
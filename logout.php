<?php
    session_start();
    unset($_SESSION['username']);
    header("location:login_Thanh.php")
?>
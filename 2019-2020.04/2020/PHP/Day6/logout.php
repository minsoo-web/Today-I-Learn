<?php
session_start();
$_SESSION['userid'] = "";
echo "<script>alert('로그아웃');location.href= 'login.php';</script>";

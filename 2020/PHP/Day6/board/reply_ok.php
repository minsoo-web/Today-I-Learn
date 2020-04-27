<?php
include "../include/session_check.php";
include "../include/dbconn.php";

$b_idx = $_GET['b_idx'];

$re_userid = $_POST['re_userid'];
$content = $_POST['re_content'];

$sql = "INSERT INTO	tb_reply (re_userid, re_content, re_boardidx) 
        VALUES ('" . $_SESSION['userid'] . "','$content',$b_idx);";


$result = mysqli_query($conn, $sql);
echo "<script>alert('등록되었습니다.');location.href='detail.php?b_idx=" . $b_idx . "'</script>";

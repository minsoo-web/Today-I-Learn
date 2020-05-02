<?php
include "../include/session_check.php";
include "../include/dbconn.php";

$re_idx = $_GET['re_idx'];
$b_idx = $_GET['b_idx'];

$sql = "delete FROM tb_reply WHERE re_idx=$re_idx and re_userid='" . $_SESSION['userid'] . "'";
$result = mysqli_query($conn, $sql);

echo "<script>alert('삭제되었습니다.');location.href='detail.php?b_idx=" . $b_idx . "'</script>";

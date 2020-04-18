<?php
session_start();
include "include/dbconn.php";

$userId = $_POST["userId"];
$userPw = $_POST["userPw"];

$sql = "SELECT mem_idx, mem_userid, mem_name FROM tb_member WHERE mem_userid='$userId' and mem_pass=password('$userPw') ";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

if ($row['mem_userid'] != "") {
    // 세션에 저장 
    $_SESSION['userid'] = $userId;
    $_SESSION['useridx'] = $row['mem_idx'];
    $_SESSION['username'] = $row['mem_name'];
?>
    <script>
        alert("로그인되었습니다.")
        history.back();
    </script>
<?php
} else {
?>
    <script>
        alert("틀렸습니다.")
        history.back();
    </script>
<?php
}
?>
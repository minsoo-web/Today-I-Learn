<?php
include "../include/session_check.php";
include "../include/dbconn.php";


$b_idx = $_GET['b_idx'];
$sql = "SELECT * FROM tb_board WHERE b_idx=$b_idx";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);


if ($row['b_userid'] != $_SESSION['userid']) {
?>
    <script>
        alert("삭제 권한이 없는 글입니다.");
        history.back();
    </script>
    <?php
} else {
    $sql = "DELETE FROM tb_board WHERE b_idx=$b_idx and b_userid ='" . $_SESSION['userid'] . "' ";

    $result = mysqli_query($conn, $sql);
    echo $result;
    if ($result == 1) {
    ?>
        <script>
            alert("삭제되었습니다.");
            location.href = 'list.php';
        </script>
<?php
    } else {
        echo "삭제 오류";
    }
}

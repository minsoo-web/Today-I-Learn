<?php
include "../include/session_check.php";
include "../include/dbconn.php";

// 목록 최신순으로 불러오기 
$sql = "SELECT b_idx, b_title, b_userid, b_file, b_registdate, b_hit FROM tb_board ORDER BY b_idx DESC";

$result = mysqli_query($conn, $sql);

$total_count = $result->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>list</h2>
    <p>전체 게시물 수 :<?= $total_count ?> 개</p>
    <table border="1" width="800">
        <tr>
            <th width="50">번호</th>
            <th width="300">제목</th>
            <th width="150">글쓴이</th>
            <th width="100">조회수</th>
            <th width="200">날짜</th>
        </tr>
        <?php
        $num = 0;
        while ($row = mysqli_fetch_array($result)) {
            $i = $total_count - $num;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><a href="detail.php?b_idx=<?= $row['b_idx'] ?>"><?= $row['b_title'] ?></a></td>
                <td><?= $row['b_userid'] ?></td>
                <td><?= $row['b_hit'] ?></td>
                <td><?= $row['b_registdate'] ?></td>
            </tr>
        <?php
            $num++;
        }
        ?>
    </table>
    <a href="../login.php">홈으로</a>
    <input type="button" value="새 글 작성" onclick="javascript:location.href='write.php'">
</body>

</html>
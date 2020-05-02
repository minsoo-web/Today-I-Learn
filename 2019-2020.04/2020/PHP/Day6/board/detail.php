<?php
include "../include/session_check.php";
include "../include/dbconn.php";

$b_idx = $_GET['b_idx'];

// 조회수 증가 
$sql1 = "update tb_board set b_hit =b_hit +1 where b_idx=$b_idx";
$result = mysqli_query($conn, $sql1);

// 데이터 뽑기 
$sql = "SELECT b_idx,b_userid,b_title,b_content,b_file,b_ip,b_registdate,b_hit,mem_name FROM tb_board AS b JOIN tb_member AS m on b.b_userid=m.mem_userid WHERE b_idx=$b_idx";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

$ifUser = true;

if ($row['b_userid'] != $_SESSION['userid']) {
    $ifUser = false;
}

$re_sql = "SELECT mem_name,re_idx, re_userid, re_content, re_registdate,re_boardidx FROM tb_reply AS re JOIN tb_member AS m ON re.re_userid =m.mem_userid WHERE re_boardidx=$b_idx ORDER BY re_idx DESC";

$re_result = mysqli_query($conn, $re_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글보기</title>
</head>

<body>
    <h2>글보기</h2>
    <p>글쓴이 : <?= $row['mem_name'] ?> (<?= $row['b_userid'] ?>)</p>
    <p>날짜 : <?= $row['b_registdate'] ?> (<?= $row['b_ip'] ?>)</p>
    <p>조회수 : <?= $row['b_hit'] ?></p>
    <p>제목 : <?= $row['b_title'] ?></p>
    <p>내용</p>
    <p><?= $row['b_content'] ?></p>
    <?php
    if (strlen($row['b_file']) > 2) {
    ?>
        <p>
            <img src="<?= $row['b_file'] ?>" alt="첨부파일">
        </p>
    <?php
    }
    ?>
    <p>
        <?php
        if ($ifUser) { ?>
            <input type="button" value="글 수정" onclick="javascript:location.href='update.php?b_idx=<?= $row['b_idx'] ?>'">
            <input type="button" value="글 삭제" onclick="javascript:location.href='delete.php?b_idx=<?= $row['b_idx'] ?>'">
        <?php
        }
        ?>
        <input type="button" value="글 목록" onclick="javascript:location.href='list.php'">
    </p>

    <form action="reply_ok.php?b_idx=<?= $b_idx ?>" method="POST">
        <p>
            <?= $_SESSION['userid'] ?>
            <input type="text" name="re_content" placeholder="댓글을 입력하세요">
            <input type="submit" value="댓글달기">
        </p>
    </form>
    <?php
    $total_count = $re_result->num_rows;
    $num = 0;
    while ($re_row = mysqli_fetch_array($re_result)) {
        $i = $total_count - $num;
    ?>
        <p>
            <!-- 댓글 번호 -->
            <span>
                <?= $num + 1 ?>
            </span>
            <!-- 댓글 작성자 -->
            <span>
                <?= $re_row['mem_name'] ?>(<?= $re_row['re_userid'] ?>)
            </span>
            <!-- 댓글 내용 -->
            <span>
                | <?= $re_row['re_content'] ?>
            </span>
            <!--  댓글 작성 날짜 -->
            <span> <?= $re_row['re_registdate'] ?></span>
            <?php
            if ($_SESSION['userid'] == $re_row['re_userid']) {
            ?>
                <input type="button" value="삭제" onclick="javascript:location.href='reply_del_ok.php?re_idx=<?= $re_row['re_idx'] ?>&b_idx=<?= $b_idx ?>'" />
            <?php
            }
            ?>
        </p>
    <?php
        $num++;
    }
    ?>
</body>

</html>

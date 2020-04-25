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
        alert("수정 권한이 없는 글입니다.");
        history.back();
    </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수정페이지</title>
    <script src="../js.image.js"></script>
</head>

<body>
    <h2>수정하기</h2>
    <form action="update_ok.php?b_idx=<?= $row['b_idx'] ?>" method="post" enctype="multipart/form-data">
        <p>
            <?= $_SESSION['username'] ?>님
            (<?= $_SESSION['userid'] ?>)
        </p>
        <p>
            <label>제목 :
                <input type="text" name="b_title" placeholder="제목을 입력하세요" value="<?= $row['b_title'] ?>">
            </label>
        </p>
        <p>
            <label>내용 :
                <textarea name="b_content" cols="40" rows="6" placeholder="내용을 입력하세요"><?= $row['b_content'] ?></textarea>
            </label>
        </p>
        <p>
            <p><img src="<?= $row['b_file'] ?>" alt=""></p>
            파일 수정:
            <input type="file" name="b_file" onchange="onchange()">
        </p>
        <input type="submit" value="제출">
        <input type="reset" value="재작성">
        <input type="button" value="목록 보기" onclick="javascript:location.href='./list.php'">
    </form>
</body>

</html>
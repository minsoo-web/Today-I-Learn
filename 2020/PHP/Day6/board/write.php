<?php
include "../include/session_check.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기 페이지</title>
</head>

<body>
    <h2>글쓰기</h2>
    <form action="write_ok.php" method="post" enctype="multipart/form-data">
        <p>
            <?= $_SESSION['username'] ?>님
            (<?= $_SESSION['userid'] ?>)
        </p>
        <p>
            <label>제목 :
                <input type="text" name="b_title" placeholder="제목을 입력하세요">
            </label>
        </p>
        <p>
            <label>내용 :
                <textarea name="b_content" cols="40" rows="6" placeholder="내용을 입력하세요"></textarea>
            </label>
        </p>
        <p>
            파일 :
            <input type="file" name="b_file">
        </p>
        <input type="submit" value="제출">
        <input type="reset" value="재작성">
        <input type="button" value="목록 보기" onclick="javascript:location.href='./list.php'">
    </form>
</body>

</html>
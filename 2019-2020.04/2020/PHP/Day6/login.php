<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SESSION['userid'] == "") {
    ?>
        <h2>로그인</h2>
        <form method="POST" action="login_ok.php">
            <p><label>아이디 : <input type="text" name="userId"></label></p>
            <p><label>비밀번호 : <input type="password" name="userPw"></label></p>
            <p><input type="submit" value="로그인"><input type="button" value="회원가입" onclick="location.href='regist.php'"></p>
        </form>
    <?php
    } else {
    ?>
        <h2><?= $_SESSION['username'] ?>님 환영합니다.</h2>
        <p><a href="modify.php">정보수정</a> | <a href="logout.php">로그아웃</a></p>
        <p><a href="board/list.php">커뮤니티 게시판</a></p>
    <?php
    }
    ?>

</body>

</html>

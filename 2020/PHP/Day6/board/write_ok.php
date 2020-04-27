<?php

include "../include/session_check.php";
include "../include/dbconn.php";
$b_title = $_POST['b_title'];
$b_content = $_POST['b_content'];
$b_ip = $_SERVER['REMOTE_ADDR'];


if ($_FILES['b_file']['tmp_name']) {

    $uploads_dir = "./upload";
    $allowd_ext = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

    $error = $_FILES['b_file']['error'];

    $name = $_FILES['b_file']['name'];

    $ext = explode(".", $name);
    $rename = $ext[0] . time();

    $rename = $rename . "." . $ext[1];

    $ext = strtolower(array_pop($ext));


    if ($error != UPLOAD_ERR_OK) {
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "파일 크기가 너무 큽니다.";
                break;

            case UPLOAD_ERR_NO_FILE:
                echo "파일 첨부가 되지 않았습니다.";
                break;

            default:
                echo "파일 업로드 실패";
        }
        exit;
    }

    if (!in_array($ext, $allowd_ext)) {
        echo "허용되지 않은 확장명";
        exit;
    }


    move_uploaded_file($_FILES['b_file']['tmp_name'], "$uploads_dir/$rename");
}
$sql = "INSERT INTO tb_board (b_userid, b_title,b_content,b_file,b_ip) VALUES ('" . $_SESSION['userid'] . "','$b_title','$b_content','$uploads_dir/$rename','$b_ip')";

$result = mysqli_query($conn, $sql);
echo "<script>alert('저장'); location.href = 'list.php';</script>";

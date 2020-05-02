<?php
session_start();
include "include/dbconn.php";

// 아이디와 이름은 수정 x
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

$userpw = $_POST["userpw"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$hobby = $_POST["hobby"];
$hobbystr = "";
foreach ($hobby as $h) {
    $hobbystr .= $h . " ";
}
$ssn1 = $_POST["ssn1"];
$ssn2 = $_POST["ssn2"];
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];

$zipcode = $_POST["zipcode"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$address3 = $_POST["address3"];
$hp = $_POST["hp"];

if (!$conn) {
    echo "연결객체 생성 실패";
} else {
    $sql = "UPDATE tb_member 
    set 
        mem_email='$email' ,
        mem_pass=password('$userpw'), 
        mem_gender='$gender',
        mem_ssn ='$ssn1$ssn2' , 
        mem_zipcode = '$zipcode' ,
        mem_address1 = '$address1' ,
        mem_address2 = '$address2' ,
        mem_address3 = '$address3' ,
        mem_hobby='$hobbystr',
        mem_hp = '$hp'
    WHERE mem_userid='$userid'";
    $result = mysqli_query($conn, $sql); // 적용된 결과의 갯수 리턴;
    echo "{$result}개의 데이터가 정상적으로 update 되었습니다.";
}

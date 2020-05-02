<?php
session_start();
include "include/dbconn.php";

$userId = $_SESSION['userid'];


if (!$conn) {
    echo "연결객체 생성 실패";
} else {
    $sql = "SELECT mem_userid,mem_pass,mem_name,mem_email,
    mem_gender,mem_ssn, mem_zipcode,mem_address1,
    mem_address2,mem_address3,mem_hobby,mem_hp FROM tb_member WHERE mem_userid='$userId' ";
    $result = mysqli_query($conn, $sql); // 적용된 결과의 갯수 리턴;
    $row = mysqli_fetch_array($result);
}

// 주민번호 자르기 
$ssn1 = substr($row['mem_ssn'], 0, 6);
$ssn2 = substr($row['mem_ssn'], 6,);

// 성별
$gender = substr($row['mem_ssn'], 6, 1);
$month = substr($row['mem_ssn'], 2, 2);
$day = substr($row['mem_ssn'], 4, 2);

if ($gender = 1 | $gender = 2) {
    $year = "19";
} else {
    $year = "20";
}
$year .= substr($row['mem_ssn'], 0, 2);


$hobby = explode(" ", $row['mem_hobby']);
for ($i = 0; $i < count($hobby); $i++) {
    if ($hobby[$i]) {
?>
        <p id="hobby<?= $i ?>" class="hobbyCheck" style="display:none;"><?= $hobby[$i] ?></p>
<?php
    }
}

?>
<!DOCTYPE html>
<html lang=" en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보 수정</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/modify.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
</head>

<body>
    <h2>회원수정</h2>
    <form method="post" action="modify_ok.php" onsubmit="return checkForm()">
        <p>아이디 : <?= $_SESSION['userid'] ?></p>
        <p><label>비밀번호 : <input type="password" name="userpw" maxlength="16" id="userpw"></label></p>
        <p><label>비밀번호 확인 : <input type="password" name="userpw_re" maxlength="16" id="userpw_re"></label></p>
        <p>* 비밀번호는 특수문자/영문자/숫자를 포함한 8자~16자로 입력하세요.</p>
        <p>이름 : <?= $_SESSION['username'] ?></p>
        <p><label>이메일 : <input type="text" name="email" id="email" value="<?= $row['mem_email'] ?>"></label></p>
        <p>성별 :
            <label>남자<input type="radio" name="gender" value="남자" <?php
                                                                    if ($row['mem_gender'] == '남자') {
                                                                        echo ("checked");
                                                                    }
                                                                    ?>>
            </label>
            <label>여자<input type="radio" name="gender" value="여자" <?php
                                                                    if ($row['mem_gender'] == '여자') {
                                                                        echo ("checked");
                                                                    }
                                                                    ?>>
            </label>
        </p>
        <p><?= $row['mem_hobby'] ?></p>
        <p>취미 :
            <label>인터넷<input type="checkbox" name="hobby[]" value="인터넷"></label>
            <label>영화감상<input type="checkbox" name="hobby[]" value="영화감상"></label>
            <label>등산<input type="checkbox" name="hobby[]" value="등산"></label>
            <label>쇼핑<input type="checkbox" name="hobby[]" value="쇼핑"></label>
            <label>드라이브<input type="checkbox" name="hobby[]" value="드라이브"></label>
        </p>
        <p>주민등록번호 : <input type="text" name="ssn1" id="ssn1" maxlength="6" value="<?= $ssn1 ?>"> - <input type="text" name="ssn2" id="ssn2" maxlength="7" value="<?= $ssn2 ?>"> <input type="button" id="btnssn" value="주민등록번호 유효성 체크"></p>
        <input type="hidden" id="isssn" value="no">
        <p>생년월일 :
            <input type="text" name="year" id="year" readonly value="<?= $year ?>">년
            <input type="text" name="month" id="month" readonly value="<?= $month ?>">월
            <input type="text" name="day" id="day" readonly value="<?= $day ?>">일</p>
        <p>
            <label>우편번호 : <input type="text" name="zipcode" readonly id="sample6_postcode" placeholder="우편번호" value="<?= $row['mem_zipcode'] ?>">
                <input type="button" value="우편번호 검색" onclick="sample6_execDaumPostcode()"></label>
        </p>
        <p><label>주소 : <input type="text" name="address1" id="sample6_address" placeholder="주소" value="<?= $row['mem_address1'] ?>"></label></p>
        <p><label>상세주소 : <input type="text" name="address2" id="sample6_detailAddress" placeholder="상세주소" value="<?= $row['mem_address2'] ?>"></label></p>
        <p><label>참고사항 : <input type="text" name="address3" id="sample6_extraAddress" placeholder="참고항목" value="<?= $row['mem_address3'] ?>"></label></p>
        <p><label>휴대폰 : <input type="text" name="hp" id="hp" value="<?= $row['mem_hp'] ?>"></label></p>

        <p><input type="submit" value="회원정보 수정"> <input type="reset" value="다시입력"></p>
    </form>
    <script>
        $(function() {
            var hobby = $(".hobbyCheck");
            for (let i = 0; i < hobby.length; i++) {
                var checkedHobby = hobby[i].innerHTML;
                // console.log($(`input[value="${checkedHobby}"]`)[0]);
                $(`input[value="${checkedHobby}"]`)[0].setAttribute("checked", "true");
            }

        })
    </script>
</body>

</html>
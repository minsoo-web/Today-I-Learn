function checkForm() {
  var idCheck = RegExp(/^[a-zA-Z0-9]{4,16}$/);
  var pwCheck = RegExp(
    /^.*(?=^.{8,16}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/
  );
  var nameCheck = RegExp(/^[가-힣]+$/);
  var emailCheck = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-/]+\.[A-Za-z0-9\-]+/);
  var hobbyCheck = false;
  var hpCheck = RegExp(/^\d{3}-\d{3,4}-\d{4}$/);

  if (!idCheck.test($("#userid").val())) {
    alert("아이디를 형식에 맞게 입력하세요.");
    $("#userid").val("");
    $("#userid").focus();
    return false;
  }
  if (!pwCheck.test($("#userpw").val())) {
    alert("비밀번호를 형식에 맞게 입력하세요.");
    $("#userpw").val("");
    $("#userpw").focus();
    return false;
  }
  if ($("#userpw").val() != $("#userpw_re").val()) {
    alert("비밀번호가 서로 다릅니다.");
    $("#userpw").val("");
    $("#userpw_re").val("");
    $("#userpw").focus();
    return false;
  }
  if (!nameCheck.test($("#username").val())) {
    alert("이름은 한글로 입력하세요.");
    $("#username").val("");
    $("#username").focus();
    return false;
  }
  if (!emailCheck.test($("#email").val())) {
    alert("이메일을 형식에 맞게 입력하세요.");
    $("#email").val("");
    $("#email").focus();
    return false;
  }
  for (var i = 0; i < $('[name="hobby[]"]').length; i++) {
    if ($('input:checkbox[name="hobby[]"]').eq(i).is(":checked") == true) {
      hobbyCheck = true;
      break;
    }
  }
  if (!hobbyCheck) {
    alert("취미를 한 개 이상 선택하세요.");
    return false;
  }
  if ($("#ssn1").val() == "" || $("#ssn2").val() == "") {
    alert("주민등록번호를 입력하세요.");
    $("#ssn1").focus();
    return false;
  }
  if ($("#isssn").val() == "no") {
    alert("주민등록번호 유효성 체크를 눌러주세요.");
    $("#btnssn").focus();
    return false;
  }
  // http://postcode.map.daum.net/guide 다음 주소 API 이용
  if ($("#sample6_postcode").val() == "") {
    alert("우편번호를 검색하세요.");
    $("#sample6_postcode").focus();
    return false;
  }
  if (
    ($("#sample6_address").val() == "") |
    ($("#sample6_detailAddress").val() == "")
  ) {
    alert("주소를 확인하세요.");
    $("#sample6_address").focus();
    return false;
  }
  if (!hpCheck.test($("#hp").val())) {
    alert("휴대폰 형식에 맞게 입력하세요.(-포함)");
    $("#hp").val();
    $("#hp").focus();
    return false;
  }

  return true;
}

$(function () {
  $("#ssn1").on("keyup", function () {
    if ($(this).val().length >= 6) {
      $("#ssn2").trigger("focus");
    }
  });
});

$(function () {
  $("#btnssn").on("click", function () {
    if ($("#ssn1").val() == "" || $("#ssn2").val() == "") {
      alert("주민등록번호를 입력하세요.");
      $("#ssn1").focus();
      return false;
    }

    var ssn = $("#ssn1").val() + $("#ssn2").val();
    // alert(ssn);
    var fmt = RegExp(/^\d{6}[12345]\d{6}$/);
    if (!fmt.test(ssn)) {
      alert("주민등록번호 형식을 확인하세요.");
      $("#ssn1").val("");
      $("#ssn2").val("");
      $("#ssn1").focus();
      return false;
    }
    var arr = new Array(13);
    // 0010111068512
    // arr[0] = 0;
    // arr[1] = 0;
    // arr[2] = 1;
    // arr[3] = 0;
    // ...
    // arr[12] = 2;
    for (var i = 0; i < arr.length; i++) {
      arr[i] = parseInt(ssn.charAt(i));
    }
    var mul = [2, 3, 4, 5, 6, 7, 8, 9, 2, 3, 4, 5];
    var sum = 0;
    for (var i = 0; i < 12; i++) {
      sum += arr[i] *= mul[i];
    }
    if ((11 - (sum % 11)) % 10 != arr[12]) {
      alert("유효하지 않은 주민등록번호입니다.");
      $("#ssn1").val("");
      $("#ssn2").val("");
      $("#ssn1").focus();
      return false;
    }
    alert("인증되었습니다.");
    $("#isssn").val("yes");
    // 0010111068512
    var birthYear = ssn.charAt(6) <= "2" ? "19" : "20";
    birthYear += $("#ssn1").val().substr(0, 2); // 2000
    var birthMonth = $("#ssn1").val().substr(2, 2); // 10
    var birthDay = $("#ssn1").val().substr(4, 2); // 11
    $("#year").val(birthYear);
    $("#month").val(birthMonth);
    $("#day").val(birthDay);
  });
});

function sample6_execDaumPostcode() {
  new daum.Postcode({
    oncomplete: function (data) {
      // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

      // 각 주소의 노출 규칙에 따라 주소를 조합한다.
      // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
      var addr = ""; // 주소 변수
      var extraAddr = ""; // 참고항목 변수

      //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
      if (data.userSelectedType === "R") {
        // 사용자가 도로명 주소를 선택했을 경우
        addr = data.roadAddress;
      } else {
        // 사용자가 지번 주소를 선택했을 경우(J)
        addr = data.jibunAddress;
      }

      // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
      if (data.userSelectedType === "R") {
        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
        if (data.bname !== "" && /[동|로|가]$/g.test(data.bname)) {
          extraAddr += data.bname;
        }
        // 건물명이 있고, 공동주택일 경우 추가한다.
        if (data.buildingName !== "" && data.apartment === "Y") {
          extraAddr +=
            extraAddr !== "" ? ", " + data.buildingName : data.buildingName;
        }
        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
        if (extraAddr !== "") {
          extraAddr = " (" + extraAddr + ")";
        }
        // 조합된 참고항목을 해당 필드에 넣는다.
        document.getElementById("sample6_extraAddress").value = extraAddr;
      } else {
        document.getElementById("sample6_extraAddress").value = "";
      }

      // 우편번호와 주소 정보를 해당 필드에 넣는다.
      document.getElementById("sample6_postcode").value = data.zonecode;
      document.getElementById("sample6_address").value = addr;
      // 커서를 상세주소 필드로 이동한다.
      document.getElementById("sample6_detailAddress").focus();
    },
  }).open();
}

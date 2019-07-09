<?php
header("content-type:text/html; charset=UTF-8");

include("./db_connect.php");
$connect = dbconn();
$member = member();

$no = $_POST['no'];
$pw_1 = $_POST['pw_1'];
$pw_2 = $_POST['pw_2'];
$birth_1 = $_POST['birth_1'];
$birth_2 = $_POST['birth_2'];
$birth_3 = $_POST['birth_3'];
$tel_1 = $_POST['tel_1'];
$tel_2 = $_POST['tel_2'];
$tel_3 = $_POST['tel_3'];
$email_1 = $_POST['email_1'];
$email_2 = $_POST['email_2'];

if(!$pw_1) Error("비밀번호를 입력하세요.");
if(!$pw_2) Error("비밀번호 확인을 입력하세요.");
if($pw_1 !== $pw_2) {
  Error("비밀번호가 일치하지 않습니다.");
  exit;
}
else {
  $pw_1 = md5($pw_1);
}

$birth = $birth_1."/".$birth_2."/".$birth_3;

if($tel_1 && $tel_2 && $tel_3) $tel = $tel_1."-".$tel_2."-".$tel_3;
else $tel = "";
if(!$tel) Error("전화번호를 입력하세요.");
if(preg_match("/[^\d]/", $tel_2)) Error("전화번호는 숫자만 입력해주세요.");
else if(preg_match("/[^\d]/", $tel_3)) Error("전화번호는 숫자만 입력해주세요.");

if($email_1 && $email_2) $email = $email_1."@".$email_2;
else $email = "";
if(!$email) Error("이메일을 입력하세요.");

$query = "UPDATE MEMBER SET
Password = '$pw_1',
Birth = '$birth',
Tel = '$tel',
Email = '$email',
WHERE no = '$no'
";
mysqli_query($connect, "set names utf8");
mysqli_query($connect, $query);
mysqli_close($connect);
?>

<script>
  window.alert("수정되었습니다.");
  location.href = './index.php';
</script>

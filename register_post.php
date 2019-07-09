<?php
header("content-type:text/html; charset=UTF-8");

include ("./db_connect.php");
$connect = dbconn();

$id = $_POST['id'];
$pw_1 = $_POST['pw_1'];
$pw_2 = $_POST['pw_2'];
$dipid = $_POST['dipid'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$birth_1 = $_POST['birth_1'];
$birth_2 = $_POST['birth_2'];
$birth_3 = $_POST['birth_3'];
$tel_1 = $_POST['tel_1'];
$tel_2 = $_POST['tel_2'];
$tel_3 = $_POST['tel_3'];
$email_1 = $_POST['email_1'];
$email_2 = $_POST['email_2'];
$regdate = date("Y-m-d (H:i)", time());
$ip = getenv("REMOTE_ADDR");

if(!$pw_1) Error("비밀번호를 입력하세요.");
if(!$pw_2) Error("비밀번호 확인을 입력하세요.");
if($pw_1 !== $pw_2) {
  Error("비밀번호가 일치하지 않습니다.");
  exit;
}
else {
  $pw_1 = md5($pw_1);
}

if(!$id) Error("아이디를 입력하세요.");
if(substr($id,"12")) Error("아이디는 최대 12자까지만 허용됩니다.");
if(preg_match("/[^a-z 0-9]/",$id)) Error("아이디는 영문소문자와 숫자만 가능합니다.");

if(!$name) Error("이름을 입력하세요.");
if(strlen($name)<6 or strlen($name)>15) Error("이름은 2자에서 5자까지 허용합니다."); //한글은 1자당 3byte

if(!$sex) Error("성별을 선택하세요.");

$birth = $birth_1."/".$birth_2."/".$birth_3;

if($tel_1 && $tel_2 && $tel_3) $tel = $tel_1."-".$tel_2."-".$tel_3;
else $tel = "";
if(!$tel) Error("전화번호를 입력하세요.");
if(preg_match("/[^\d]/", $tel_2)) Error("전화번호는 숫자만 입력해주세요.");
else if(preg_match("/[^\d]/", $tel_3)) Error("전화번호는 숫자만 입력해주세요.");

if($email_1 && $email_2) $email = $email_1."@".$email_2;
else $email = "";
if(!$email) Error("이메일을 입력하세요.");

$query = "INSERT INTO Member(MemberID, Password, Name, Sex, Birth, Tel, Email, RegDate, IP)
VALUES('$id', '$pw_1', '$name', '$sex', '$birth', '$tel', '$email', '$regdate', '$ip')";
mysqli_query($connect, "set names utf8");
mysqli_query($connect, $query);
mysqli_close($connect);
?>

<script>
window.alert('회원가입 완료!');
location.href = './index.php';
</script>

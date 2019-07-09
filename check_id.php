<?php
header("content-type:text/html; charset=UTF-8");

include ("./db_connect.php");
$connect = dbconn();

$id = $_GET['id'];
$sql = "SELECT COUNT(*) FROM member WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);

mysqli_close($connect);
?>

<script>
 var row = "<?=$row[0]?>";
 if(row == 1) {
 parent.document.getElementById("id_2").value = "0";
 parent.alert("이미 사용중인 아이디입니다.");
 }
 else {
 parent.document.getElementById("id_2").value = "1";
 parent.alert("사용 가능합니다.");
 }
</script>

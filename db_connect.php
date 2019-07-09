<?php
function dbconn() {
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dip";
  $connect = mysqli_connect($host, $username, $password, $dbname);
  mysqli_query($connect, "set names uft8");
  if(!$connect) die("연결에 실패하였습니다.".mysqli_error($connect));
  return $connect;
}

function Error($msg) {
  echo "
  <script>
  window.alert('$msg');
  history.back(1);
  </script>
  ";
  exit;
}

function member() {
  global $connect;
  $session = $_SESSION["MEMBER"];
  $query = "SELECT * FROM MEMBER WHERE MemberID = '$session'";
  mysqli_query($connect, "set names utf8");
  $result = mysqli_query($connect, $query);
  $member = mysqli_fetch_array($result);
  return $member;
}

function dipconn() {
  global $connect;
  $session = $_SESSION["DIP"];
  $query = "SELECT * FROM DIP WHERE DipID = '$session'";
  mysqli_query($connect, "set names utf8");
  $result = mysqli_query($connect, $query);
  return $result;
}
?>

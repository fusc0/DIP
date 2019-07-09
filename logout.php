<?php
header("content-type:text/html; charset=UTF-8");
session_start();
session_unset();
session_destroy();
?>

<script>
location.href = './index.php';
</script>

<?php
  require ('connect.php');
  $comment= $_POST["vv"];
  $id =  $_POST["data"];
  $sql = "UPDATE user SET comment='$comment'
  WHERE (user_login = '$id')";
  mysqli_query($connect, $sql) or die('die');
  echo $comment;
?>

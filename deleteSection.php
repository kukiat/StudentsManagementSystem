<?php
  require ('connect.php');
  $sql = "DELETE FROM section WHERE section='".$_POST["id"]."' AND sub_id='".$_POST["id2"]."'";
  mysqli_query($connect, $sql)or die('die');
  echo('ลบเรียบร้อย')

?>

<?php
  require ('connect.php');
 $sql = "DELETE FROM section WHERE sub_id = '".$_POST["id"]."'";
 mysqli_query($connect, $sql);
 $sqlsubject = "DELETE FROM subject WHERE sub_id = '".$_POST["id"]."'";
 //
  mysqli_query($connect, $sqlsubject);
 if(mysqli_query($connect, $sqlsubject)){
    echo 'ลบข้อมูลแล้ว';
 }
?>

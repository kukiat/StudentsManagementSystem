<?php
    require('connect.php');
    $data = mysqli_real_escape_string($connect, $_POST["data_name_edit"]);  //เซคัชั่น
    $code = mysqli_real_escape_string($connect, $_POST["code_name_edit"]);
    $day = mysqli_real_escape_string($connect, $_POST["day_name_edit"]);
    $time = mysqli_real_escape_string($connect, $_POST["time_name_edit"]);
    $prof = mysqli_real_escape_string($connect, $_POST["prof_name_edit"]);
    $room = mysqli_real_escape_string($connect, $_POST["room_name_edit"]);
    $owner = mysqli_real_escape_string($connect, $_POST["owner_name_edit"]);
    $n = mysqli_real_escape_string($connect, $_POST["n_name_edit"]);
    $sql = "UPDATE section SET day='$day', time='$time' ,prof='$prof', room='$room',owner='$owner',n='$n'
    WHERE (sub_id = '$code')AND(section = '$data')";
    mysqli_query($connect, $sql) or die('die');
    echo 'แก้ไขข้อมูลแล้ว';

 ?>

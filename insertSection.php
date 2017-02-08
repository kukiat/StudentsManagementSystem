<?php
  require ('connect.php');
  $output='';
  if(!empty($_POST)){
     $code = $_POST["code_name"];
     $section = $_POST["section_name"];
     $day = $_POST["day_name"];
     $timee = $_POST["time_name"];
     $prof = $_POST["prof_name"];
     $owner = $_POST["owner_name"];
     $room = $_POST["room_name"];
     $n = $_POST["n_name"];
   $query = "INSERT INTO section (sub_id,section,day,time,prof,room,owner,n )
   VALUES('$code', '$section','$day','$timee','$prof','$room','$owner','$n');";
   if(mysqli_query($connect, $query)){
      $select_query = "SELECT * FROM section WHERE section='$section' AND sub_id='$code'";
      $result = mysqli_query($connect, $select_query);
      while($roww = mysqli_fetch_array($result)){
                 $output .= '
                 <div class="panel panel-primary">
                   <div class="panel-heading">
                     <div style="display: inline-block;">
                       <strong class="gggg">'.$roww["section"].'</strong>

                     </div>
                     <div style="display:inline-block; float:right;">
                       <button type="button" name="delete_btn" '.'onclick="test('.      "'".$roww['section']. "',"."'".$roww['day']."',"."'".$roww['time']. "',"."'".$roww['prof']."',"."'".$roww['room']. "',"."'".$roww['owner']."'," . "'" .$roww['n']. "'".    ')" class="btn btn-xs btn-warning" style="display: inline-block;" data-toggle="modal" data-target="#edit_section">แก้ไข</button>
                       <button type="button" name="delete_btn" id="'.$roww["section"].'" class="btn btn-xs btn-danger btn_delete_section" style="display: inline-block;">ลบ</button>
                     </div>
                    </div>
                   <div class="panel-body">
                    <label id="ghgh"></label>
                        '.$roww["sub_id"].'
                     <label>วัน</label>
                          '.$roww["day"].'
                     <label>เวลา</label>
                          '.$roww["time"].'
                     <label>อาจารย์</label>
                          '.$roww["prof"].'
                     <label>ห้อง</label>
                          '.$roww["room"].'
                     <label>เจ้าของวิชา</label>
                          '.$roww["owner"].'
                     <label>จำนวน</label>
                        '.$roww["n"].'
                    </div>
                  </div>
                ';
            }


            echo $output;
  }
 }
?>

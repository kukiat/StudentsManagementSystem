<?php
if(isset($_POST["id"])){
  $output = '';
  require ('connect.php');
  $query = "SELECT * FROM subject WHERE sub_id = '".$_POST["id"]."'"or die('dwdwdw-die');
  $result = mysqli_query($connect, $query);
  $querySection = "SELECT * FROM section WHERE sub_id = '".$_POST["id"]."'";
  $resultSection = mysqli_query($connect,$querySection) or die('die');
  $output .= '
  <div class="table-responsive">
       <table class="table table-striped">';
  while($row = mysqli_fetch_array($result)){
       $output .= '
            <tr>
                 <td><label>รหัส</label></td>
                 <td id="xxxx">'.$row["sub_id"].'</td>
            </tr>
            <tr>
                 <td><label>ชื่อวิชา</label></td>
                 <td>'.$row["sub_name"].'</td>
            </tr>
            <tr>
                 <td><label>หน่วยกิต</label></td>
                 <td>'.$row["sub_credits"].'</td>
            </tr>

       ';
  }
  $output .= '
       </table>
  </div>
  ';
  $output .= '
  <div class="table-responsive">
       <table class="table table-striped" id="addd">';
  while($roww = mysqli_fetch_array($resultSection)){
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
  $output .= '
       </table>
  </div>
  ';

  echo $output;
}
?>

<?php
$output = '';
require ('connect.php');
$query = "SELECT * FROM user WHERE user_login = '".$_POST["id"]."'"or die('dwdwdw-die');
$result = mysqli_query($connect, $query);

$sql = "SELECT * FROM grade WHERE user_login = '".$_POST["id"]."'"or die('d-die');
$res = mysqli_query($connect, $sql);
$output .= '
<div class="table-responsive">
     <table class="table table-striped">';
while($row = mysqli_fetch_array($result)){
     $output .= '
          <tr>
              <td ><label>รหัสนักศึกษา</label></td>
              <td id="xxxx" class="solo">'.$row["user_login"].'</td>
          </tr>
          <tr>
              <td><label>พาสเวิด</label></td>
              <td>'.$row["user_pass"].'</td>
          </tr>
          <tr>
              <td><label>ชื่อ</label></td>
              <td>'.$row["user_name_title"].' '.$row["user_frist_name"].'  '.$row["user_last_name"].'</td>
          </tr>

            <td><label>ชื่อเล่น</label></td>
            <td>'.$row["user_nick_name"].'</td>
          </tr>
          <tr>
            <td><label>วันเกิด</label></td>
            <td>'.$row["user_birthdate"].'</td>
          </tr>
          <tr>
            <td><label>E-mail</label></td>
            <td>'.$row["user_email"].'</td>
          </tr>
          <tr>
            <td><label>โทรศัพท์</label></td>
            <td>'.$row["user_tel"].'</td>
          </tr>
          <tr>
            <td><label>ที่อยู่</label></td>
            <td>'.$row["user_address"].'</td>
          </tr>
          <tr>
            <td><label>สัดส่วนู่</label></td>
            <td>'.$row["user_weight"].' '.$row["user_height"].'</td>
          </tr>
          <tr>
            <td><label>ระดับการศึกษา</label></td>
            <td>'.$row["user_education"].'</td>
          </tr>
          <tr>
            <td><label>section</label></td>
            <td>'.$row["user_section"].'</td>
          </tr>
          <tr>
            <td><label>Facebook</label></td>
            <td>'.$row["user_facebook"].'</td>
          </tr>
      </table>

          <label>Comment</label>
          <div class="well" id="showww">'.$row["comment"].'</div>
          <td><button id="ok" type="button" onclick="edit_comment('."'".$row["user_login"]."','".$row["comment"]."' ".')" class="btn btn-danger ">แก้ไข</button></td>

          <td><div id="sho" style="display:inline-block;"></div></td>
          <td><div id="calclee" style="display:inline-block;"></div></td>
    </div><hr><br>

          ';
}
$sum = 0;
$count = 0;
$output .='
    <label>เลือกปีการศึกษา</label>
    <select class="form-control select_year" >
    <option value="no">เลือกปี</option>
';
$sqlselect = "SELECT DISTINCT gra_year FROM grade WHERE user_login = '".$_POST["id"]."'" or die('ddd-die');
$resss = mysqli_query($connect, $sqlselect);
while($rowww = mysqli_fetch_array($resss)){
  $output .='
      <option value="'.$rowww['gra_year'].'" >'.$rowww['gra_year'].'</option>
  ';
  }
$output .='
    </select><br>
    <div id="show_detail_grade">ไม่มีข้อมูล</div>
  ';


  while($roww = mysqli_fetch_array($res)){

    $sqlja = "SELECT * FROM subject WHERE sub_id = '".$roww['sub_id']."'"or die('ddd-die');
    $resf = mysqli_query($connect, $sqlja);
    while($rowww = mysqli_fetch_array($resf)){
      if(($roww["gra_score"])=='A'){
        $sum = $sum + (4*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='B+'){
        $sum = $sum + (3.5*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='B'){
        $sum = $sum + (3*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='C+'){
        $sum = $sum + (2.5*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='C'){
        $sum = $sum + (2*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='D+'){
        $sum = $sum + (1.5*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='D'){
        $sum = $sum + (1*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }
      if(($roww["gra_score"])=='F'){
        $sum = $sum + (0*($rowww["sub_credits"]));
        $count+=($rowww["sub_credits"]);
      }

    }
  }
if($sum==0){
  $sum =0;
}else{
  $sum/=$count;
}
$xxxx= substr($sum,0,strpos($sum,'.')+3);

echo $output;
echo '<div ><hr>
      <span><label>GPAX: </label></span>
      <span id="ox">'.$xxxx.'</span>
      </div>
  ';
?>

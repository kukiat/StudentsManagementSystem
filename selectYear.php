<?php
$output='';
if(($_POST["data"])=='no'){
  echo'ไม่มีข้อมูล';
}else{
  require('connect.php');

  $total1=0;
  $gpa1=0;
  $countgpa1=0;

  $total2=0;
  $gpa2=0;
  $countgpa2=0;
  $output.='
  <div class="row">
    <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h5><b>ปีการศึกษา</b> '.$_POST["data"].' <b>เทอมที่</b> 1 </h5>
      </div>
    <table class="table table-striped display ">
      <thead>
        <tr>
          <th>รหัสวิชา</th>
          <th>ชื่อวิชา</th>
          <th>หน่วยกิต</th>
          <th>เกรด</th>
        </tr>
      </thead>
      <tbody>
  ';
  $sqlselect = "SELECT * FROM grade WHERE user_login = '".$_POST["id"]."'AND gra_year = '".$_POST["data"]."'AND gra_term = '1'" or die('ddd-die');
  $ressult = mysqli_query($connect, $sqlselect);
  while($row = mysqli_fetch_array($ressult)){
    $sqls = "SELECT * FROM subject WHERE sub_id = '".$row['sub_id']."'" or die('ddd-die');
    $ressu = mysqli_query($connect, $sqls);
    while($roww = mysqli_fetch_array($ressu)){
      if(($row['gra_score']=='A')){
        $gpa1 = $gpa1 + (4*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='B+')){
        $gpa1 = $gpa1 + (3.5*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='B')){
        $gpa1 = $gpa1 + (3*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='C+')){
        $gpa1 = $gpa1 + (2.5*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='C')){
        $gpa1 = $gpa1 + (2*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='D+')){
        $gpa1 = $gpa1 + (1.5*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='D')){
        $gpa1 = $gpa1 + (1*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      if(($row['gra_score']=='F')){
        $gpa1 = $gpa1 + (0*($roww["sub_credits"]));
        $countgpa1+=($roww["sub_credits"]);
      }
      $output.='
          <tr>
            <td>'.$roww['sub_id'].'</td>
            <td>'.$roww['sub_name'].'</td>
            <td>'.$roww['sub_credits'].'</td>
            <td>'.$row['gra_score'].'</td>
          </tr>
        ';
      }

  }

  $total1 = @($gpa1/$countgpa1);
  if($total1==0){
    $total1 =0;
  }
  $cut = substr($total1,0,strpos($total1,'.')+3);
  $output.='
      </tbody>
      </table>
      </div>
      <label>GPA : '.$cut.'</label>
    </div>

    <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h5><b>ปีการศึกษา</b> '.$_POST["data"].' <b>เทอมที่</b> 2 </h5>
      </div>
    <table class="table table-striped display ">
      <thead>
        <tr>
          <th>รหัสวิชา</th>
          <th>ชื่อวิชา</th>
          <th>หน่วยกิต</th>
          <th>เกรด</th>
        </tr>
      </thead>
      <tbody>';
      $sqlselect2 = "SELECT * FROM grade WHERE user_login = '".$_POST["id"]."'AND gra_year = '".$_POST["data"]."'AND gra_term = '2'" or die('ddd-die');
      $ressult2 = mysqli_query($connect, $sqlselect2);
      while($row = mysqli_fetch_array($ressult2)){
        $sqls = "SELECT * FROM subject WHERE sub_id = '".$row['sub_id']."'" or die('ddd-die');
        $ressu = mysqli_query($connect, $sqls);
        while($roww = mysqli_fetch_array($ressu)){
          if(($row['gra_score']=='A')){
            $gpa2 = $gpa2 + (4*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='B+')){
            $gpa2 = $gpa2 + (3.5*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='B')){
            $gpa2 = $gpa2 + (3*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='C+')){
            $gpa2 = $gpa2 + (2.5*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='C')){
            $gpa2 = $gpa2 + (2*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='D+')){
            $gpa2 = $gpa2 + (1.5*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='D')){
            $gpa2 = $gpa2 + (1*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          if(($row['gra_score']=='F')){
            $gpa2 = $gpa2 + (0*($roww["sub_credits"]));
            $countgpa2+=($roww["sub_credits"]);
          }
          $output.='
              <tr>
                <td>'.$roww['sub_id'].'</td>
                <td>'.$roww['sub_name'].'</td>
                <td>'.$roww['sub_credits'].'</td>
                <td>'.$row['gra_score'].'</td>
              </tr>

            ';
          }
      }
      $total2 = @($gpa2/$countgpa2);
      if($total2==0){
        $total2 =0;
      }
      $cutt = substr($total2,0,strpos($total2,'.')+3);
  $output.='
      </tbody>
      </table>
    </div>
    <label>GPA : '.$cutt.'</label>
  </div>
  ';
  echo $output;
}
?>

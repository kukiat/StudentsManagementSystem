<?php

if(!empty($_POST)){

	require('connect.php');
	if($_POST['query']!=''){
	    if($_POST['char']=='number'){
			     $query = "SELECT * FROM user WHERE user_login LIKE '%".$_POST['query']."%'";
  		}
      else
           $query = "SELECT * FROM user WHERE user_frist_name LIKE '%".$_POST['query']."%'";
	}
  else
      $query = "SELECT * FROM user";
  $output='';
	$result = mysqli_query($connect, $query) or die('diedd');
      while($row = mysqli_fetch_array($result)){


    $output .='
    <tr>
      <td>'.$row["user_login"].'</td>
      <td>'.$row["user_frist_name"].'</td>
      <td>'.$row["user_last_name"].'</td>
      <td>'.$row["user_status"].'</td>
			<td>'.$row["user_gpax"].'</td>
      <td><input type="button" name="view" value="รายละเอียด" id="'.$row["user_login"].'" class="btn btn-info btn-xs vieww" /></td>
    </tr>


    ';

  }
  if($output==''){
    echo'ไม่พบข้อมูล';
  }else
  echo $output;


}
?>

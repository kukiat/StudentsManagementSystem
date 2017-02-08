<?php
if(!empty($_POST)){
	require('connect.php');
	$output = '';
	$order = $_POST["order"];
	$g1 = $_POST["g1"];
	$g2 = $_POST["g2"];
	if($order == 'desc')  {
  	$order = 'asc';
 	}
 	else{
  	$order = 'desc';
 	}
	if($_POST['query']!=''){
	    if($_POST['char']=='number'){
				$query = "SELECT * FROM user WHERE (user_login LIKE '%".$_POST['query']."%') AND (user_gpax BETWEEN '$g1' AND '$g2')
				ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
			}
			else{
				if($_POST["column_name"]=='user_frist_name'){
					$query = "SELECT * FROM user WHERE user_frist_name LIKE '%".$_POST['query']."%' AND (user_gpax BETWEEN '$g1' AND '$g2')
          ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
				}else if($_POST["column_name"]=='user_gpax'){
					$query = "SELECT * FROM user WHERE user_frist_name LIKE '%".$_POST['query']."%' AND (user_gpax BETWEEN '$g1' AND '$g2')
          ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
				}else if($_POST["column_name"]=='user_login'){
					$query = "SELECT * FROM user WHERE user_frist_name LIKE '%".$_POST['query']."%' AND (user_gpax BETWEEN '$g1' AND '$g2')
          ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
				}


      }
  }else{
      $query = "SELECT * FROM user WHERE (user_gpax BETWEEN '$g1' AND '$g2') ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
  }
  $result = mysqli_query($connect, $query) or die('die');
	$output .= '
        <table class="table table-hover table-striped">
         <thead>
           <tr>
             <th ><span class="column_sort_ja" data-order="'.$order.'" id="user_login" style="cursor: pointer;">ID</span></th>
             <th><span class="column_sort_ja" data-order="'.$order.'" id="user_frist_name" style="cursor: pointer;">Firstname</span></th>
             <th><span>Lastname</span></th>
             <th>Status</th>
						 <th><span class="column_sort_ja" data-order="'.$order.'" id="user_gpax" style="cursor: pointer;">GPAX</span></th>
             <th>Detail</th>
           </tr>
         </thead>
         <tbody id="add_search">
	';
	while($row = mysqli_fetch_array($result)){
		$output .='
          <tr>
            <td>'.$row["user_login"].'</td>
            <td>'.$row["user_frist_name"].'</td>
            <td>'.$row["user_last_name"].'</td>
            <td>'.$row["user_status"].'</td>
						<th>'.$row["user_gpax"].'</th>
            <td><input type="button" name="view" value="รายละเอียด" id="'.$row["user_login"].'" class="btn btn-info btn-xs vieww" /></td>
          </tr>

						';
    }
		$output .='
				</tbody>
			</table>';
		echo $output;
}

 ?>

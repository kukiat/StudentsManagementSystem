<?php
if(!empty($_POST)){
	require('connect.php');
	$output = '';
	$order = $_POST["order"];
	if($order == 'desc')  {
  	$order = 'asc';
 	}
 	else{
  	$order = 'desc';
 	}
	if($_POST['query']!=''){
	    if($_POST['char']=='number'){
			$query = "SELECT * FROM subject WHERE sub_id LIKE '%".$_POST['query']."%' ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
			}
			else
				$query = "SELECT * FROM subject WHERE sub_name LIKE '%".$_POST['query']."%' ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
	}else
		$query = "SELECT * FROM subject ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";
	$result = mysqli_query($connect, $query) or die('die');
	$output .= '
			 <table class="table table-striped display ">
			 <thead>
					 <tr>
						 <th><span style="cursor: pointer;" class="column_sort" data-order="'.$order.'" id="sub_id">รหัสวิชา</span></th>
						 <th><span  style="cursor: pointer;" class="column_sort" data-order="'.$order.'" id="sub_name">ชื่อวิชา</span></th>
						 <th><span>หน่วยกิต</span></th>
						 <th>รายละเอียด</th>
						 <th>ลบ</th>
					 </tr>
			</thead>
		<tbody id="tbody">
	';
	while($row = mysqli_fetch_array($result)){
		$output .='
						<tr>
							<td>' . $row["sub_id"] . '</td>
							<td id="nshow">' . $row["sub_name"] . '</td>
							<td id="wshow">' . $row["sub_credits"] . '</td>
							<td><input type="button" name="view" value="รายละเอียด" id="' . $row["sub_id"] . '" class="btn btn-info btn-xs view_data" /></td>
							<td><button type="button" name="delete_btn" id="' . $row["sub_id"] . '" class="btn btn-xs btn-danger btn_delete">x</button></td>
						</tr>

						';
    }
		$output .='
				</tbody>
			</table>';
		echo $output;
}

 ?>

<?php
if(!empty($_POST)){
	require('connect.php');
	if($_POST['query']!=''){
	    if($_POST['char']=='number'){
			$query = "SELECT * FROM subject WHERE sub_id LIKE '%".$_POST['query']."%' ORDER BY sub_id ASC";
		}else $query = "SELECT * FROM subject WHERE sub_name LIKE '%".$_POST['query']."%' ORDER BY sub_id ASC";
	}else $query = "SELECT * FROM subject ORDER BY sub_id ASC";
	$result = mysqli_query($connect, $query) or die('diedd');
	while($row = mysqli_fetch_array($result)){
		echo "<tr>".
              "<td id='sshow'>".$row['sub_id']."</td>".
              "<td id='nshow'>".$row['sub_name']."</td>".
              "<td id='wshow'>".$row['sub_credits']."</td>".
              "<td><input type='button' name='view' value='รายละเอียด' id=".$row["sub_id"]." class='btn btn-info btn-xs view_data' /></td>".
              "<td><button type='button' name='delete_btn' id=".$row["sub_id"]." class='btn btn-xs btn-danger btn_delete'>x</button></td>".
            "</tr>"
						;
    }
}
?>

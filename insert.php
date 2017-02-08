<?php
 require ('connect.php');
 $connect->set_charset("utf8");
 if(!empty($_POST)){
      $output = '';
      $code = mysqli_real_escape_string($connect, $_POST["code"]);
      $name = mysqli_real_escape_string($connect, $_POST["name"]);
      $weight = mysqli_real_escape_string($connect, $_POST["weight"]);
      $query = "INSERT INTO subject(sub_id, sub_name, sub_credits) VALUES('$code', '$name','$weight');";
      if(mysqli_query($connect, $query)){

           $select_query = "SELECT * FROM subject ORDER BY sub_id DESC";
           $result = mysqli_query($connect, $select_query);
           $output .= '
         			 <table class="table table-striped display ">
         			 <thead>
         					 <tr>
                     <th><span class="column_sort" data-order="desc" id="sub_id" style="cursor: pointer;">รหัสวิชา</span></th>
                     <th><span class="column_sort" data-order="desc" id="sub_name" style="cursor: pointer;">ชื่อวิชา</span></th>
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

      }
      echo $output;
 }
 ?>

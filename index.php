 <?php
 require ('connect.php');
 $query = "SELECT * FROM user ORDER BY user_login DESC";
 $result = mysqli_query($connect, $query)or die('error');


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Students</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="jsdb.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" class="active" href="/kab/students.php">Students</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="/kab/course.php">Course</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      </ul>
    </div>
  </nav>
	<div class="contrainer">
		<button type="button" class="btn btn-warning" href="#collapse" data-toggle="collapse" style="width: 100%" >SearchStudent <i class="fa fa-angle-double-down"></i></button>
		<div id="collapse" class="collapse">
			<div class="row">
				<div class="col-md-12 col-sm-12 students">
					<div class="input-group">
						<input type="text" class="form-control" aria-label="Text input with dropdown button" id="SearchStudent" style="width:1000px" placeholder="Name">
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 students">
					<div class="input-group">
						<div class="input-group-btn">
	 					    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">GPAX</button>
	 					</div>
	 					<div class="input-group" style="display: inline;">
							<input type="text" class="form-control" style="width: 5%" placeholder="0.00" id="g1" maxlength="4" min="0" max="4">
							<input type="text" class="form-control" style="width: 5%" placeholder="4.00" id="g2" maxlength="4" min="0" max="4">
              <button  type="button" class="btn btn-success" style="width: 5%" id="searcheiei">ตกลง</button>
						</div>
					</div>
				</div>
			</div>
    </div>
		<div class="row">
			<div class="col-md-12 col-sm-12 students">
			<div class="table-responsive" id="ad">
			   <table class="table table-hover table-striped">
					<thead>
						<tr>
							<th><span class="column_sort_ja" data-order="desc" id="user_login" style="cursor: pointer;">ID</span></th>
							<th><span class="column_sort_ja" data-order="desc" id="user_frist_name" style="cursor: pointer;">Firstname</span></th>
							<th><span>Lastname</span></th>
							<th>Status</th>
              <th><span class="column_sort_ja" data-order="desc" id="user_gpax" style="cursor: pointer;">GPAX</th>
              <th>Detail</th>
						</tr>
					</thead>
					<tbody id="add_search">
          <?php
            while($row = mysqli_fetch_array($result))
            {
              $sum=0;
              $count=0;
              $xxxx =0;
              $sql = "SELECT * FROM grade WHERE user_login = '".$row["user_login"]."'";
              $resss = mysqli_query($connect, $sql)or die('errorr');
              while($rowgrade = mysqli_fetch_array($resss)){
                $sqlja = "SELECT sub_credits FROM subject WHERE sub_id = '".$rowgrade['sub_id']."'"or die('ddd-die');
                $resf = mysqli_query($connect, $sqlja);
                while($rowww = mysqli_fetch_array($resf)){
                  if(($rowgrade["gra_score"])=='A'){
                    $sum = $sum + (4*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='B+'){
                    $sum = $sum + (3.5*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='B'){
                    $sum = $sum + (3*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='C+'){
                    $sum = $sum + (2.5*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='C'){
                    $sum = $sum + (2*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='D+'){
                    $sum = $sum + (1.5*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='D'){
                    $sum = $sum + (1*($rowww["sub_credits"]));
                    $count+=($rowww["sub_credits"]);
                  }
                  if(($rowgrade["gra_score"])=='F'){
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
                $xxxx =  substr($sum,0,strpos($sum,'.')+3);
                $quqq = "UPDATE user SET user_gpax = $xxxx WHERE user_login = '".$row["user_login"]."'";
                mysqli_query($connect, $quqq);
                ?>

                <tr>
      						<td><?php echo $row["user_login"]; ?></td>
                  <td><?php echo $row["user_frist_name"]; ?></td>
                  <td><?php echo $row["user_last_name"]; ?></td>
                  <td><?php echo $row["user_status"]; ?></td>

                  <th><?php echo $row["user_gpax"]; ?></th>

                  <td><input type="button" name="view" value="รายละเอียด" id="<?php echo $row["user_login"]; ?>" class="btn btn-info btn-xs vieww" /></td>
    						</tr>


          <?php
            }
          ?>
					</tbody>
				</table>
			</div>
		</div>



			<div class="modal fade" id="studentModal">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
              รายละเอียด
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>

						</div>
						<div class="modal-body contrainer">
							<div id="show_detail_modal"></div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>


					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->


		</div>
	</div>
</body>
</html>

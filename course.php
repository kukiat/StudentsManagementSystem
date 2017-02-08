<?php
 require ('connect.php');
 $query = "SELECT * FROM subject ORDER BY sub_id ASC";
 $result = mysqli_query($connect, $query) or die('courese.php-die');
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Course</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="jsdb.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/kab/students.php">Students</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/kab/course.php">Course</a></li>
          <li><a href="accounts.html">Accounts</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
        </ul>
      </div>
    </nav>
     <div class="container">
       <div class="row" style="margin-top: 20px">
         <div class="col-md-2"></div>
         <div class="col-md-8 col-xs-11">
           <div class="panel panel-primary">
             <div class="panel-heading">
               <div style="display:inline-block; width:calc(100% - 100px);">
                 <input type="text" class="form-control" placeholder="Search"style="width:100%" id="search" autofocus>
               </div>
               <div style="display: inline-block; float:right">
                 <button class="btn btn-success" data-toggle="modal" data-target="#create" type="button"><strong>CREATE</strong></button>
               </div>
             </div>
   					<div id="adddd">
              <table  class="table table-striped display ">
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
                  <?php
                    while($row = mysqli_fetch_array($result)){
                  ?>
                  <tr>
                    <td id='sshow'><?php echo $row["sub_id"]; ?></td>
                    <td id="nshow"><?php echo $row["sub_name"]; ?></td>
                    <td id="wshow"><?php echo $row["sub_credits"]; ?></td>
                    <td><input type="button" name="view" value="รายละเอียด" id="<?php echo $row["sub_id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                    <td><button type="button" name="delete_btn" id="<?php echo $row["sub_id"]; ?>" class="btn btn-xs btn-danger btn_delete">x</button></td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
   					</div>
 				  </div>
 			  </div>
        <div class="col-md-2 col-xs-1"></div>
 			</div>
    </div>
    <!-- BEGIN MODAL DETAIL -->
   <div id="dataModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">รายละเอียด</h4>
          </div>
          <div id="add_section_ajax">
            <div class="modal-body" id="employee_detail"></div>
          </div>
          <input class="btn btn-success" type="button" value="เพิ่มsection"  data-toggle="collapse" data-target="#demo" style="margin-left:10px">
          <div class="row">
            <div class="col-md-6">
              <div id="demo" class="collapse" style="margin-left:10px">
                <form name="add_name" method="POST" id="add_section" >
                  <input type="hidden" name="code_name" id="code_id" class="form-control">
                  <label>เซคชั่นที่</label>
                  <input type="text" name="section_name" id="section_id" class="form-control">
                  <label>วันที่เรียน</label>
                  <input type="text" name="day_name" id="day_id" class="form-control">
                  <label>เวลา</label>
                  <input type="text" name="time_name" id="time_id" class="form-control">
                  <label>อาจารย์ผู้สอน</label>
                  <input type="text" name="prof_name" id="prof_id" class="form-control">
                  <label>ห้อง</label>
                  <input type="text" name="room_name" id="room_id" class="form-control">
                  <label>เจ้าของวิชา</label>
                  <input type="text" name="owner_name" id="owner_id" class="form-control">
                  <label>จำนวนที่รับ</label>
                  <input type="text" name="n_name" id="n_id" class="form-control"><br>
                  <input type="submit" name="insert_section" value="ตกลง"  class="btn btn-success" />
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
 </div>
   <!-- END MODAL DETAIL-->
    <!-- BEGIN CREATE -->
    <div class="modal fade" id="create" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content ">
          <div class="modal-header" >
            <h4 class="modal-title" style="text-align: center;">CREATE</h4>
          </div>
          <div class="modal-body">
            <form method="post" id="insert_form">
               <label>รหัสวิชา</label>
               <input type="text" name="code" id="code" class="form-control" />
               <label>ชื่อวิชา</label>
               <input type="text" name="name" id="name" class="form-control" />
               <label>หน่วยกิต</label>
               <input type="text" name="weight" id="weight" class="form-control" />
               <input type="submit" name="insert" id="insert" value="ตกลง" class="btn btn-success" />
            </form>
          </div>


          



        </div>

      </div>
  </div>
   <!-- END MODAL CREATE -->

  </div>
    <data id="ddwdw"></data>
  </body>
  <button id="dwdwdddd">rgrgrgrg</button>
</html>

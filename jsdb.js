$(document).ready(function(){
  $('#logout').click(function(event) {
    console.log('destroy session')
    $.ajax({url:"destroy.php",
      data:{destroy:'yes'},
      type:"POST",
      success:function(data){
        console.log(data)
        window.location = 'http://kab.esy.es/';
      }
    });
  });
  $('#searcheiei').click(function(){
    var query = $('#SearchStudent').val();
    var g1 = $('#g1').val()
    var g2 = $('#g2').val()
    var column_name = $('.column_sort_ja').attr("id");
    var order = $('.column_sort_ja').data("order");

    if(/^\d+$/.test(query)){
      query = query;
      char = 'number'
    }
    else{
      query:query
      char = 'string';
    }
    if($('#g1').val()==''){
      alert('โปรดกรอกเกรดที่จะค้นหา')
    }else if($('#g2').val()==''){
      alert('โปรดกรอกเกรดที่จะค้นหา')
    }else if(($('#g1').val()>=0 && $('#g1').val()<=4) && ($('#g2').val()>=0 && $('#g2').val()<=4) && ($('#g2').val()>=$('#g1').val())){
      $.ajax({
        url:"searchGrade.php",
        type:"POST",
        data:{query:query,char:char,g1:g1,g2:g2,column_name:column_name,order:order},
        success:function(data){
          $('#ad').html(data)
        }
      });
    }else{
      alert('โปรดกรอกข้อมูลให้ถูกต้อง')
      $('#g1').val('0.00');
      $('#g2').val('4.00');
    }
  });
  $(document).on('change','.select_year', function(){
     var data = $(this).val()
     var id = ($('.solo').text())
     $.ajax({
        url:"selectYear.php",
        type:"POST",
        data:{data:data,id:id},
        success:function(data){
          $('#show_detail_grade').html(data)
      }
    });
  });

  $('#SearchStudent').on('input',function(){
    var query = $('#SearchStudent').val()
    $('#g1').val('')
    $('#g2').val('')
    if(/^\d+$/.test(query)){
      data = {query:query,char:'number'}
    }else{
      data = {query:query,char:'string'};
    }
    $.ajax({
      url: "searchStudent.php",
      method:"POST",
      data:data
    }).done(function(data){
      $('#add_search').html(data)
    });
  });
  $(document).on('click', '.vieww', function(){
    var id = $(this).attr("id");
      $.ajax({
        url:"selectStudent.php",
        type:"POST",
        data:{id:id},
        success:function(data){
          $('#show_detail_modal').html(data);
          $('#studentModal').modal('show');
        }
      })
  });

  $(document).on('input', '#search', function(){
    query = $('#search').val()
    if(/^\d+$/.test(query)){
      data = {query:query,char:'number'}
    }else{
      data = {query:query,char:'string'};
    }
    $.ajax({
      url: "subjectSearch.php",
      method:"POST",
      data:data
    }).done(function(data){
      $('#tbody').html(data)
    });
  });

  $('#insert_form').on("submit", function(event){
    event.preventDefault();
    if($('#code').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#name').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#weight').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else{
      $.ajax({
        url:"insert.php",
        method:"post",
        data:$('#insert_form').serialize(),
        success:function(data){
          alert('เพิ่มวิชาแล้ว')
          $('#insert_form')[0].reset();
          $('#create').modal('hide');
          $('#adddd').html(data);
        }
      });
    }
  });

  $(document).on('click', '.view_data', function(){
    var id = $(this).attr("id");

    if(id != ''){
      $.ajax({
        url:"select.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          $('#employee_detail').html(data);
          $('#dataModal').modal('show');
        }
      });
    }
  });

  $('#add_section').on("submit", function(event){
    event.preventDefault();
    $('#code_id').val($('#xxxx').text());
    if($('#day_id').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#time_id').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#prof_id').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#owner_id').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#room_id').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else if($('#n_id').val()==''){
      alert('โปรดกรอกข้อมูลให้ครบถ้วน');
    }
    else{
      $.ajax({
        url:"insertSection.php",
        method:"post",
        data:$('#add_section').serialize(),
        success:function(data){
          alert('เพิ่ม section แล้ว')
          $('#add_section')[0].reset();
          $('#demo').collapse('hide');
          $('#dataModal').modal('hide');
          $('#addd').html(data);
        }
      });
    }
  });

  $(document).on('click', '.btn_delete', function(){
    var code = $(this).attr("id");
    if(confirm("ถ้ากดลบ SECTION ที่เคยสร้างมาจะหายไปทั้งหมด ต้องการจะลบไหม?")){
      $.ajax({
        url:"delete.php",
        method:"POST",
        data:{id:code},
        dataType:"text",
        success:function(data){
          alert(data);
          window.location = "/kab/course.php";
        }
      });
    }
  });

  $(document).on('click', '.btn_delete_section', function(){
    var code = $(this).attr("id");
    var gg = $('#xxxx').text()
    if(confirm("ต้องการลบ SECTION นี้ใช่ไหม?")){
      $.ajax({
        url:"deleteSection.php",
        method:"POST",
        data:{id:code,id2:gg},
        dataType:"text",
        success:function(data){
          alert(data);
          window.location = "/kab/course.php";
        }
      });
     }
  });

  $(document).on('click', '.column_sort', function(){
    var char='';
    var column_name = $(this).attr("id");
    var order = $(this).data("order");
    console.log(column_name)
    query = $('#search').val()
    if(/^\d+$/.test(query)){
      query = query;
      char = 'number'
    }
    else{
      query:query
      char = 'string';
    }
    $.ajax({
      url: "sort.php",
      method:"POST",
      data:{query:query,char:char,column_name:column_name,order:order},
    }).done(function(data){
      $('#adddd').html(data)
    });
  });

  $(document).on('click', '.column_sort_ja', function(){
    var char='';
    var column_name = $(this).attr("id");
    var order = $(this).data("order");
    var g1 =$('#g1').val()
    var g2 =$('#g2').val()

    if(g1==''){
      g1=0;
    }
    if(g2==''){
      g2=4;
    }
    console.log(g1)
    console.log(g2)
    query = $('#SearchStudent').val()
    if(/^\d+$/.test(query)){
      query = query;
      char = 'number'
    }
    else{
      query:query
      char = 'string';
    }
    console.log(query)
    $.ajax({
      url: "sortStudent.php",
      method:"POST",
      data:{query:query,char:char,g1:g1,g2:g2,column_name:column_name,order:order},
    }).done(function(data){
      $('#ad').html(data)
    });
  });


});
function test(data,day,time,prof,room,owner,n){
  $('#ddwdw').html('<div class="modal fade" id="edit_section" role="dialog">'+
    '<div class="modal-dialog">'+
      '<div class="modal-content ">'+
        '<div class="modal-header" >'+
        '<button type="button" class="close" data-dismiss="modal">'+'&times;'+'</button>'+
          '<h4 class="modal-title" style="text-align:center;">'+'แก้ไข'+'</h4>'+

        '</div>'+
        '<div class="modal-body">'+
          '<form method="POST" id="edit_section_submit">'+
            '<input type="hidden" name="data_name_edit" id="data_id_edit" class="form-control">'+
            '<input type="hidden" name="code_name_edit" id="code_id_edit" class="form-control">'+
            '<label>'+'วันที่เรียน'+'</label>'+
            '<input type="text" name="day_name_edit" id="day_id_edit" class="form-control" value="'+day+'">'+
            '<label>'+'เวลา'+'</label>'+
            '<input type="text" name="time_name_edit" id="time_id_edit" class="form-control" value="'+time+'">'+
            '<label>'+'อาจารย์'+'</label>'+
            '<input type="text" name="prof_name_edit" id="prof_id_edit" class="form-control" value="'+prof+'">'+
            '<label>'+'ห้อง'+'</label>'+
            '<input type="text" name="room_name_edit" id="room_id_edit" class="form-control" value="'+room+'">'+
            '<label>'+'เจ้าของวิชา'+'</label>'+
            '<input type="text" name="owner_name_edit" id="owner_id_edit" class="form-control" value="'+owner+'">'+
            '<label>'+'จำนวน'+'</label>'+
            '<input type="text" name="n_name_edit" id="n_id" class="form-control" value="'+n+'">'+'<br>'+
            '<input type="submit" name="insert_section_edit" value="ตกลง"  class="btn btn-success" />'+
          '</form>'+
      '  </div>'+
      '<div class="modal-footer">'+
           '<button type="button" class="btn btn-default" data-dismiss="modal">'+'Close'+'</button>'+
      '</div>'+
      '</div>'+

    '</div>'+
  '</div>');

  $('#code_id_edit').val($('#xxxx').text());
  $('#data_id_edit').val(data);
  $('#edit_section_submit').submit(function(event){
    event.preventDefault();
    $('#code_id').val($('#xxxx').text());
    if($('#day_id_edit').val()==''){
      alert('โปรกรอกข้อมูลวันที่เรียนให้ครบถ้วน')
    }
    else if($('#time_id_edit').val()==''){
      alert('โปรกรอกข้อมูลวันที่เรียนให้ครบถ้วน')
    }
    else if($('#prof_id_edit').val()==''){
      alert('โปรกรอกข้อมูลวันที่เรียนให้ครบถ้วน')
    }
    else if($('#room_id_edit').val()==''){
      alert('โปรกรอกข้อมูลวันที่เรียนให้ครบถ้วน')
    }
    else if($('#downer_id_edit').val()==''){
      alert('โปรกรอกข้อมูลวันที่เรียนให้ครบถ้วน')
    }
    else if($('#n_id_edit').val()==''){
      alert('โปรกรอกข้อมูลวันที่เรียนให้ครบถ้วน')
    }
    else{
      $.ajax({
        url:"edit.php",
        method:"post",
        data:$('#edit_section_submit').serialize(),
        success:function(data){
          alert(data)
          window.location = "/kab/course.php";
        }
      });
    }
  });
}
function edit_comment(data,commentt){
  $('#ok').hide()
  $('#showww').html('<textarea name="name" rows="3" id="show-text"class="form-control"cols="40" >'+commentt+'</textarea>')
  $('#sho').html('<button type="button" id="btn-con"class="btn btn-success hidee" autofocus>'+'ตกลง'+'</button>')
  // $('#calclee').html('<button onclick="close()" type="button" class="btn btn-warning" autofocus>'+'ยกเลิก'+'</button>')
  $('#btn-con').click(function(){
    var vv = $('#show-text').val();
    if(vv ==''){
      alert('กรุณากรอกข้อมูล')
    }
    else{
      $.ajax({
        url:"editComment.php",
        data:{vv:vv,data,data},
        type:"POST",
        success:function(data){
          $('.well').html(data);
          $('#btn-con').hide()
          $('#ok').show()
          }
      })
    }
  });
}

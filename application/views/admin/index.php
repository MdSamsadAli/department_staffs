<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Info</title>
    <script src="assets/js/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="showForm">
        add
      </button> 

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Sno</th>
            <th scope="col">Department</th>
            <th scope="col">Staff</th>
            <th scope="col">Status</th>
            <th scope="col">Address</th>
            <th scope="col">Salary</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <input type="hidden" class="form-control" placeholder="Id" aria-label="id"  id="id">
                <select name="department" id="department_name" class="form-control">
                    <option value="">Select Department</option>
                    <?php foreach ($department as $department): ?>
                        <option value="<?= $department->id ?>"><?= $department->department_name ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="col">
                <select class="form-control" name="staff"  id="staff_name" disabled>
                  <option value="">Select Staff</option>
                  <?php foreach ($staffs as $staff) : ?>
                    <option value="<?= $staff->id ?>"><?= $staff->staff_name ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="Salary" aria-label="Last name" id="salary">
              </div>
              <div class="col">
                <select name="status" id="status" class="form-control">
                  <option value="0">Select Status</option>
                  <option value="active">Active</option>
                  <option value="inactive">InActive</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveData">Save</button>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $(document).on("click", '#showForm', function(){
                // alert();
                $("#staticBackdrop").modal("show");
            })

        });
        $(document).on("click", '#saveData', function(){


            var id = $("#id").val();
            var addUpdate = (id == "" ) ? "<?php base_url(); ?>admin/store" : "<?php base_url(); ?>admin/update";
                var department_id = $('#department_name').val();
                var staff_id = $('#staff_name').val();
                var salary = $('#salary').val();
                var status = $('#status').val();

                $.ajax({
                    url: addUpdate,
                    data: {id, department_id, staff_id, salary, status},
                    dataType: 'json',
                    type: 'POST',
                    success: function(data){
                        console.log(data);
                        fetchData();
                        $("#staticBackdrop").modal("hide");
                    }
                })
        });

        function fetchData()
        {
            $.ajax({
                url: '<?php base_url(); ?>admin/get',
                dataType: 'json',
                type: 'POST',
                success: function(data){
                    console.log(data);

                    var tbody;
                    var id ="1";
                    for ( key in data) 
                    {
                        tbody += "<tr>";
                        tbody += "<td>" +id++;+ "</td>";
                        tbody += "<td>" +data[key]['department_name']+ "</td>";
                        tbody += "<td>" +data[key]['staff_name']+ "</td>";
                        tbody += "<td>" +data[key]['status']+ "</td>";
                        tbody += "<td>" +data[key]['address']+ "</td>";
                        tbody += "<td>" +data[key]['salary']+ "</td>";
                        tbody += `<td>
                            <button type="button" class="btn btn-secondary btn-sm" value="${data[key]['id']}" id="editData">edit</button>
                            <button type="button" class="btn btn-danger btn-sm" value="${data[key]['id']}" id="deleteData">delete</button>
                        </td>`;

                        tbody += "</tr>";
                    }
                    $("#tbody").html(tbody);
                },
            })
        }
        fetchData();

        $(document).on('click','#editData', function(e){
            e.preventDefault();
            var id = $(this).attr('value');
            alert(id);
            $.ajax({
                url: "<?php base_url() ?>admin/edit",
                dataType: 'json',
                type: "POST",
                data: {id},
                success: function(data){
                    console.log(data);

                    $("#id").val(data.id);
                    $("#department_name").val(data.department_id);
                    $("#staff_name").val(data.staff_id);
                    $("#salary").val(data.salary);
                    $("#status").val(data.status);

                    $("#staticBackdrop").modal("show");
                }
            })
            
        });

        $(document).on('click','#deleteData', function(e){
            e.preventDefault();
            var id = $(this).attr('value');
            $.ajax({
                url: "<?php base_url() ?>admin/destroy",
                dataType: 'json',
                type: "POST",
                data: {id},
                success: function(data){
                    console.log(data);
                    fetchData();
                }
            })
        })
    </script>
  </body>
</html>

<script>
  $(document).ready(function() {
    $('#department_name').change(function() {
      var departmentId = $(this).val();

      alert(departmentId);
      
      if (departmentId !== '') {
        $.ajax({
          url: '<?php base_url()?> admin/getstaffbydepartment', // Replace with the actual URL or PHP file that handles the AJAX request
          type: 'POST',
          data: { departmentId: departmentId },
          dataType: 'json',
          success: function(response) {
            $('#staff_name').prop('disabled', false);
            $('#staff_name').html('<option value="">Select Staff</option>');

            $.each(response, function(index, staff) {
              $('#staff_name').append('<option value="' + staff.id + '">' + staff.staff_name + '</option>');
            });
          }
        });
      } else {
        $('#staff_name').prop('disabled', true);
        $('#staff_name').html('<option value="">Select Staff</option>');
      }
    });
  });
</script>
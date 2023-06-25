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
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveData">Save</button>
          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- <script>
        $(document).ready(function(){

            $(document).on("click", '#showForm', function(){
                // alert();
                $("#staticBackdrop").modal("show");
            })

        });
        $(document).on("click", '#saveData', function(){


            var id = $("#id").val();
            var addUpdate = (id == "" ) ? "<?php base_url(); ?>department/insert" : "<?php base_url(); ?>department/updateDepartment";
                var department_name = $('#department_name').val();

                $.ajax({
                    url: addUpdate,
                    data: {id, department_name},
                    dataType: 'json',
                    type: 'POST',
                    success: function(data){
                        console.log(data);
                        getDepartments();
                        $("#staticBackdrop").modal("hide");
                    }
                })
        });

        function getDepartments()
        {
            $.ajax({
                url: '<?php base_url(); ?>department/getDepartments',
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
                        tbody += `<td>
                            <button type="button" class="btn btn-secondary btn-sm" value="${data[key]['id']}" id="editDepartment">edit</button>
                            <button type="button" class="btn btn-danger btn-sm" value="${data[key]['id']}" id="deleteDepartment">delete</button>
                        </td>`;

                        tbody += "</tr>";
                    }
                    $("#tbody").html(tbody);
                },
            })
        }
        getDepartments();

        $(document).on('click','#editDepartment', function(e){
            e.preventDefault();
            var id = $(this).attr('value');
            alert(id);
            $.ajax({
                url: "<?php base_url() ?>department/editDepartment",
                dataType: 'json',
                type: "POST",
                data: {id},
                success: function(data){
                    console.log(data);

                    $("#id").val(data.id);
                    $("#department_name").val(data.department_name);

                    $("#staticBackdrop").modal("show");
                }
            })
            
        });

        $(document).on('click','#deleteDepartment', function(e){
            e.preventDefault();
            var id = $(this).attr('value');
            $.ajax({
                url: "<?php base_url() ?>department/destroy",
                dataType: 'json',
                type: "POST",
                data: {id},
                success: function(data){
                    console.log(data);
                    getDepartments();
                }
            })
        })
    </script> -->
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
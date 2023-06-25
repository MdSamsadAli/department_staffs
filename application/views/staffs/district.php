<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="showDistrictForm">
            add district
            </button>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">District</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>


    <!-- Staff Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
    <div class="col">
        <input type="hidden" class="form-control" placeholder="Id" aria-label="id"  id="id">
        <input type="text" class="form-control" placeholder="Staff" aria-label="First name"  id="staff_name">
    </div>
    <div class="col">
        <input type="text" class="form-control" placeholder="Address" aria-label="Last name" id="address">
    </div>
    <div class="col">
        <input type="number" class="form-control" placeholder="Mobile Number" aria-label="Last name" id="mobile_number">
    </div>
    <div class="col">
    <select name="department" id="department_name" class="form-control">
                <option value="">Select Department</option>
                <?php foreach ($departments as $department): ?>
                    <option value="<?= $department->id ?>"><?= $department->department_name ?></option>
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
</html>

<script>
    $(document).ready(function(){

        $(document).on("click", '#showDistrictForm', function(){
            // alert();
            $("#staticBackdrop").modal("show");
        })

    });
    $(document).on("click", '#saveData', function(){


        var id = $("#id").val();
        var addUpdate = (id == "" ) ? "<?php base_url(); ?>staff/insert" : "<?php base_url(); ?>staff/updateStaff";
            var staff_name = $('#staff_name').val();
            var address = $('#address').val();
            var mobile_number = $('#mobile_number').val();
            var department = $('#department_name').val();

            $.ajax({
                url: addUpdate,
                data: {id, staff_name, address, mobile_number, department},
                dataType: 'json',
                type: 'POST',
                success: function(data){
                    console.log(data);
                    getStaffs();
                    $("#staticBackdrop").modal("hide");
                }
            })
    });

    function getStaffs()
    {
        $.ajax({
            url: '<?php base_url(); ?>staff/getStaff',
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
                    tbody += "<td>" +data[key]['staff_name']+ "</td>";
                    tbody += "<td>" +data[key]['address']+ "</td>";
                    tbody += "<td>" +data[key]['mobile_number']+ "</td>";
                    tbody += "<td>" +data[key]['department_name']+ "</td>";

                    tbody += `<td>
                        <button type="button" class="btn btn-secondary btn-sm" value="${data[key]['id']}" id="editStaff">edit</button>
                        <button type="button" class="btn btn-danger btn-sm" value="${data[key]['id']}" id="deleteStaff">delete</button>
                    </td>`;

                    tbody += "</tr>";
                }
                $("#tbody").html(tbody);
            },
        })
    }
    getStaffs();

    $(document).on('click','#editStaff', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        // alert(id);
        $.ajax({
            url: "<?php base_url() ?>staff/editStaff",
            dataType: 'json',
            type: "POST",
            data: {id},
            success: function(data){
                console.log(data);

                $("#id").val(data.id);
                $("#staff_name").val(data.staff_name);
                $("#address").val(data.address);
                $("#mobile_number").val(data.mobile_number);
                $("#department_name").val(data.department_id);

                $("#staticBackdrop").modal("show");
            }
        })
        
    });

    $(document).on('click','#deleteStaff', function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
            url: "<?php base_url() ?>staff/destroy",
            dataType: 'json',
            type: "POST",
            data: {id},
            success: function(data){
                console.log(data);
                getStaffs();
            }
        })
    })
</script>



<!-- Department Modal -->
<div class="modal fade" id="staticDepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <input type="text" class="form-control" placeholder="Department" aria-label="First name"  id="department">
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveDepart">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
   $(document).on("click", '#saveDepart', function(){


var id = $("#id").val();
var addUpdate = (id == "" ) ? "<?php base_url(); ?>department/insert" : "<?php base_url(); ?>department/update";
    var department_name = $('#department').val();
    alert(department_name);

    $.ajax({
        url: addUpdate,
        data: {id, department_name},
        dataType: 'json',
        type: 'POST',
        success: function(data){
            console.log(data);
            $("#staticDepartment").modal("hide");
        }
    })
});
</script>
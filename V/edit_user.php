<?php

session_start();
require_once '../M/connectDB.php';
if (!isset($_SESSION['admin_login'])) {
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
  header('location: ../index.php');
}
include "../M/connect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
  <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css" rel="stylesheet">


</head>

<body>
  <?php include('../sidebar.php'); ?>
  <div class=" container">
    <h1>จัดการผู้ใช้</h1>
    <div class="mb-3" align="right">

      <div class="d-flex flex-row-reverse container mt-3">

        <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">เพิ่มผู้ใช้งาน User,adminQS</button>
      </div>

      <div class="container mt-2 mb-5">
        <form>
          <?php if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-danger d-flex text-start" role="alert">
              <?php
              echo $_SESSION['warning'];
              unset($_SESSION['warning']);
              ?>
            </div>
          <?php  } ?>

          <table id="myTable" class="display hover table-responsive" style="width:100%">
            <thead class="">

              <tr>
                <th class="th-sm text-center" scope="col">Username</th>
                </th>
                <th class="th-sm text-center" scope="col">Password</th>
                <th class="th-sm text-center" scope="col">Department</th>
                <th class="th-sm text-center" scope="col">Role</th>
                <th class="th-sm text-center" scope="col">Name</th>
                <th class="th-sm text-center" scope="col">Actions</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php
              $sql = "SELECT * FROM users WHERE role = 'user' OR role = 'admin' ";
              $sql_run = mysqli_query($con, $sql);
              ?>
              <?php $i = 1;
              $j = 0;
              while ($row2 = mysqli_fetch_assoc($sql_run)) { ?>

                <tr id="<?php echo $row2['id']; ?>">
                  <td data-bs-target="fname" class='text-truncate'><?php echo $row2['fname'] ?></td>
                  <td data-bs-target="password" class='text-truncate'><?php echo $row2['password'] ?></td>
                  <td data-bs-target="depart" class='text-truncate'><?php echo $row2['depart'] ?></td>
                  <td data-bs-target="role" class='text-truncate'><?php echo $row2['role'] ?></td>
                  <td data-bs-target="name" class='text-truncate'><?php echo $row2['name'] ?></td>

                  <td class="">
                    <a data-id="<?php echo $row2['id']; ?>" data-role="edit" class=" badge bg-warning fw-bold btn btn-link text-dark">แก้ไข</a>
                    <a onclick="return myConfirm(<?php echo $row2['id']; ?>);" class="badge bg-danger fw-bold btn btn-link text-black">ลบ</a>
                  </td>
                </tr>


              <?php }  ?>
            </tbody>
          </table>

          <hr class="border bg-black">
          <button type="button" class=" btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal3">เพิ่มผู้ใช้งาน Super</button>

          <table id="myTable2" class="display hover table-responsive" style="width:100%">
            <thead class="">

              <tr>
                <th class="th-sm text-center" scope="col">Username</th>
                </th>
                <th class="th-sm text-center" scope="col">Password</th>
                <th class="th-sm text-center" scope="col">Department</th>
                <th class="th-sm text-center" scope="col">Role</th>
                <th class="th-sm text-center" scope="col">Degree</th>
                <th class="th-sm text-center" scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php
              $sql = "SELECT * FROM users WHERE role = 'super'";
              $sql_run = mysqli_query($con, $sql);
              ?>
              <?php $i = 1;
              
              while ($row2 = mysqli_fetch_assoc($sql_run)) {  ?>

                <tr id="<?php echo $row2['id_depart_super']; ?>">
                  <td data-bs-target="fname" class='text-truncate'><?php echo $row2['fname'] ?></td>
                  <td data-bs-target="password" class='text-truncate'><?php echo $row2['password'] ?></td>
                  <td data-bs-target="depart"  class='text-truncate'><?php
                  $id_super = $row2['id_depart_super'];
                   $sql2 = "SELECT * FROM sub_depart_super WHERE id_depart_super = '$id_super'";
                   $sql_run2 = mysqli_query($con, $sql2);
                    while($row3 = mysqli_fetch_assoc($sql_run2)){
                      echo $row3['depart'] . ', ';
                    }
                    echo($row2['depart']);?></td>
                  <td data-bs-target="role" class='text-truncate'><?php echo $row2['role'] ?></td>
                  <td data-bs-target="role" class='text-truncate'><?php echo $row2['degree'] ?></td>

                  <td class="text-center">
                  
                    <a onclick="return myConfirm(<?php echo $row2['id']; ?>);" class="badge bg-danger fw-bold btn btn-link text-white">ลบ</a>

                  </td>
                </tr>
              <?php   }  ?>

            </tbody>
          </table>


        </form>
      </div>
    </div>
    <!--ปิด sidebar-->

</body>

</html>



<!-- Modal -->
<form method="POST" action="../C/insert_user.php">
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่ม USER</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <label for="fname" class="mt-2 form-label">UserName</label>
            <input required type="text" name="fname" class="form-control">
          </div>

          <label for="password" class="mt-2 form-label">Password</label>
          <input required type="text" name="password" class="form-control">

          <label for="name" class="mt-2 form-label">Name</label>
          <input placeholder="กรอกสำหรับสร้าง User AdminQS" type="text" name="name" class="form-control">

          <label for="depart" class="mt-2 form-label">Department</label>
          <input required type="text" name="depart" class="form-control">


          <label class="mt-2 form-label" for="role">Role</label>
          <select class=" form-select " name="role" id="role" required>
            <option value="">--โปรดเลือก--</option>
            <option value="user">user</option>
            <!-- <option value="super">super</option> -->
            <option value="admin">admin</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" name="btn_insertuser" class="btn btn-primary" value="เพิ่มผู้ใช้งาน">

        </div>
      </div>
    </div>
  </div>
</form>


<!-- Modal -->


<div class="modal fade " id="exampleModal2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไข USER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <input type="hidden" name="edit_id" id="edit_id">
        <label for="edit_fname" class="form-label">UserName</label>
        <input value="" required type="text" id="edit_fname" name="edit_fname" class="form-control">

        <label for="edit_password" class="form-label">Password</label>
        <input value="" required type="text" id="edit_password" name="edit_password" class="form-control">

        <label for="edit_name" class="form-label">Name</label>
        <input value="" type="text" id="edit_name" name="edit_name" class="form-control">

        <label for="edit_depart" class="form-label">Department</label>
        <input value="" required type="text" id="edit_depart" name="edit_depart" class="form-control">


        <label class="form-label" for="edit_role">Role</label>
        <select class=" form-select " name="edit_role" id="edit_role" required>
          <option value="">--โปรดเลือก--</option>
          <option value="user">user</option>
          <option value="admin">admin</option>
        </select>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" id="save" name="btn_edituser" class="btn btn-primary" value="บันทึก">

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<form method="POST" action="../C/insert_user.php">
  <div class="modal  fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่ม Super</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <label for="fname" class="mt-2 form-label">UserName</label>
            <input required type="text" name="fname2" class="form-control">
          </div>

          <label for="password" class="mt-2 form-label">Password</label>
          <input required type="text" name="password2" class="form-control">
          
          <label for="degree" class="mt-2 form-label">Degree</label>
          <input placeholder="ตำแหน่งปัจจุบัน" required type="text" name="degree" class="form-control">

          <!-- <label for="name" class="mt-2 form-label">Name</label>
          <input placeholder="กรอกสำหรับสร้าง User AdminQS" type="text" name="name" class="form-control"> -->

          <label for="depart" class="mt-2 form-label">Department</label>
          <input required type="text" name="depart2" class="form-control ">

          

          <a name="add-more-form " href="javascript:void(0)" class="btn btn-success text-white add-more-form  border mt-3 mb-2 center ">เพิ่มแผนก</a>
          <div class="paste-new-forms"></div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" name="btn_insertsuper" class="btn btn-primary" value="เพิ่มผู้ใช้งาน">

        </div>
      </div>
    </div>
  </div>
</form>


<div class="modal fade " id="exampleModal5" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไข super</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <label for="edit_name" class="form-label">Name</label>
        <input value="" type="text" id="edit_name" name="edit_name" class="form-control"> -->
        <input type="hidden" name="edit_id" id="edit_id">

        <label for="edit_depart2" class="form-label">Department</label>
        <input value="" required type="text" id="edit_depart2" name="edit_depart2" class="form-control">




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" id="save" name="btn_edituser" class="btn btn-primary" value="บันทึก">

      </div>
    </div>
  </div>
</div>


<script>
  function myConfirm(id) {
    Swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'ต้องหารลบหรือไม่',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {

        window.location.href = `../C/delete_user.php?id=${id}`

      } else {

      }
    })
  }
  $(document).ready(function() {
    $('#myTable').DataTable({

    });
    $('#myTable2').DataTable({

    });

    $(document).on('click', 'a[data-role=edit]', function() {

      var id = $(this).data('id');
      var fname = $('#' + id).children('td[data-bs-target=fname]').text();
      var password = $('#' + id).children('td[data-bs-target=password]').text();
      var name = $('#' + id).children('td[data-bs-target=name]').text();
      var depart = $('#' + id).children('td[data-bs-target=depart]').text();
      var role = $('#' + id).children('td[data-bs-target=role]').text();
      $('#edit_id').val(id);
      $('#edit_fname').val(fname);
      $('#edit_password').val(password);
      $('#edit_name').val(name);
      $('#edit_depart').val(depart);
      $('#edit_role').val(role);

      $('#exampleModal2').modal('show');
    })

    $(document).on('click', 'a[data-role=see_depart]', function() {
      var id2 = $(this).data('id');
      var depart2 = $('#' + id2).children('td[data-bs-target=depart]').text();
      $('#edit_depart2').val(id2);
$('#exampleModal5').modal('show');
})

    $('#save').click(function() {
      var id = $('#edit_id').val();
      var username = $('#edit_fname').val();
      var password = $('#edit_password').val();
      var name = $('#edit_name').val();
      var depart = $('#edit_depart').val();
      var role = $('#edit_role').val();

      $.ajax({
        type: "POST",
        url: "../C/edit_user.php",
        data: {
          username: username,
          password: password,
          name: name,
          depart: depart,
          role: role,
          id: id
        },
        success: function(response) {
          $('#exampleModal2').modal('hide');
          window.location.href = '../C/alert_edit_user.php';


        }
      });
    })



    var count = 0;

    $(document).on('click', '.add-more-form', function() {
      count++;
      $('.paste-new-forms').append('<div class="main-form row">\
        <div class="col-md-4">\
        <label for="" class="form-label">แผนก</label>\
                    <input required type="text" name="depart3[]" class="form-control">\
                    </div>\
                    <div class="col-md-3">\
                                    <label  class="form-label text-white">666</label>\
                                        <button type="button" class="form-control remove-btn btn btn-danger">Remove</button>\
                                    </div>\
                                    </div>');
      if (count == 40) {
        $(".add-more-form").hide()
        return;
      }

      console.log(count);

    });

    $(document).on('click', '.remove-btn', function() {
      $(this).closest('.main-form').remove();
      $(".add-more-form").show()
      count--;
    });

  });
</script>

<?php mysqli_close($con);
?>



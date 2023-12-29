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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
  <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css" rel="stylesheet">
</head>

<body>
    <?php include('../sidebar.php'); ?>
    <div style=" padding: 15px; min-width:100px;">
        <h1>ระดับของ USER</h1>
        <?php if(isset($_SESSION['warning'])){?>
            <div class="alert alert-warning" role="alert"><?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?></div>
  <?php } ?> 
        <div class="d-flex flex-row-reverse container mt-3">
    <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">เพิ่มผู้ใช้งาน</button>
  </div>
  <div class="container mt-2 mb-5">
        <table id="example" class="display hover table-responsive" style="width:100%">
            <thead>
                <tr>
                <th class="text-center">ลำดับ</th>
                    <th class="text-center">Number Degree</th>
                    <th class="text-center">Name Degree</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                $query = "SELECT * FROM user_degree ORDER BY number_degree ASC";
                $query_run = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($query_run))
                {
                ?>
                        <tr id="<?php echo $row['id']; ?>">
                        <td class="text-center"><?php echo $i ?></td>
                        <td data-bs-target="number_degree" class="text-center"><?php echo $row['number_degree'] ?></td>
                        <td data-bs-target="degree" class="text-center"><?php echo $row['degree'] ?></td>
                        <td class="text-center"><a data-id="<?php echo $row['id']; ?>" data-role="edit" class=" badge bg-warning fw-bold btn btn-link text-dark">แก้ไข</a>
                            <a onclick="return myConfirm(<?php echo $row['id']; ?>);" class="badge bg-danger fw-bold btn btn-link text-black">ลบ</a>
                        </td>
                    </tr>
                <?php 
                $i++;
                }
                ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    
    <!--ปิด sidebar-->
    </div>
    <!--ปิด sidebar-->

</body>

<form method="POST" action="../C/insert_degree.php">
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่ม ระดับ USER</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <label for="nummber_degree" class="mt-2 form-label">Number Degree</label>
          <input class="form-control" required type="number" name="number_degree" >

          <label for="degree" class="mt-2 form-label">Name Degree</label>
          <input required type="text" name="degree" class="form-control">

        </div>
        <div class="modal-footer">
          <input type="submit" name="btn_userdegree" class="btn btn-primary" value="เพิ่มระดับ">
        </div>
      </div>
    </div>
  </div>
</form>

</html>
<div class="modal fade " id="exampleModal2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไข Degree</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <input type="hidden" name="edit_id" id="edit_id">
        <label for="edit_number_degree" class="form-label">Number Degree</label>
        <input value="" required type="text" id="edit_number_degree" name="edit_number_degree" class="form-control">

        <label for="edit_degree" class="form-label">Name Degree</label>
        <input value="" required type="text" id="edit_degree" name="edit_degree" class="form-control">

      </div>
      <div class="modal-footer">
        <input type="submit" id="save" name="btn_editdegree" class="btn btn-primary" value="บันทึก">
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
  
</script>

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
        
        window.location.href = `../C/delete_degree.php?id=${id}`

      } else {

      }
    })
  }
  $(document).ready(function() {
    
    $(document).on('click', 'a[data-role=edit]', function() {

      var id = $(this).data('id');
      var number_degree = $('#' + id).children('td[data-bs-target=number_degree]').text();
      var degree = $('#' + id).children('td[data-bs-target=degree]').text();
      $('#edit_id').val(id);
      $('#edit_number_degree').val(number_degree);
      $('#edit_degree').val(degree);
      
      $('#exampleModal2').modal('show');
    })

    $('#save').click(function() {
      var id = $('#edit_id').val();
      var number_degree = $('#edit_number_degree').val();
      var degree = $('#degree').val();
     

      $.ajax({
        type: "POST",
        url: "../C/edit_user.php",
        data: {
          number_degree: number_degree,
          degree: degree,
          id: id
        },
        success: function(response) {
          $('#exampleModal2').modal('hide');
          //window.location.href = '../C/alert_edit_user.php';
        }
      });
    })
  });
</script>
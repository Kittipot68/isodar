<?php

session_start();
require_once '../M/connectDB.php';
if (!isset($_SESSION['superuser_login'])) {
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
  header('location: ../index.php');
}


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

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <a class="navbar-brand">
        <img src="../img/sungroup.png" alt="" width="120" height="40" class="m-1 d-inline-block align-text-top">

      </a>
      <div class="navbar" id="">
        <a href="../C/alert_logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>
</head>

<body>

  <?php
  include '../M/connect.php';
  if (isset($_SESSION['superuser_login'])) {
    $user_id = $_SESSION['superuser_login'];
    $stmt = ("SELECT * FROM users WHERE id = $user_id");
    $stmt_run = mysqli_query($con, $stmt);
    $row = mysqli_fetch_assoc($stmt_run);
  }

  $sql = "SELECT * FROM request WHERE document_status = 0";
  $sql_run = mysqli_query($con, $sql);
  //print_r($row);
    

  ?>
  <div class="container mt-2 mb-5">
    <form>
      <h1 class="mb-4">List Approve (<?php
       $id_super = $row['id_depart_super'];
       $sql2 = "SELECT * FROM sub_depart_super WHERE id_depart_super = '$id_super'";
       $sql_run2 = mysqli_query($con, $sql2);
        while($row3 = mysqli_fetch_assoc($sql_run2)){
          echo $row3['depart'] . ' ';
        }
      echo $row['depart']; ?>)</h1>
      <table id="myTable" class=" table-responsive table table-bordered table-striped ">
        <thead class="">
          <tr>
            <th class="th-sm text-center" scope="col">ลำดับ</th>
            <th class="th-sm text-center" scope="col">ชื่อ-นามสกุล</th>
            <th class="th-sm text-center" scope="col">แผนก</th>
            <th class="th-sm text-center" scope="col">หมายเลขเอกสาร</th>
            <th class="th-sm text-center" scope="col">ชื่องาน</th>
            <th class="th-sm text-center" scope="col">ขอดำเนินการ</th>
            <th class="th-sm text-center" scope="col">รายละเอียดแก้ไข</th>
            <th class="th-sm text-center" scope="col">ดูรายละเอียด</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          if (mysqli_num_rows($sql_run) > 0) {
            $i = 1;
            $j = 0;
            while ($row2 = mysqli_fetch_assoc($sql_run)) {
              
                    while($row3 = mysqli_fetch_assoc($sql_run2)){
                      if ($row['depart'] == $row2['depart'] || $row['depart'] == $row3['depart'] ) {
                      }
                      }
                echo "<tr>";
                echo "<th>" . $i++ . "</th>";
                echo "<td>" . $row2['name1'] . "</td>";
                echo "<td>" . $row2['depart'] . "</td>";
                echo "<td>" . $row2['document_number'] . "</td>";
                echo "<td>" . $row2['document_name'] . "</td>";
                echo "<td>" . $row2['cause'] . "</td>";
                echo "<td class=''>" . $row2['information_edit'] . "</td>";
                echo '<td class=""><a class="fw-bold btn btn-link badge bg-primary text-white" href="detail_request.php?updateid=' . $row2['id'] . '">ดูรายละเอียด</a></td>';
                echo "</tr>";
                    
            }
          }

          ?>
        </tbody>
      </table>
    </form>
  </div>

</body>

</html>
<script>
  function deleteItems() {
    localStorage.clear();
  }


  $(document).ready(function() {
    $('#myTable').DataTable();

  });
</script>
<?php   mysqli_close($con);  ?>
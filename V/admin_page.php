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
    <title>User Page</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css" rel="stylesheet">

</head>


<body>
<?php include('../sidebar.php'); ?>

    
    
        <?php 

            if (isset($_SESSION['admin_login'])) {
                $admin_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<script>";
                echo "
                var visited = localStorage.getItem('visited');

                if (!visited) {
                  
                 
                    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    
                    }
                  })

                  Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                  });
                  localStorage.setItem('visited', true);

                  
                }";
                  echo "</script>";}
                  $sql = "SELECT * FROM request WHERE document_status = 1";
                  $sql_run = mysqli_query($con,$sql);
                  mysqli_close($con);
                  //print_r($row);
            
        ?>
          <div style=" padding: 15px; min-width:100px;"> 
        <form>
        <h1>Document Action Request</h1>
        <table id="myTable" class="display hover table-responsive" style="width:100%">
        <thead>
            <tr>
            <th class="text-center">ลำดับ</th></th>
              <th class="text-center">ชื่อ-นามสกุล</th>
              <th class="text-center">แผนก</th>
              <th class="text-center">หมายเลขเอกสาร</th>
              <th class="text-center">ชื่องาน</th>
              <th class="text-center">ขอดำเนินการ</th>
              <th class="text-center">รายละเอียดแก้ไข</th>
              <th class="text-center">ดูรายละเอียด</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
          if(mysqli_num_rows($sql_run) > 0)
          {
              $i=1;
              $j=0;
              while($row2 = mysqli_fetch_assoc($sql_run)){
                  //print_r($row2);
                  ?>
                  <tr>
                  <th><?php echo $i++;?></th>
                   <td><?php echo $row2['name1'];?></td>
                   <td><?php echo $row2['depart'];?></td>
                   <td><?php echo $row2['document_number'];?></td>
                   <td><?php echo $row2['document_name'];?></td>
                   <td><?php echo $row2['request'];?></td>
                   <td><?php echo $row2['information_edit'];?></td>
                  <td><a class="fw-bold btn btn-link text-black" href="detail_request_admin.php?updateid=<?php echo $row2['id']; ?>">ดูรายละเอียด</a></td>
                   </tr>
                  <?php
          
          }
        }
          ?>
        </tbody>
        <tfoot>
            
        </tfoot>
              </table>
              </form>
              </div>
        
   
    
                  </div> <!--ปิด sidebar-->
</body>

</html>


</div>
<script>
    
    
    function deleteItems() {
  localStorage.clear();
}
$(document).ready(function(){

  $('#myTable').DataTable({
    rowReorder: true,
    responsive: true

    });
});
</script>

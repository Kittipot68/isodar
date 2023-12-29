<?php 

    session_start();
    require_once '../M/connectDB.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../index.php');
    }
    ini_set('log_errors','On');
    ini_set('display_errors','Off');
    ini_set('error_reporting', E_ALL );
 

?>


<?php 

 if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="modal modal-lg modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">รออนุมัติ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ผู้ขอ</th>
      <th scope="col">หมายเลขเอกสาร</th>
      <th scope="col">ชื่องาน</th>
      <th scope="col">สถานะ</th>
    </tr>
  </thead>
  <tbody>
  <?php 
      include '../M/connect.php';
      $depart2 = $row['depart'];
       $sql = "SELECT * FROM request WHERE document_status = '0' and depart = '$depart2' ";
       $sql_run = mysqli_query($con,$sql);
       $i = 0;
       while($row2 = mysqli_fetch_assoc($sql_run)){
       //print_r($depart); 
      ?>
    <tr>
      
      <td><?php echo $row2['name1']   ?></td>
      <td><?php echo $row2['document_number']?></td>
      <td><?php echo $row2['document_name']?></td>
<td><h5><span class="badge bg-secondary">รออนุมัติ</span></h5></td>
      
    </tr>
    <?php
    $i++;
  }
  ?>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

  </head>
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
<body class="mb-5">
<div class="mt-2 container">
        <h1>List FILE (<?php echo $row['depart']; ?>)</h1>
        <div class="mb-3" align="right">

        <a style="text-decoration: none;" class="btn btn-primary"  href="../V/user_page.php">ส่งคำขอ</a>
<button type="button" class="btn btn-warning position-relative " data-bs-toggle="modal" data-bs-target="#exampleModal">
  คำขอที่รออนุมัติ
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $i;?>
    <span class="visually-hidden">unread messages</span>
  </span>
</button>

<button class="btn btn-secondary">ดูประวัติการขึ้นทะเบียน</button>

        </div>
        <div  class="table-responsive">
        <table  id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>File Name</th>
                <th>Date Modified</th>
            </tr>
            </thead>
            <tbody>
        <?php 
        $depart = $row['depart'];

        $folder = array_filter(glob('*'),'is_dir');
        $file_data = scandir($depart);
        $output = '';
        foreach($file_data as $file){
            if($file === '.' OR $file ==='..'){
                continue;
            }
            else{
                $path = $depart.'/'.$file; 
                    echo '<tr>';   
                    echo '<td>';
                    echo '<a class="text-dark" href="../C/dowload.php?fileuser='.$file.'&amp;depart='.$depart.'">'.$file.'</a>'; 
                    echo '</td>';
                    $mod_date=date("d F  Y H:i:s.", filemtime($path));
                    echo '<td>'.$mod_date.'</td>';
                    echo '</tr>';
                }
        }
        ?>
        </tbody>
        
        </table>
        </div>
    </div>
</body>



</html>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>



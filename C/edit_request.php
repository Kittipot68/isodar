<?php
 session_start();
 require_once '../M/connectDB.php';
 if (!isset($_SESSION['superuser_login'])) {
     $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
     header('location: ../index.php');
 }

include '../M/connect.php';
$id = $_GET['id'];
 if (isset($_REQUEST['btn_insert'])){
    $cause_edit = $_POST['cause_edit'];
    $query = "UPDATE request SET cause_edit = '$cause_edit', document_status = '2' WHERE id='$id' ";
    $run_query = mysqli_query($con,$query);
    //print_r($id);
 }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js" ></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <?php  
        
        echo"<script>";
        echo"Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ส่งกลับแก้ไขสำเร็จ',
            showConfirmButton: false,
            timer: 2000
        }).then((result) => {
            if(result){
                window.location.href = '../V/superuser_page.php';
            }
        })";
        echo"</script>";
                                 ?>
</body>
</html>
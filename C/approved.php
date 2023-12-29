<?php 
date_default_timezone_set("Asia/Bangkok");

    session_start();
    require_once '../M/connectDB.php';
    if (!isset($_SESSION['superuser_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../index.php');
    }
    $id = $_GET['id'];
   
include '../M/connect.php';
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
    
     if (isset($_SESSION['superuser_login'])) {
        $user_id = $_SESSION['superuser_login'];
        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if (isset($_REQUEST['btn_insert'])){
        $approved_name = $_POST['approved_name'];
        //$approved_degree = $_POST['approved_degree'];
        $approved_date = date("Y-m-d H:i:s");
        $approved_degree = $row['degree'];
        
        

        $sql = "UPDATE request SET document_status='1',approved_name='$approved_name',
        approved_degree='$approved_degree',approved_date= '$approved_date' WHERE id=$id";
        $sql_run = mysqli_query($con,$sql);
        mysqli_close($con);
    }
        echo"<script>";
        echo"Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'อนุมัติสำเร็จ',
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
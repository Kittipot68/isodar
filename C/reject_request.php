<?php

    $id = $_GET['id'];
    include "../M/connect.php";
    $today = date("Y-m-d H:i:s");  
    print_r($today);
    $query = "UPDATE  request SET document_status = 2 , reject_date = '$today' WHERE id=$id";    
    $sql_run = mysqli_query($con,$query);
    mysqli_close($con);

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
            title: 'REJECT คำขอสำเร็จ',
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
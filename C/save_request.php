<?php   
session_start();
date_default_timezone_set("Asia/Bangkok");

require_once '../M/connectDB.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../index.php');
}
$id = $_GET['id'];

if (isset($_SESSION['admin_login'])) {
    $user_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}   
if (isset($_REQUEST['btn_insert'])){
    $qs_name= $_POST['qs_name'];
    $noti_date=$_POST['noti_date'];
    $edit_date=$_POST['edit_date'];
    $master_date=$_POST['master_date'];
    $delete_date=$_POST['delete_date'];
    $rev = $_POST['rev'];
    $effective_date_qs = $_POST['effective_date_qs'];
    // print_r($id);
    // print_r($qs_name);
    // print_r($qs_number);
    // print_r($noti_date);
    // print_r($edit_date);

    $approve_date = date("Y-m-d H:i:s");
    include "../M/connect.php";
    $sql = "UPDATE request SET document_status='3',qs_name='$qs_name',
    noti_date='$noti_date',edit_date='$edit_date',
    master_date='$master_date',delete_date = '$delete_date',admin_approve = '$approve_date',rev='$rev',effective_date_qs='$effective_date_qs' WHERE id= $id ";

    $sql_run = mysqli_query($con,$sql);

    
    mysqli_close($con);
    
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
            title: 'บันทึกสำเร็จ',
            showConfirmButton: false,
            timer: 2500
        }).then((result) => {
            if(result){
                window.location.href = '../V/admin_page.php';
            }
        })";
        echo"</script>";
                                 ?>
</body>
</html>
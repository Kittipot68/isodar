<?php

$id = $_GET['id'];
//print_r($id);
include "../M/connect.php";


date_default_timezone_set("Asia/Bangkok");

session_start();
require_once '../M/connectDB.php';
if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../index.php');
}
if (isset($_REQUEST['btn_edit'])){

        $depart  = $row['depart'];
        $name1 = $_POST['name1'];
        $employee_id = $_POST['employee_id'];
        $indoc = $_POST['in_doc'];
        $degree = $_POST['degree'];
        $document_number = $_POST['document_number'];
        $document_name = $_POST['document_name'];
        $effective_date = $_POST['effective_date'];
        $request = $_POST['request'];
        $cause = $_POST['cause'];
        $page_edit = $_POST['page_edit'];
        $information_edit = $_POST['information_edit'];
        $about_edit = $_POST['about_edit'];
        //$file_name_upload = $_FILES["file_name_upload"]["name"];
        $fileName = basename($_FILES["file_name_upload"]["name"]);
        $targetDir = "../uploads/";
        $targetFilePath = $targetDir . $fileName;
        $temp = $_FILES['file_name_upload']['tmp_name'];
        $document_status = "0";
        //$path = "../uploads" . $file_name_upload;
        $date;
        //print_r($effective_date);
        if($effective_date == '')
        {
        $date = 'ไม่ได้ระบุ';
        $query = "UPDATE request SET name1 = '$name1',employee_id = '$employee_id', indoc = '$indoc', degree = '$degree',
        document_number = '$document_number' , document_name = '$document_name', effective_date='$date', 
        request = '$request' , cause = '$cause' , page_edit = '$page_edit' , information_edit = '$information_edit' ,
        about_edit = '$about_edit' , file_name_upload = '$fileName',document_status = '0' WHERE id ='$id'";
        $run_query = mysqli_query($con,$query);
        //$sql = "INSERT INTO request ('name1','degree,'document_number','document_name','effective_date')"
        move_uploaded_file($_FILES['file_name_upload']['tmp_name'], $targetFilePath);
        }

        else
        {
        $query = "UPDATE request SET name1 = '$name1',employee_id = '$employee_id', indoc = '$indoc', degree = '$degree',
        document_number = '$document_number' , document_name = '$document_name', effective_date='$effective_date', 
        request = '$request' , cause = '$cause' , page_edit = '$page_edit' , information_edit = '$information_edit' ,
        about_edit = '$about_edit' , file_name_upload = '$fileName',document_status = '0' WHERE id ='$id'";
        $run_query = mysqli_query($con,$query);
        //$sql = "INSERT INTO request ('name1','degree,'document_number','document_name','effective_date')"
        move_uploaded_file($_FILES['file_name_upload']['tmp_name'], $targetFilePath);

        $depart2 = $row['depart'];
        //print_r($row['depart']);
        $query = ("SELECT * FROM users WHERE depart = '$depart2' AND role = 'super'");
        $stmt_run = mysqli_query($con,$query);
        $row2 = mysqli_fetch_assoc($stmt_run);
        //print_r($row2);
           
            mysqli_close($con);
                    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        mysqli_close($con);
        
       header('refresh:0;../C/alert_add_request.php');
        
}


?>
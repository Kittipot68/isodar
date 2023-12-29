<?php
include '../M/connect.php';
date_default_timezone_set("Asia/Bangkok");

session_start();
require_once '../M/connectDB.php';
ini_set('log_errors', 'On');
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
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
//print_r($row['depart']);
if (isset($_REQUEST['btn_insert'])){
        $depart  = $row['depart'];
        $cause_other = $_POST['cause_other'];

        $name1 = $_POST['name1'];
        $employee_id = $_POST['employee_id'];
        $indoc = $_POST['in_doc'];
        $degree = $_POST['degree'];
        $name2 = $_POST['name2'];
        $employee_id2 = $_POST['employee_id2'];
        $degree2 = $_POST['degree2'];
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
        $temp1 = $_FILES['file_name_upload']['tmp_name'];


        $fileName2 = basename($_FILES["file_name_upload2"]["name"]);
        $targetFilePath2 = $targetDir . $fileName2;
        $temp2 = $_FILES['file_name_upload2']['tmp_name'];
        // print_r($temp1.$targetFilePath);
        // print_r($temp2.$targetFilePath2);

        $document_status = "0";
        $bytes = uniqid();
        //$path = "../uploads" . $file_name_upload;
        $date;
        //print_r($effective_date);
        if($effective_date == '')
        {
        $date = 'ไม่ได้ระบุ';
        
        $query = "INSERT INTO request(name1,employee_id,indoc,degree,depart,document_number,document_name,effective_date,request,cause,page_edit,information_edit,about_edit,file_name_upload,document_status,sub_id,cause_other) 
        values('$name1','$employee_id','$indoc','$degree','$depart','$document_number','$document_name','$date','$request','$cause','$page_edit','$information_edit','$about_edit','$fileName','$document_status','$bytes','$cause_other')";
        $run_query = mysqli_query($con,$query);
        //$sql = "INSERT INTO request ('name1','degree,'document_number','document_name','effective_date')"
        move_uploaded_file($_FILES['file_name_upload']['tmp_name'], $targetFilePath);

        // $id_request = "SELECT id FROM request ORDER BY ID DESC LIMIT 1";
        // $query_run_id = mysqli_query($con, $id_request);
        // $row2 = mysqli_fetch_assoc($query_run_id);
        // $request_id = $row2['id'];
        
        foreach ($name2 as $index => $names) {
            $s_name = $names;
            $s_employeeid = $employee_id2[$index];
            $s_degree = $degree2[$index];
            $query_member = "INSERT INTO sub_request_member (name2,employee_id2,degree2,id_requuest) VALUES ('$s_name','$s_employeeid','$s_degree','$bytes')";
            $query_run_member = mysqli_query($con, $query_member);
        }
        if(($fileName2!=='')){
            $query_sub_file ="INSERT INTO sub_request_file (file_name,id_request) VALUES ('$fileName2','$bytes')";
            $query_run_sub_file = mysqli_query($con, $query_sub_file);
            move_uploaded_file($_FILES['file_name_upload2']['tmp_name'], $targetFilePath2);
        }
        


        }

        else
        {
        
        $query = "INSERT INTO request(name1,employee_id,indoc,degree,depart,document_number,document_name,effective_date,request,cause,page_edit,information_edit,about_edit,file_name_upload,document_status,sub_id,'cause_other') 
        values('$name1','$employee_id','$indoc','$degree','$depart','$document_number','$document_name','$effective_date','$request','$cause','$page_edit','$information_edit','$about_edit','$fileName','$document_status','$bytes','$cause_other')";
        $run_query = mysqli_query($con,$query);
        //$sql = "INSERT INTO request ('name1','degree,'document_number','document_name','effective_date')"
        move_uploaded_file($_FILES['file_name_upload']['tmp_name'], $targetFilePath);

        // $id_request = "SELECT id FROM request ORDER BY ID DESC LIMIT 1";
        // $query_run_id = mysqli_query($con, $id_request);
        // $row2 = mysqli_fetch_assoc($query_run_id);
        // $request_id = $row2['id'];
        foreach ($name2 as $index => $names) {
            $s_name = $names;
            $s_employeeid = $employee_id2[$index];
            $s_degree = $degree2[$index];
            $query_member = "INSERT INTO sub_request_member (name2,employee_id2,degree2,id_requuest) VALUES ('$s_name','$s_employeeid','$s_degree','$request_id')";
            $query_run_member = mysqli_query($con, $query_member);
        }   

        if(($fileName2!=='')){
            $query_sub_file ="INSERT INTO sub_request_file (file_name,id_request) VALUES ('$fileName2','$bytes')";
            $query_run_sub_file = mysqli_query($con, $query_sub_file);
            move_uploaded_file($_FILES['file_name_upload2']['tmp_name'], $targetFilePath2);

        }

        
           
        
                    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        mysqli_close($con);
        $_SESSION['request'] = 1;
        header('refresh:0;../C/alert_add_request.php');
        
}


?>
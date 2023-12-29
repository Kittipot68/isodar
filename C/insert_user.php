<?php
session_start();
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
include "../M/connect.php";

if(isset($_POST['btn_insertuser']))
{
    $username = $_POST['fname'];
    $depart = $_POST['depart'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $query2 = "SELECT * FROM users WHERE fname = '$username'";
    $sql_run2 = mysqli_query($con,$query2);
    $row = mysqli_fetch_assoc($sql_run2);
    if($row['fname'] == $username){
        $_SESSION['warning'] = "UserName นี้มีในระบบแล้ว กรุณาเพิ่มใหม่";
        header('refresh:0;../V/edit_user.php');
    }else{
        $query = "INSERT INTO users  (fname,password,name,depart,role) values('$username','$password','$name','$depart','$role')";
        $sql_run = mysqli_query($con,$query);
        header('refresh:0;../C/alert_edit_user.php');
    }
    // 
}

if(isset($_POST['btn_insertsuper'])){
    $username = $_POST['fname2'];
    $depart2 = $_POST['depart2'];
    $depart3 = $_POST['depart3'];

    //$role = $_POST['role'];
    $role = 'super';
    $password = $_POST['password2'];
    $degree  = $_POST['degree'];
    //$name = $_POST['name'];

    $bytes = uniqid();
    //print_r($bytes);

    $query2 = "SELECT * FROM users WHERE fname = '$username'";
    $sql_run2 = mysqli_query($con,$query2);
    $row = mysqli_fetch_assoc($sql_run2);

    if($row['fname'] == $username){
        $_SESSION['warning'] = "UserName นี้มีในระบบแล้ว กรุณาเพิ่มใหม่";
        header('refresh:0;../V/edit_user.php');
    }else{
        
        $query = "INSERT INTO users  (fname,password,depart,role,id_depart_super,degree) values('$username','$password','$depart2','$role','$bytes','$degree')";
        $sql_run = mysqli_query($con,$query);
        foreach($depart3 as $index =>$departs){
            $s_depart = $departs;
            $query2 = "INSERT INTO sub_depart_super  (depart,id_depart_super) values('$s_depart','$bytes')";
            $sql_run2 = mysqli_query($con,$query2);
        }

        header('refresh:0;../C/alert_edit_user.php');
    }
    // 
}
mysqli_close($con);

    



    

?>
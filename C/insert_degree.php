<?php
session_start();
 ini_set('display_errors','Off');
 ini_set('error_reporting', E_ALL );
include "../M/connect.php";

if(isset($_POST['btn_userdegree']))
{
    $number_degree = $_POST['number_degree'];
    $degree = $_POST['degree'];
    $query2 = "SELECT * FROM user_degree WHERE number_degree = '$number_degree'";
    $sql_run2 = mysqli_query($con,$query2);
    $row = mysqli_fetch_assoc($sql_run2);
   
        if($row['number_degree'] == $number_degree){
            $_SESSION['warning'] = "ระดับนี้มีในระบบแล้ว กรุณาเพิ่มใหม่";
            header('refresh:0;../V/edit_degree.php');
        }else{
            $query = "INSERT INTO user_degree  (number_degree,degree) values('$number_degree','$degree')";
            $sql_run = mysqli_query($con,$query);
            $_SESSION['user']=1;
            header('refresh:0;../C/alert_edit_degree.php');
        }
    
    
    // 
}
if(isset($_POST['btn_superdegree']))
{
    $number_degree = $_POST['number_degree'];
    $degree = $_POST['degree'];
    $query3 = "SELECT * FROM super_degree WHERE number_degree = '$number_degree'";
    $sql_run3 = mysqli_query($con,$query3);
    $row22 = mysqli_fetch_assoc($sql_run3);
        if($row22['number_degree'] == $number_degree){
            $_SESSION['warning'] = "ระดับนี้มีในระบบแล้ว กรุณาเพิ่มใหม่";
            header('refresh:0;../V/edit_degree_super.php');
        }else{
            $query4 = "INSERT INTO super_degree  (number_degree,degree) values('$number_degree','$degree')";
            $sql_run = mysqli_query($con,$query4);
            $_SESSION['super']=1;
            header('refresh:0;../C/alert_edit_degree.php');
        }
    
    
    // 

    mysqli_close($con);
}

// if(isset($_POST['btn_insertsuper']))
// {
//     include "../M/connect.php";
//     $username = $_POST['fname'];
//     $depart = $_POST['depart'];
//     $role = $_POST['role'];
//     $password = $_POST['password'];
//     $name = $_POST['name'];

//     $query2 = "SELECT * FROM users WHERE fname = '$username'";
//     $sql_run2 = mysqli_query($con,$query2);
//     $row = mysqli_fetch_assoc($sql_run2);
//     if($row['fname'] == $username){
//         $_SESSION['warning'] = "UserName นี้มีในระบบแล้ว กรุณาเพิ่มใหม่";
//         header('refresh:0;../V/edit_user.php');

//     }else{
//         $query = "INSERT INTO users  (fname,password,name,depart,role) values('$username','$password','$name','$depart','$role')";
//         $sql_run = mysqli_query($con,$query);
//         header('refresh:0;../C/alert_edit_user.php');
//     }
//     // 
//     mysqli_close($con);
// }
   
    



    

?>
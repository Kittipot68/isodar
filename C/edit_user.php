<?php
include "../M/connect.php";

    $username = $_POST['username'];
    $depart = $_POST['depart'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $name = $_POST['name'];

    $query = "UPDATE users SET fname = '$username',
    password = '$password',name = '$name', depart = '$depart',
    role = '$role'
    WHERE id='$id'";

$sql_run = mysqli_query($con,$query);
mysqli_close($con);





?>
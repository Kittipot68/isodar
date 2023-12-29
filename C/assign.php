<?php
include "../M/connect.php";

$request_id = $_GET['idreq'];
if (isset($_REQUEST['btn_assign'])) {
        $id = $_POST['assign'];
        $id_runcode = $_GET['idreq'];


        $query4 = "SELECT * FROM request WHERE id = $id_runcode";
        $sql_run4 = mysqli_query($con, $query4);
        $row4 = mysqli_fetch_assoc($sql_run4);
        // print_r($row4);
        $depart = $row4['depart'];
        $year = date('y') + 43;

        $query5 = "SELECT * FROM run_code WHERE depart = '$depart' AND year='$year'";
        $sql_run5 = mysqli_query($con, $query5);
        $row5 = mysqli_fetch_assoc($sql_run5);
        print_r($row5);

        if ($result = mysqli_num_rows($sql_run5) > 0) {
                $query7 = "SELECT * FROM run_code WHERE depart = '$depart' AND year='$year'";
                $sql_run7 = mysqli_query($con, $query7);
                $row7 = mysqli_fetch_assoc($sql_run7);
                $run_year = $row7['year'];
                $run_number  = $row7['number'];
                // if()
                // {

                // }
                $run_number++;
                $query8 = "UPDATE run_code SET number = '$run_number' WHERE depart = '$depart' AND year='$year'";
                $sql_run8 = mysqli_query($con, $query8);
        } else {
                $depart_upper =  strtoupper($depart);
                $year_thai = date('y') + 43;
                $number_autorun = '1';
                $query6 = "INSERT INTO run_code (depart,year,number) VALUES ('$depart_upper','$year_thai','$number_autorun')";
                $sql_run6 = mysqli_query($con, $query6);
        }

        $query9 = "SELECT * FROM run_code WHERE depart = '$depart' AND year='$year'";
        $sql_run9 = mysqli_query($con, $query9);
        $row9 = mysqli_fetch_assoc($sql_run9);
        $number_temp = $row9['number'];
        $number_code =  str_pad($number_temp, 4, '0', STR_PAD_LEFT);
        $run_code = $row9['depart'] . $row9['year'] . '/' . $number_code;
        //print_r($run_code);

        $query10 = "UPDATE request SET run_code = '$run_code' WHERE id = '$id_runcode'";
        $sql_run10 = mysqli_query($con, $query10);



        ////////////////////////////////////////////////////////////////////////////
        $query = "SELECT * FROM users WHERE id = $id";
        $sql_run = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($sql_run);

        $name = $row['name'];
        $query2 = "INSERT INTO assign (id,id_request,name) VALUES ('$id','$request_id','$name')";
        $sql_run2 = mysqli_query($con, $query2);

        $query3 = "UPDATE request SET document_status = 4 , assign_id = '$id' WHERE id = $request_id";
        $sql_run3 = mysqli_query($con, $query3);




        header('location: ../V/admin_assign.php');
}

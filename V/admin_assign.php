<?php

session_start();
require_once '../M/connectDB.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../index.php');
}

include "../M/connect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css" rel="stylesheet">
</head>

<body>
    <?php include('../sidebar.php'); ?>

    <div style=" padding: 15px; min-width:100px;">
        <h1>Assigned</h1>
        <table id="example" class="display hover table-responsive" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">CODE</th>
                    <th class="text-center">หมายเลขเอกสาร</th>
                    <th class="text-center">ชื่องาน</th>
                    <th class="text-center">ผู้จัดทำ</th>
                    <th class="text-center">ดูรายละเอียด</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $admin_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $ass_id = $row['id'];
                 //print_r($ass_id);
                $sql = "SELECT * FROM request WHERE document_status = 4 AND assign_id = $ass_id";
                $sql_run = mysqli_query($con, $sql);
                $i = 1;
                $j = 0;
                while ($row2 = mysqli_fetch_assoc($sql_run)) {
                    $id = $row2['id'];

                    $sql2 = "SELECT * FROM assign WHERE id_request = '$id'";
                    $sql_run2 = mysqli_query($con, $sql2);
                    $row3 = mysqli_fetch_assoc($sql_run2);

                    // $date = date("Y");
                    // $thaidate = $date + 543;
                    // $v = substr($thaidate, -2, 2); // returns ""
                    // $depart = $row2['depart'];
                    // $str = "$depart" . "$v";
                    // $pattern_src = '@(.{5})(.{2})@';
                    // $pattern_rpl = "$1.$2";

                    // $res = preg_replace($pattern_src, $pattern_rpl, $str);
                    // //$res eq 12.3AB-C5-67.8 
                ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="text-center"><?php echo $row2['run_code']; ?></td>
                        <td class="text-center"><?php echo $row2['document_number']; ?></td>
                        <td class="text-center"><?php echo $row2['document_name']; ?></td>
                        <td class="text-center"><?php echo $row3['name']; ?></td>
                        <td><a class="  fw-bold btn btn-link text-white  bg-primary" href="detail_request_admin_assign.php?updateid=<?php echo $row2['id']; ?>">ดูรายละเอียด</a></td>
                    </tr>
                <?php }
                mysqli_close($con);
                ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    </div>
    <!--ปิด sidebar-->

</body>

</html>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
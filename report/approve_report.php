<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
session_start();
require_once '../M/connectDB.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../index.php');
}
    if (isset($_SESSION['admin_login'])) {
        $admin_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
    include "../M/connect.php";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master List</title>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
</head>

<body>
<?php include('../sidebar.php'); ?>

    <div style=" padding: 15px; min-width:100px;">
        <h1>Master List</h1>
        <form method="POST" action="">
        <div class="mt-4 mb-4">

            <input name="datefrom" class=" input-sm " type="date" value="<?php if (isset($_POST['datefrom'])) {echo $_POST['datefrom'];} ?>" required>
            &nbsp; ถึง &nbsp;
            <input name="dateto" class=" input-sm " type="date" value="<?php if (isset($_POST['dateto'])) {echo $_POST['dateto'];} ?>" required>
            <input type="submit" name="button2" id="button2" class="btn btn-sm btn-success" value="ค้นหา">

        </div>
        </form>
        <!-- <table class="mb-3" border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="text" id="min" name="min"></td>
        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
    </tbody></table> -->
        <table id="example" class="display hover table-responsive" style="width:100%" >
            <thead>
                <tr>
                    <th class="text-center">Code</th>
                    <th class="text-center">แผนก</th>
                    <th class="text-center">หมายเลขเอกสาร</th>
                    <th class="text-center">ชื่องาน</th>
                    <th class="text-center">Rev.</th>
                    <th class="text-center">การขอดำเนินงาน</th>
                    <th class="text-center">ชื่อผู้ขอดำเนินการ</th>
                    <th class="text-center">ชื่อผู้จัดทำ</th>
                    <th class="text-center">วันที่มีผลบังคับใช้</th>
                    <th class="text-center">วันที่ยกเลิก</th>



                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                    $year = "AND admin_approve BETWEEN  '" . $_POST['datefrom'] . "'  AND  '" . $_POST['dateto'] . "' ";
                }
                $sql = "SELECT * FROM request WHERE document_status = 3 $year";
                $sql_run = mysqli_query($con, $sql);
                if(isset($_POST['button2'])){
                while ($row2 = mysqli_fetch_assoc($sql_run)) {

                    if ($row2['effective_date_qs'] == null) {
                        $effective_date_qs = 'ไม่ได้ระบุ';
                    } else {
                        $date = new DateTime($row2['effective_date_qs']);
                        $effective_date_qs = $date->format('d M Y');
                    }
                    if ($row2['cancellation_date'] == null) {
                        $cancellation_date = 'ไม่ได้ระบุ';
                    } else {
                        $date2 = new DateTime($row2['cancellation_date']);
                        $cancellation_date = $date2->format('d M Y');
                    }

                ?>
                    <tr >
                        <td  class="text-center"><?php echo $row2['run_code']; ?></td>
                        <td class="text-center"><?php echo $row2['depart']; ?></td>
                        <td class="text-center"><?php echo $row2['document_number']; ?></td>
                        <td class="text-center"><?php echo $row2['document_name']; ?></td>
                        <td class="text-center"><?php echo $row2['rev']; ?></td>
                        <td class="text-center"><?php echo $row2['request']; ?></td>
                        <td class="text-center"><?php echo $row2['name1']; ?></td>
                        <td class="text-center"><?php echo $row2['qs_name']; ?></td>

                        <td class="text-center"><?php echo $effective_date_qs; ?></td>
                        <td class="text-center"><?php echo $cancellation_date;   ?></td>



                    </tr>
                <?php 
                }
            }
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
    // Create date inputs
    
 
    // DataTables initialisation
    var table = $('#example').DataTable( {
        processing : true,
        staveSave: true,
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        columnDefs: [
            {
                targets: 6,
                render: DataTable.render.datetime('d MMM yyyy'),
            },
        ]
    } );
    $('#example tbody').on('click', 'tr', function () {
        $('#example tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

    });
        var data = table.row(this).data();
        var code = data[0];
        NewTab(code);
        
    });
   
    function NewTab(code) {
        window.open('../V/see_detail_masterlist.php?id=' +code, '_blank');
        }
});
</script>




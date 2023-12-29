<?php

session_start();
require_once '../M/connectDB.php';
if (!isset($_SESSION['superuser_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: ../index.php');
}
$id = $_GET['updateid'];

include '../M/connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="superuser_page.php">
                <img src="../img/sungroup.png" alt="" width="120" height="40" class="m-1 d-inline-block align-text-top">
            </a>
            <div class="navbar" id="">
                <a href="../C/alert_logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['superuser_login'])) {
            $user_id = $_SESSION['superuser_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        if (isset($_GET['updateid'])) {
            $sql = "SELECT * FROM request WHERE id = $id";
            $sql_run = mysqli_query($con, $sql);
            $row2 = mysqli_fetch_assoc($sql_run);
            //print_r($row2);

        }
        ?>
        <form method="POST" action="../C/approved.php?id=<?php echo $row2['id']; ?>" enctype="multipart/form-data" class="row">
            <div class="row mt-2 mb-2">
                <legend class="">ผู้ขอดำเนินการ</legend>
                <fieldset class="border rounded p-3 row">
                    <div class="col-md-4">
                        <label for="name1" class="form-label">ชื่อ-นามสกุล</label>
                        <input disabled required value="<?php echo $row2['name1']; ?>" type="text" name="name1" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">รหัสพนักงาน</label>
                        <input disabled required placeholder="000000" value="<?php echo $row2['employee_id']; ?>" type="text" maxlength="6" pattern="[0-9]+" name="employee_id" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="degree">ระดับ</label>

                        <input disabled required value="<?php echo $row2['degree']; ?>" type="text" name="degree" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="in_doc" class="form-label">เอกสารในระบบ</label>
                        <input disabled required type="text" value="<?php echo $row2['indoc']; ?>" name="in_doc" class="form-control">
                    </div>

                    <?php
                    $sub_id = $row2['sub_id'];
                    $sql2 = "SELECT * FROM sub_request_member WHERE id_requuest = '$sub_id'";
                    $sql_run2 = mysqli_query($con, $sql2);
                    while ($row3 = mysqli_fetch_assoc($sql_run2)) { ?>
                        <div class=" mt-2 col-md-4">
                            <label for="name2" class="form-label">ชื่อ-นามสกุล</label>
                            <input disabled required value="<?php echo $row3['name2']; ?>" type="text" name="name2" class="form-control">
                        </div>
                        <div class="mt-2 col-md-2">
                            <label for="employee_id2" class="form-label">รหัสพนักงาน</label>
                            <input disabled required placeholder="000000" value="<?php echo $row3['employee_id2']; ?>" type="text" maxlength="6" pattern="[0-9]+" name="employee_id2" class="form-control">
                        </div>
                        <div class="mt-2 col-md-2">
                            <label class="form-label" for="degree2">ระดับ</label>
                            <input disabled required value="<?php echo $row3['degree2']; ?>" type="text" name="degree2" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label hidden for="in_doc" class="form-label">เอกสารในระบบ</label>
                            <input disabled required type="hidden" value="<?php echo $row2['indoc']; ?>" name="in_doc" class="form-control">
                        </div>

                    <?php } ?>

            </div>


            </fieldset>



            <div class="row mt-2">
                <legend class="">แบบฟอร์มขอดำเนินการเรื่องเอกสาร</legend>
                <fieldset class="border rounded p-3 row">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="document_number" class="form-label">หมายเลขเอกสาร</label>
                            <input disabled value="<?php echo $row2['document_number']; ?>" required type="text" name="document_number" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="document_name" class="form-label">ชื่องาน</label>
                            <input disabled value="<?php echo $row2['document_name']; ?>" required type="text" name="document_name" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="effective_date" class="form-label">Effective date:</label>
                            <input disabled value="<?php echo $row2['effective_date']; ?>" type="text" name="effective_date" class="form-control">
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-md-4">
                            <label for="" class="form-label">ขอดำเนินการ</label>
                            <input disabled value="<?php echo $row2['request']; ?>" type="text" name="request" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="" class="form-label">สาเหตุ</label>
                            <input disabled required value="<?php echo $row2['cause']; ?>" type="text" name="cause" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="">หน้าที่แก้ไข</label>
                            <input disabled required value="<?php echo $row2['page_edit']; ?>" type="text" name="page_edit" class="form-control">
                        </div>
                    </div>
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="content3 mt-4">
                        <div class="col-md-12">
                            <label for="" class="form-label">รายละเอียดการแก้ไข</label>
                            <input disabled value="<?php echo $row2['information_edit']; ?>" type="text" name="information_edit" id="information_edit" class="form-control">
                        </div>
                    </div>
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="row content4 mt-4">
                        <div class="col-md-4 mt-1">
                            <label for="" class="form-label">QWP/QWI/SD ที่เกี่ยวข้อง</label>
                            <input disabled value="<?php echo $row2['about_edit']; ?>" type="text" name="about_edit" id="about_edit" class="form-control">
                        </div>

                        <div class="col-md-4 mt-1">
                            <label for="" class="form-label">เอกสารแนบ</label>
                            <a class="form-control" href="../C/dowload.php?file=<?php echo $row2['file_name_upload']; ?>"><?php echo $row2['file_name_upload']; ?></a>
                        </div>

                        <?php
                        $sql3 = "SELECT * FROM sub_request_file WHERE id_request = '$sub_id'";
                        $sql_run3 = mysqli_query($con, $sql3);
                        while ($row5 = mysqli_fetch_assoc($sql_run3)) {
                        ?>
                            <div class="col-md-4 mt-1">
                                <label for="" class="form-label">เอกสารแนบ</label>
                                <a class="form-control" href="../C/dowload.php?file=<?php echo $row5['file_name']; ?>"><?php echo $row5['file_name']; ?></a>
                            </div>
                    </div>

                <?php } ?>
            </div>

            <div class="mt-2 form-group">

            </div>


            </fieldset>
            <div class="row mt-2 mb-2">
                <legend class="">ผู้อนุมัติ</legend>
                <fieldset class="border rounded p-3 row">
                    <div class="col-md-4">
                        <label for="approved_name" class="form-label">ชื่อ-นามสกุล</label>
                        <input required value="" type="text" name="approved_name" class="form-control">
                    </div>

                    <!-- <?php
                            //$query = "SELECT * FROM super_degree ORDER BY number_degree ASC";
                            //$run_sql = mysqli_query($con,$query);

                            ?>
                        <div class="col-md-2">
                            <label class="form-label" for="degree">ระดับ</label>
                            <select class=" form-select " name="approved_degree" id="approved_degree" required>
                                <option value="">--โปรดเลือก--</option>
                                <?php
                                //while($row4 = mysqli_fetch_assoc($run_sql)){
                                ?>
                                <option value="<?php //echo $row4['degree'] 
                                                ?>"><?php //echo $row4['degree'] 
                                                                                ?></option>
                                <?php //}
                                ?>
                            </select>
                        </div> -->
                </fieldset>
            </div>
            <div class="mb-5 form-group text-center" id="approve">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_insert" class=" fw-bold btn btn-success" value="อนุมัติ">
                    <a onclick="return myConfirm(<?php echo $id ?>);" class="  btn btn-danger ">ไม่อนุมัติ</a>

                    <!-- <button type="button" class="btn btn-warning position-relative " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            ส่งกลับแก้ไข
                            <span class="visually-hidden">unread messages</span>
                            </span>
                        </button> -->
                    <!-- <a  href="../C//edit_request.php" class=" btn btn-warning">ส่งกลับแก้ไข</a> -->
                    <a href="../V/superuser_page.php" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
    </div>
    </form>
    </div>
</body>

</html>
<form method="POST" action="../C/edit_request.php?id=<?php echo $id ?>">
    <div class="modal modal-lg modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ระบุสาเหตุการแก้ไข</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="cause_edit" name="cause_edit" required></textarea>
                        <label for="cause_edit">สาเหตุ</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button> -->
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">

                </div>
            </div>
        </div>
    </div>
</form>


<script>
    // function myConfirm() {
    //     var result = confirm("ส่งกลับแก้ไข ใช่ หรือ ไม่?");
    //     if (result == true) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    function myConfirm(id) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'ต้องการ REJECT คำขอนี้หรือไม่',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                window.location.href = `../C/reject_request.php?id=${id}`

            } else {

            }
        })
    }
</script>
<script>

</script>
<?php mysqli_close($con);       ?>
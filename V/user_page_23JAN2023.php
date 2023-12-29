<?php

session_start();
require_once '../M/connectDB.php';
if (!isset($_SESSION['user_login'])) {
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
    <title>User Page</title>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a href="../uploads_qs/folder_depart.php" class="navbar-brand">
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
        if (isset($_SESSION['user_login'])) {
            $user_id = $_SESSION['user_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        ?>

        <form method="POST" action="../C/add.php" enctype="multipart/form-data" class="row">
            <div class="row mt-2 mb-2">
                <legend class="">ผู้ขอดำเนินการ</legend>
                <div class="text-center">
                    <a name="add-more-form " href="javascript:void(0)" class="btn btn-link text-dark add-more-form float-end border mt-2 mb-2 col-md-2 center ">เพิ่มสมาชิก(สูงสุด 2คน)</a>
                </div>

                <fieldset class="border rounded p-3 row">
                    <div class="col-md-4">
                        <label for="name1" class="form-label">ชื่อ-นามสกุล</label>
                        <input required type="text" name="name1" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">รหัสพนักงาน</label>
                        <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" required placeholder="000000" type="text" maxlength="6" pattern="[0-9]+" name="employee_id" class="form-control">
                    </div>

                    <?php 
                    //$query = "SELECT * from user_degree ORDER BY number_degree ASC";
                    //$run_query = mysqli_query($con,$query);

                    ?>
                    <div class="col-md-2">
                        <label class="form-label" for="degree">ระดับ</label>
                        <select class=" form-select " name="degree" id="degree" required>
                            <option value="">--โปรดเลือก--</option>
                            <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                            <option value="ผจก.แผนก">ผจก.แผนก</option>
                            <option value="ผจก.ส่วน">ผจก.ส่วน</option>
                            <option value="ผจก.ฝ่าย">ผจก.ฝ่าย</option>\                              
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="in_doc" class="form-label">เอกสารในระบบ</label>
                        <input required type="text" name="in_doc" class="form-control">
                    </div>
                    <div class="paste-new-forms"></div>

                </fieldset>
            </div>


            <div class="row mt-2">
                <legend class="">แบบฟอร์มขอดำเนินการเรื่องเอกสาร</legend>
                <fieldset class="border rounded p-3 row">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="document_number" class="form-label">หมายเลขเอกสาร</label>
                            <input required type="text" name="document_number" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="document_name" class="form-label">ชื่องาน</label>
                            <input required type="text" name="document_name" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="effective_date" class="form-label">Effective date:</label>
                            <input type="date" name="effective_date" class="form-control">
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col form-check form-check-inline">
                            <input required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio1" value="ขึ้นทะเบียน">
                            <label class="radio_wrap form-check-label" for="inlineRadio1">ขึ้นทะเบียน</label>
                        </div>
                        <div class=" col form-check form-check-inline">
                            <input required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio2" value="แก้ไข">
                            <label class="radio_wrap form-check-label" for="inlineRadio2">แก้ไข</label>
                        </div>
                        <div class=" col form-check form-check-inline">
                            <input required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio3" value="ยกเลิก">
                            <label class="radio_wrap form-check-label" for="inlineRadio3">ยกเลิก</label>
                        </div>
                        <div class=" col form-check form-check-inline">
                            <input required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio4" value="ทบทวน">
                            <label class="radio_wrap form-check-label" for="inlineRadio4">ทบทวน</label>
                        </div>
                    </div>
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="content  mt-2">
                        <div>
                            <b><label class="mt-2 form-check-label">สาเหตุ</label></b>
                        </div>
                        <div class="col-md-2 mt-1">
                            <select class=" form-select " name="cause" id="cause">
                                <option value="">--โปรดเลือก--</option>
                                <option value="Complaint/CAR">Complaint/CAR</option>
                                <option value="QCC">QCC</option>
                                <option value="Audit WI">Audit WI</option>
                                <option value="เปลี่ยนวิธีทำงาน">เปลี่ยนวิธีทำงาน</option>
                            </select>
                        </div>
                    </div>

                    <div class="content2  mt-2">
                        <div class="col-md-2">
                            <label for="" class="form-label">หน้าที่แก้ไข</label>
                            <input type="text" name="page_edit" id="page_edit" class="form-control">
                        </div>
                    </div>

                    <div class="content3 mt-2 ">
                        <div class="col-xl-12  input-group-lg">
                            <label for="" class="form-label">รายละเอียดการแก้ไข</label>
                            <input value="-" type="text" name="information_edit" id="information_edit" class="form-control">
                        </div>
                    </div>
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="row content4 mt-2">
                        <div class="col-md-4 mt-1">
                            <label for="" class="form-label">QWP/QWI/SD ที่เกี่ยวข้อง</label>
                            <input value="" type="text" name="about_edit" id="about_edit" class="form-control">
                        </div>
                        <div class="col-md-4 mt-1">
                            <label for="" class="form-label">เลือกไฟล์ที่ต้องการอัปโหลด</label>
                            <input required accept=".pdf,.xls,.xlsx,.doc,.docx" type="file" class="form-control" name="file_name_upload">
                        </div>
                        <div class=" col-md-3 mt-4 ">
                        <a name="add-more-upload-form " href="javascript:void(0)" class="btn btn-link rounded-circle  add-more-upload-form ">
                        <iconify-icon icon="material-symbols:add-circle-rounded" width="40" height="40"></iconify-icon>

                        </a>
                </div>
                        <div class="paste-new-upload-forms"></div>

                    </div>


                    <div class="mt-2 form-group">

                    </div>

                </fieldset>
                <div class="mb-5 form-group text-center">
                    <div class="col-md-12 mt-3">
                        <input type="submit" name="btn_insert" class="btn btn-success" value="ส่งคำขอ">
                        <a href="../uploads_qs/folder_depart.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </form>


    </div>
</body>

</html>

<script>
    $(".content").hide()
    $(".content2").hide()
    $(".content3").hide()
    $(document).ready(function() {
        $("#inlineRadio4").change(function() {
            $(".content").hide()
            $(".content2").hide()
            $(".content3").hide()
            $('#page_edit').prop('required', false);
            $('#cause').prop('required', false);
            $('#information_edit').prop('required', false);
        });
        $("#inlineRadio3").click(function() {
            if (this.checked) {
                $('#cause').prop('required', true);
                $('#information_edit').prop('required', true);
            } else {
                $('#cause').prop('required', false);
                $('#information_edit').prop('required', false);
            }
            $(".content").show()
            $(".content2").hide()
            $(".content3").show()
        });
        $("#inlineRadio2").click(function() {
            if (this.checked) {
                $('#cause').prop('required', true);
                $('#page_edit').prop('required', true);
                $('#information_edit').prop('required', true);
            } else {
                $('#cause').prop('required', false);
                $('#page_edit').prop('required', false);
                $('#information_edit').prop('required', false);
            }
            $(".content").show()
            $(".content2").show()
            $(".content3").show()
        });
        $("#inlineRadio1").click(function() {
            if (this.checked) {
                $('#cause').prop('required', true);
                $('#information_edit').prop('required', true);
                $('#about_edit').prop('required', true);
            } else {
                $('#cause').prop('required', false);
                $('#information_edit').prop('required', false);
                $('#about_edit').prop('required', false);

            }
            $(".content").show()
            $(".content2").hide()
            $(".content3").show()
        });

    });

    function myFunction() {
        document.getElementById('cause').value = '';
        document.getElementById('page_edit').value = '';
        document.getElementById('information_edit').value = '';
    }
    var count2 = 0;

    $(document).on('click', '.add-more-upload-form', function() {
        count2++;
            $('.paste-new-upload-forms').append('<div class="upload-form">\
            <div class="row">\
            <div class="col-md-4">\
            </div>\
             <div class="col-md-4 mt-4">\
                            <input required accept=".pdf,.xls,.xlsx,.doc,.docx" type="file" class="form-control" name="file_name_upload2">\
                        </div>\
                        <div class="col-md-2 mt-4">\
                                        <button type="button" class="form-control remove-upload-btn btn btn-danger">Remove</button>\
                                    </div>\
                                    </div>\
                                    </div>');
        if (count2 == 1) {
            $(".add-more-upload-form").hide()
            return;
        }

        console.log(count);

    });
    $(document).on('click', '.remove-upload-btn', function() {
        $(this).closest('.upload-form').remove();
        $(".add-more-upload-form").show()
        count2--;
    });


    var count = 0;

$(document).on('click', '.add-more-form', function() {
    count++;
        $('.paste-new-forms').append('<div class="main-form mt-3 mb-2">\
                            <div class="row">\
                            <div class="col-md-4">\
                    <label for="name1" class="form-label">ชื่อ-นามสกุล</label>\
                    <input required type="text" name="name2[]" class="form-control">\
                </div>\
                <div class="col-md-2">\
                    <label for="" class="form-label">รหัสพนักงาน</label>\
                    <input   required placeholder="000000" type="text" maxlength="6" pattern="[0-9]+" name="employee_id2[]" class="form-control">\
                </div>\
                <div class="col-md-2">\
                    <label class="form-label" for="degree">ระดับ</label>\
                    <select class=" form-select " name="degree2[]" id="degree" required>\
                        <option value="">--โปรดเลือก--</option>\
                        <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>\
                        <option value="ผจก.แผนก">ผจก.แผนก</option>\
                        <option value="ผจก.ส่วน">ผจก.ส่วน</option>\
                        <option value="ผจก.ฝ่าย">ผจก.ฝ่าย</option>\
                    </select>\
                </div>\
                                    <div class="col-md-2">\
                                        <label  class="form-label text-white" for="">666</label>\
                                        <button type="button" class="form-control remove-btn btn btn-danger">Remove</button>\
                                    </div>\
                            </div>\
                        </div>');
    if (count == 2) {
        $(".add-more-form").hide()
        return;
    }

    console.log(count);

});
$(document).on('click', '.remove-btn', function() {
    $(this).closest('.main-form').remove();
    $(".add-more-form").show()
    count--;
});







    function deleteItems() {
        localStorage.clear();
    }
</script>
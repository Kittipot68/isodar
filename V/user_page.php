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
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="55">55</option>
                            <option value="65">65</option>
                            <option value="75">75</option>

                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="in_doc" class="form-label">เอกสารในระบบ</label>
                        <select class=" form-select " name="in_doc" id="in_doc" required>
                            <option value="">--โปรดเลือก--</option>
                            <option value="BRC เอกสาร">BRC เอกสาร</option>
                            <option value="FOOD SAFETY">FOOD SAFETY</option>
                            <option value="QUALITY">QUALITY</option>
                            <option value="ISO17025">ISO 17025</option>
                            <option value="GHP HACCP">GHP HACCP</option>
                            <option value="ISO 14001">ISO 14001</option>
                            <option value="SUN FEED">SUN FEED</option>
                            <option value="SUN FARM">SUN FARM</option>
                            


                        </select>
                    </div>
                    <div class="paste-new-forms"></div>

                </fieldset>
            </div>


            <div class="row mt-2">
                <legend class="">แบบฟอร์มขอดำเนินการเรื่องเอกสาร</legend>
                <fieldset class="border rounded p-3 row">
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
                        
                    </div>
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="content  mt-2 row"> <!---ขึ้นทะเบียน------>
                    <div class="col-md-5">
                            <label for="document_name" class="form-label">ชื่องาน</label>
                            <input id="document_name"  type="text" name="document_name" class="form-control">
                            <b><span style="color:red;" class="form-label">* ต้องกรอก ชื่องาน</span></b>

                        </div>
                        <div class="col-xl-12 mt-2  ">
                            <label  for="" class="form-label">รายละเอียดการขึ้นทะเบียน</label>
                            <textarea   name="information_edit" rows="10" id="information_edit" class="form-control" placeholder="* กรอกหรือไม่กรอกก็ได้"></textarea>
                        </div>
                        <div  class="col-md-4 mt-4">
                            <label for="" class="form-label">QWP/QWI/SD/Reference ที่เกี่ยวข้อง</label>
                            <textarea     name="about_edit" id="about_edit" class="form-control"></textarea>
                            <b> <span style="color:red;" class="form-label">* ต้องกรอก QWP/QWI/SD/Reference ที่เกี่ยวข้อง</span></b>

                        </div>
                   
                    </div>

                    <!---ขึ้นทะเบียน---------------------------------------------------------------------------------------------->

                    <div class="content2  mt-2 row"> <!---แก้ไข------>
                    <div class="col-md-5">
                            <label for="document_name" class="form-label">ชื่องาน</label>
                            <input id="document_name2"  type="text"  name="document_name" class="form-control">
                            <b><span style="color:red;" class="form-label">* ต้องกรอก ชื่องาน</span></b>
                        </div>
                    <div  class="col-md-4 ">
                            <label for="document_number" class="form-label">หมายเลขเอกสาร</label>
                            <input id="document_number2"  type="text" name="document_number" class="form-control">
                            <b><span style="color:red;" class="form-label">* ต้องกรอก หมายเลขเอกสาร</span></b>

                        </div>
                        <div class="col-md-3">
                            <label for="effective_date" class="form-label">Effective date:</label>
                            <input type="date" id="effective_date2" name="effective_date" class="form-control" min="<?= date('Y-m-d', strtotime("+1 day")); ?>">
                            <b><span style="color:red;" class="form-label">* กรอกหรือไม่หรอกก็ได้</span></b>

                        </div>
                        <div class="col-md-4 mt-4">
                            <label class=" form-label">สาเหตุในการแก้ไข</label>
                            <select class=" form-select " name="cause" id="cause2">
                                <option value="">--โปรดเลือก--</option>
                                <option value="Complaint/CAR">Complaint/CAR</option>
                                <option value="QCC">QCC</option>
                                <option value="Audit WI">Audit WI</option>
                                <option value="เปลี่ยนวิธีทำงาน">เปลี่ยนวิธีทำงาน</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="" class="form-label">สาเหตุในการแก้ไข อื่นๆ</label>
                            <textarea  name="cause_other" id="cause_other2" class="form-control"></textarea>
                            <b><span style="color:red;" class="form-label">* กรอกสาเหตุอื่นๆในการแก้ไข เมื่อในช่องสาเหตุไม่มีให้เลือก</span></b>
                        </div>

                        <div class="col-md-2 mt-4">
                            <label for="" class="form-label">หน้าที่แก้ไข</label>
                            <input type="text" name="page_edit" id="page_edit2" class="form-control">
                            <b><span style="color:red;" class="form-label">* ต้องกรอกหน้าที่แก้ไข เช่น 1-2</span></b>

                        </div>

                        <div class="col-xl-12 mt-4">
                            <label for="" class="form-label">รายละเอียดการแก้ไข</label>
                            <textarea name="information_edit" rows="10" id="information_edit2" placeholder="ต้องกรอกรายละเอียดสำหรับการแก้ไข" class="form-control"></textarea>
                        </div>

                       
                    </div>


                    <div class="row content3 mt-2">
                    <div class="col-md-5">
                            <label for="document_name" class="form-label">ชื่องาน</label>
                            <input  type="text" id="document_name3"  name="document_name" class="form-control">
                            <b><span style="color:red;" class="form-label">* ต้องกรอก ชื่องาน</span></b>
                        </div>
                    <div  class="col-md-4 ">
                            <label for="document_number" class="form-label">หมายเลขเอกสาร</label>
                            <input  type="text" id="document_number3" name="document_number" class="form-control">
                            <b><span style="color:red;" class="form-label">* ต้องกรอก หมายเลขเอกสาร</span></b>

                        </div>
                        <div class="col-md-3">
                            <label for="effective_date" class="form-label">Effective date:</label>
                            <input type="date" id="effective_date3" name="effective_date" class="form-control" min="<?= date('Y-m-d', strtotime("+1 day")); ?>">
                            <b><span style="color:red;" class="form-label">* กรอกหรือไม่หรอกก็ได้</span></b>

                        </div>

                        <div class="col-md-4 mt-4">
                            <label class=" form-label">สาเหตุในการยกเลิก</label>
                            <select class=" form-select " name="cause" id="cause3">
                                <option value="">--โปรดเลือก--</option>
                                <option value="Complaint/CAR">Complaint/CAR</option>
                                <option value="QCC">QCC</option>
                                <option value="Audit WI">Audit WI</option>
                                <option value="เปลี่ยนวิธีทำงาน">เปลี่ยนวิธีทำงาน</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="" class="form-label">สาเหตุในการยกเลิกอื่นๆ</label>
                            <textarea  name="cause_other" id="cause_other3" class="form-control"></textarea>
                            <b><span style="color:red;" class="form-label">* กรอกสาเหตุอื่นๆในการยกเลิก เมื่อในช่องสาเหตุไม่มีให้เลือก</span></b>
                        </div>

                        <div class="col-xl-12 mt-4">
                            <label for="" class="form-label">รายละเอียดในการยกเลิก</label>
                            <textarea placeholder="* กรอกหรือไม่กรอกก็ได้"  name="information_edit" rows="10" id="information_edit3" class="form-control"></textarea>
                        </div>
                      

                    </div>



                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="row content4 mt-2" id="upload_div">
                        
                        <div class="col-md-4 mt-1">
                            <label for="" class="form-label">เลือกไฟล์ที่ต้องการอัปโหลด</label>
                            <input id="file_name_upload"   type="file" class="form-control" name="file_name_upload">
                        </div>
                        <div class=" col-md-3 mt-4 ">
                        <a name="add-more-upload-form " href="javascript:void(0)" class="btn btn-link rounded-circle  add-more-upload-form ">
                        <iconify-icon icon="material-symbols:add-circle-rounded" width="40" height="40"></iconify-icon>

                        </a>
                </div>
                        <div class="paste-new-upload-forms"></div>

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
        $("#inlineRadio3").click(function() {

$(".content3").show()

            $('#document_name3').prop('required', true);
            $('#document_number3').prop('required', true);
           
            $(".content").hide()
            $(".content2").hide()
            $("#upload_div").hide()
            $('#file_name_upload').prop('required', false);
            $('#page_edit').prop('required', false);
            $('#about_edit').prop('required', false);
            $('#file_name_upload').prop('required', false);
            $('#file_name_upload2').prop('required', false);
            $('#page_edit2').prop('required', false);
            $('#about_edit2').prop('required', false);

            $("#information_edit3").val("");
            $("#about_edit3").val("");
            $("#cause_other3").val("");
            $("#document_name3").val("");
            $("#document_number3").val("");
            $("#cause3").val("");
            $("#page_edit3").val("");
            $("#information_edit3").val("");
            $("#effective_date3").val("");

            $("#information_edit2").val("");
            $("#about_edit2").val("");
            $("#cause_other2").val("");
            $("#document_name2").val("");
            $("#document_number2").val("");
            $("#cause2").val("");
            $("#page_edit2").val("");
            $("#information_edit2").val("");
            $("#effective_date2").val("");

            $("#information_edit").val("");
            $("#about_edit").val("");
            $("#cause_other").val("");
            $("#document_name").val("");
            $("#document_number").val("");
            $("#cause").val("");
            $("#page_edit").val("");
            $("#information_edit").val("");
            $("#effective_date").val("");

            $("#file_name_upload").val("");
            $("#file_name_upload2").val("");
        });
        $("#inlineRadio2").click(function() {
            $('#document_name2').prop('required', true);
            $('#document_number2').prop('required', true);
            $('#page_edit2').prop('required', true);
            $('#information_edit2').prop('required', true);

            $('#file_name_upload').prop('required', true);
            
            

            $("#upload_div").show()
            $('#document_name3').prop('required', false);
            $('#document_number3').prop('required', false);
            $('#document_name').prop('required', false);
            $('#about_edit').prop('required', false);
            $(".content2").show()
            $(".content").hide()
            $(".content3").hide()
            
            $("#information_edit3").val("");
            $("#about_edit3").val("");
            $("#cause_other3").val("");
            $("#document_name3").val("");
            $("#document_number3").val("");
            $("#cause3").val("");
            $("#page_edit3").val("");
            $("#information_edit3").val("");
            $("#effective_date3").val("");

            $("#information_edit2").val("");
            $("#about_edit2").val("");
            $("#cause_other2").val("");
            $("#document_name2").val("");
            $("#document_number2").val("");
            $("#cause2").val("");
            $("#page_edit2").val("");
            $("#information_edit2").val("");
            $("#effective_date2").val("");

            $("#information_edit").val("");
            $("#about_edit").val("");
            $("#cause_other").val("");
            $("#document_name").val("");
            $("#document_number").val("");
            $("#cause").val("");
            $("#page_edit").val("");
            $("#information_edit").val("");
            $("#effective_date").val("");

            $("#file_name_upload").val("");
            $("#file_name_upload2").val("");


        });
        $("#inlineRadio1").click(function() {
         
            $(".content").show()
            $("#upload_div").show()

            $('#document_name').prop('required', true);
            $('#about_edit').prop('required', true);
            $('#file_name_upload').prop('required', true);

            $(".content2").hide()
            $(".content3").hide()

            $('#document_number').prop('required', false);
            $('#page_edit').prop('required', false);
            $('#document_name2').prop('required', false);
            $('#document_number2').prop('required', false);
            $('#page_edit2').prop('required', false);
            $('#document_name3').prop('required', false);
            $('#document_number3').prop('required', false);
            
            $("#information_edit3").val("");
            $("#about_edit3").val("");
            $("#cause_other3").val("");
            $("#document_name3").val("");
            $("#document_number3").val("");
            $("#cause3").val("");
            $("#page_edit3").val("");
            $("#information_edit3").val("");
            $("#effective_date3").val("");

            $("#information_edit2").val("");
            $("#about_edit2").val("");
            $("#cause_other2").val("");
            $("#document_name2").val("");
            $("#document_number2").val("");
            $("#cause2").val("");
            $("#page_edit2").val("");
            $("#information_edit2").val("");
            $("#effective_date2").val("");

            $("#information_edit").val("");
            $("#about_edit").val("");
            $("#cause_other").val("");
            $("#document_name").val("");
            $("#document_number").val("");
            $("#cause").val("");
            $("#page_edit").val("");
            $("#information_edit").val("");
            $("#effective_date").val("");

            $("#file_name_upload").val("");
            $("#file_name_upload2").val("");





        });

    });

    function myFunction() {
        

  



        
    }
    var count2 = 0;

    $(document).on('click', '.add-more-upload-form', function() {
        count2++;
            $('.paste-new-upload-forms').append('<div class="upload-form">\
            <div class="row">\
             <div class="col-md-4 mt-4">\
                            <input required  type="file" class="form-control" id="file_name_upload2" name="file_name_upload2">\
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
                        <option value="30">30</option>\
                            <option value="40">40</option>\
                            <option value="55">55</option>\
                            <option value="65">65</option>\
                            <option value="75">75</option>\
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
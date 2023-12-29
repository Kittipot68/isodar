<?php 

    session_start();
    require_once '../M/connectDB.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../index.php');
    }

 
$id = $_GET['updateid'];
include "../M/connect.php";

?>


<?php 

 if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="#">
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
            if (isset($_GET['updateid']))
            {   
                $sql = "SELECT * FROM request WHERE id = $id";
                $sql_run = mysqli_query($con,$sql);
                $row2 = mysqli_fetch_assoc($sql_run);
                
                //print_r($row2);
            }
        ?>
        
        <form method="POST" action="../C/userupdate_edit.php?id=<?php echo $row2['id'];?>" enctype="multipart/form-data" class="row">
            <div class="row mt-2 mb-2">
            <legend class="">ผู้ขอดำเนินการ</legend>
                <fieldset  class="border rounded p-3 row">
                <div class="col-md-4">
                        <label for="name1" class="form-label">ชื่อ-นามสกุล</label>
                        <input  required value="<?php echo $row2['name1'];?>" type="text" name="name1" class="form-control">
                </div>
                <div class="col-md-2">
                        <label for="" class="form-label">รหัสพนักงาน</label>
                        <input  required placeholder="000000" value="<?php echo $row2['employee_id'];?>"  type="text" maxlength="6" pattern="[0-9]+" name="employee_id" class="form-control">
                </div>
                <div class="col-md-3">
                        <label for="in_doc" class="form-label">เอกสารในระบบ</label>
                        <input  required type="text"  value="<?php echo $row2['indoc'];?>"name="in_doc" class="form-control">
                </div>

                <?php 
                    $query = "SELECT * from user_degree ORDER BY number_degree ASC";
                    $run_query2 = mysqli_query($con,$query);

                    ?>
                    <div class="col-md-2">
                        <label class="form-label" for="degree">ระดับ</label>
                        <select class=" form-select " name="degree" id="degree" required>
                            <option value="">--โปรดเลือก--</option>
                            <?php 
                            while($row5 = mysqli_fetch_assoc($run_query2)){
                            ?>
                                <option <?php if ($row2['degree'] == $row5['degree'] ) echo "selected";?>   value="<?php echo $row5['degree']?>"><?php echo $row5['degree'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                <?php
                     $sql2 = "SELECT * FROM sub_request_member WHERE id_requuest = $id";
                     $sql_run2 = mysqli_query($con,$sql2);

                    while($row3 = mysqli_fetch_assoc($sql_run2)){?>
                    <div class=" mt-2 col-md-4">
                        <label for="name2" class="form-label">ชื่อ-นามสกุล</label>
                        <input disabled required value="<?php echo $row3['name2']; ?>" type="text" name="name2" class="form-control">
                    </div>
                    <div class="mt-2 col-md-2">
                        <label for="employee_id2" class="form-label">รหัสพนักงาน</label>
                        <input disabled required placeholder="000000" value="<?php echo $row3['employee_id2']; ?>" type="text" maxlength="6" pattern="[0-9]+" name="employee_id2" class="form-control">
                    </div>
                    <?php 
                    $query = "SELECT * from user_degree ORDER BY number_degree ASC";
                    $run_query = mysqli_query($con,$query);

                    ?>
                    <div class="col-md-2">
                        <label class="form-label" for="degree2">ระดับ</label>
                        <select class=" form-select " name="degree2" id="degree2" required>
                            <option value="">--โปรดเลือก--</option>
                            <?php 
                            while($row4 = mysqli_fetch_assoc($run_query)){
                            ?>
                                <option <?php if ($row3['degree2'] == $row4['degree'] ) echo "selected";?>   value="<?php echo $row4['degree']?>"><?php echo $row4['degree'] ?></option>
                           <?php }
                           
                            ?>
                        </select>
                    <div class="col-md-3">
                        <label hidden for="in_doc" class="form-label">เอกสารในระบบ</label>
                        <input disabled required type="hidden" value="<?php echo $row2['indoc']; ?>" name="in_doc" class="form-control">
                    </div>

                    <?php } ?>
                
                </fieldset>
            </div>
            
            
                <div class="row mt-2">
                <legend class="">แบบฟอร์มขอดำเนินการเรื่องเอกสาร</legend>
                <fieldset class="border rounded p-3 row">
                    <div class="row">
                        <div class="col-md-4">
                                <label  for="document_number" class="form-label">หมายเลขเอกสาร</label>
                                <input value="<?php echo $row2['document_number'];?>"   required type="text" name="document_number" class="form-control">
                        </div>
                        <div class="col-md-5">
                                <label  for="document_name" class="form-label">ชื่องาน</label>
                                <input  value="<?php echo $row2['document_name'];?>" required type="text" name="document_name" class="form-control">
                        </div> 
                        <div class="col-md-2">
                                <label for="effective_date" class="form-label">Effective date:</label>
                                <input  value="<?php echo $row2['effective_date'];?>" type="date"  name="effective_date" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3 row">
                <div class="mt-2">
                        <div class="col form-check form-check-inline">
                                <input <?php if ($row2['request'] == "ขึ้นทะเบียน" ) echo "checked";?>  required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio1" value="ขึ้นทะเบียน">
                                <label class="radio_wrap form-check-label" for="inlineRadio1">ขึ้นทะเบียน</label>
                        </div>
                        <div class=" col form-check form-check-inline">
                                <input <?php if ($row2['request'] == "แก้ไข" ) echo "checked";?>  required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio2" value="แก้ไข">
                                <label class="radio_wrap form-check-label" for="inlineRadio2">แก้ไข</label>
                        </div>
                        <div class=" col form-check form-check-inline">
                                <input <?php if ($row2['request'] == "ยกเลิก" ) echo "checked";?>  required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio3" value="ยกเลิก">
                                <label class="radio_wrap form-check-label" for="inlineRadio3">ยกเลิก</label>
                        </div>
                        <div class=" col form-check form-check-inline">
                                <input <?php if ($row2['request'] == "ทบทวน" ) echo "checked";?>  required onclick="myFunction();" class="form-check-input" type="radio" name="request" id="inlineRadio4" value="ทบทวน">
                                <label class="radio_wrap form-check-label" for="inlineRadio4">ทบทวน</label>
                        </div>
                    </div>
                       
                    </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="content mt-3 row">
                        <div  class="col-md-2">
                        <label class=" form-label" >สาเหตุ</label>
                                  <select    class=" form-select " name="cause" id="cause">
                                  <option value="">--โปรดเลือก--</option>
                                  <option <?php if ($row2['cause'] == "Complaint/Car" ) echo "selected";?> value="Complaint/Car">Complaint/Car</option>
                                  <option <?php if ($row2['cause'] == "QCC" ) echo "selected";?> value="QCC">QCC</option>
                                  <option <?php if ($row2['cause'] == "Audit WI" ) echo "selected";?> value="Audit WI">Audit WI</option>
                                  <option <?php if ($row2['cause'] == "เปลี่ยนวิธีทำงาน" ) echo "selected";?> value="เปลี่ยนวิธีทำงาน">เปลี่ยนวิธีทำงาน</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label">หน้าที่แก้ไข</label>
                                <input value="<?php echo $row2['page_edit'];?>" type="text" name="page_edit" id="page_edit" class="form-control">
                        </div>
                    </div>

                    <div class="content2  mt-2">
                        
                    </div>

                    <div class="content3 mt-2 ">
                        <div class="col-xl-12  input-group-lg">
                                <label for="" class="form-label">รายละเอียดการแก้ไข</label>
                                <input value="<?php echo $row2['information_edit'];?>"  value="-" type="text" name="information_edit" id="information_edit" class="form-control">
                        </div>
                    </div>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->                    
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->           
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="row content4 mt-4">
                        <div class="col-md-4 mt-1">
                                <label for="" class="form-label">QWP/QWI/SD ที่เกี่ยวข้อง</label>
                                <input  value="<?php echo $row2['about_edit'];?>" type="text" name="about_edit" id="about_edit" class="form-control">
                        </div>
                        <div class="col-md-3 mt-1">
                            <label for="" class="form-label">เอกสารแนบ</label>
                            <a class="form-control" href="../C/dowload.php?file=<?php echo $row2['file_name_upload'];?>"><?php echo $row2['file_name_upload'];?></a>
                        </div>

                        <div class="col-md-5 mt-1">
                            <label for="" class="form-label">อัปโหลดไฟล์ใหม่</label>
                            <input accept=".pdf,.xls,.xlsx,.doc,.docx"  type="file" class="form-control" name="file_name_upload">
                        </div>
                    </div>
                    

                    <div class="mt-2 form-group">
                        
                    </div>
                    

                </fieldset>
               
                    <div class="mb-5 form-group text-center">
                        <div class="col-md-12 mt-3">
                        <input type="submit" name="btn_edit" class="btn btn-warning" value="แก้ไข">
                       
                        <!-- <a  href="../C//edit_request.php" class=" btn btn-warning">ส่งกลับแก้ไข</a> -->
                        <a href="../uploads_qs/folder_depart.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>

               
            </form>
            
           
    </div>
</body>
</html>

<div class="modal modal-lg modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ระบุสาเหตุการแก้ไข</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <div class="form-floating">
            <textarea  class="form-control" placeholder="Leave a comment here" id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">สาเหตุ</label>
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
        <a  href="../C//edit_request.php" class=" btn btn-success">ยืนยัน</a>

      </div>
    </div>
  </div>
</div>

<script>
     function myConfirm() {
  var result = confirm("ส่งกลับแก้ไข ใช่ หรือ ไม่?");
  if (result==true) {
   return true;
  } else {
   return false;
  }
}



 
    $(document).ready(function(){
        $("#inlineRadio4").change(function(){
            $(".content").hide() 
            $(".content2").hide()
            $(".content3").hide()
            $('#page_edit').prop('required', false);
            $('#cause').prop('required', false);
            $('#information_edit').prop('required', false);
        });
        $("#inlineRadio3").click(function(){
            if(this.checked) {
                $('#cause').prop('required', true);
                $('#information_edit').prop('required', true);
            }else {
                $('#cause').prop('required', false);
                $('#information_edit').prop('required', false);
            }
            $(".content").show() 
            $(".content2").hide()
            $(".content3").show() 
        });
        $("#inlineRadio2").click(function(){
            if(this.checked) {
                $('#cause').prop('required', true);
                $('#page_edit').prop('required', true);
                $('#information_edit').prop('required', true);
            }else {
                $('#cause').prop('required', false);
                $('#page_edit').prop('required', false);
                $('#information_edit').prop('required', false);
            }
            $(".content").show() 
            $(".content2").show()
            $(".content3").show() 
        });
        $("#inlineRadio1").click(function(){
            if(this.checked) {
                $('#cause').prop('required', true);
                $('#information_edit').prop('required', true);
            }else {
                $('#cause').prop('required', false);
                $('#information_edit').prop('required', false);
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
</script>

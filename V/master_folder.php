<?php 

    session_start();
    require_once '../M/connectDB.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: ../index.php');
       
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" >

   
</head>
<body>
<?php include('../sidebar.php'); ?>

    <div class="mt-5 container">
        <h1>List Folder</h1>
        <div class="mb-3" align="right">

        <button  type="button" name="create_folder"
        id="create_folder" data-bs-toggle="modal" data-bs-target="#folderModal" class="btn btn-outline-success">Create Folder</button>

        </div>
        <div id="folder_table" class="table-responsive">


        </div>

    </div>

    </div> <!--ปิด sidebar-->

</body>
</html>
<!------------------------------------->
<div id="folderModal" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <span class="modal-title fs-5" id="change_title">Create Folder</span>
                </h4>

                
            </div>

            <div class="modal-body">
                <label for="folder_name" class="form-label">Enter Folder Name</label>
                <input type="text" name="folder_name" id="folder_name"
                class="mt-1 form-control">
                
                <input type="hidden" name="action" id="action"/>
                <input type="hidden" name="old_name" id="old_name"/>
                
            </div>
            <div class="modal-footer">
            <input type="button" name="folder_button" id="folder_button"
                class="btn btn-info" value="Create"/>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!------------------------------------->
<div id="uploadModal" class="modal fade ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <span class="modal-title fs-5" id="change_title">Upload File</span>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                
            </div>
            <form method="POST" id="upload_form" enctype="multipart/form-data">

            <div class="modal-body">
                <p>Select File
                <input accept=".pdf,.xls,.xlsx,.doc,.docx"  type="file" name="upload_file"/></p>
                <input type="hidden" name="hidden_folder_name"
                id="hidden_folder_name"/>
                
                
            </div>
            <div class="modal-footer">
            <input  type="submit" name="upload_button"
                class="btn btn-info" value="Upload"/>  
                </div>                 
                </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
    <!------------------------------------->
<div  id="list_fileModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
            <span class="modal-title fs-5" id="change_title">File Lists</span>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="file_list">
               
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!------------------------------------->
<script>


    $(document).ready(function(){
        load_folder_list();
        function load_folder_list()
        {
            var action = "fetch";
            $.ajax({
                url : "../uploads_qs/action.php",
                method:"POST",
                data:{action:action},
                success:function(data)
                {
                    $('#folder_table').html(data);
                }
            });
        }

        $(document).on('click','#create_folder',function(){
            $('#action').val('create');
            $('#folder_name').val('');
            $('#folder_button').val('Create');
            $('#old_name').val('');
            $('#change_title').text('Create Folder');
            $('#folderModal').modal('show');
        });

        $(document).on('click','#folder_button',function(){
            
            var folder_name = $('#folder_name').val();
            var action = $('#action').val();
            var old_name =$('#old_name').val();
            if(folder_name !=''){
                $.ajax({
                    url:"../uploads_qs/action.php",
                    method:"POST",
                    data:{folder_name:folder_name,
                    old_name:old_name,action:action},
                    success:function(data)
                    {
                        $('#folderModal').modal('hide');
                        load_folder_list();
                        var message = data.substring(0, data.indexOf("<"));
                        alert(message);
                    }
                })
            }
            else
            {
                alert("Enter Folder Name");
            }
        });
        $(document).on('click','.update',function(){
            var folder_name = $(this).data("name");
            $('#old_name').val(folder_name);
            $('#folder_name').val(folder_name);
            $('#action').val("change");
            $('#folder_button').val("Update");
            $('#change_title').text("Change Folder Name");
            $('#folderModal').modal("show");

        });

        $(document).on('click','.upload',function(){
            var folder_name = $(this).data("name");
            $('#hidden_folder_name').val(folder_name);
            $('#uploadModal').modal('show');
        });

        $('#upload_form').on('submit',function(){
            $.ajax({
                url: "../uploads_qs/upload.php",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data)
                {
                    load_folder_list();
                    var message = data.substring(0, data.indexOf("<"));
                        alert(message);
                }

            });
        });
        $(document).on('click','.view_files',function(){
            var folder_name = $(this).data("name");
            var action = "fetch_files";
            $.ajax({
                url:"../uploads_qs/action.php",
                method:"POST",
                data:{action:action,folder_name:folder_name},
                success:function(data)
                {
                    $('#file_list').html(data);
                    $('#list_fileModal').modal('show');
                }
            });
        });
        $(document).on('click','.remove_file',function(){
            var path = $(this).attr("id");
            var action = "remove_file";
            if(confirm("Are you sure to remove this file?"))
            {
                $.ajax({
                    url:"../uploads_qs/action.php",
                    method:"POST",
                    data:{path:path,action:action},
                    success:function(data)
                    {
                        var message = data.substring(0, data.indexOf("<"));
                        alert(message);
                        $('#list_fileModal').modal('hide');
                        load_folder_list();
                    }
                });
            }
        });

        $(document).on('click','.delete',function(){
            var folder_name = $(this).data("name");
            var action ="delete";
            if(confirm("Are you sure to remove this folder?"))
            {
                $.ajax({
                    url:"../uploads_qs/action.php",
                    method:"POST",
                    data:{folder_name:folder_name,action:action},
                    success:function(data)
                    {
                        load_folder_list();
                        var message = data.substring(0, data.indexOf("<"));
                        alert(message);
                    }
                });
            }
        });

        $(document).on('blur','.change_file_name',function(){
            var folder_name = $(this).data("folder_name");
            var old_file_name = $(this).data("file_name");
            var new_file_name = $(this).text();
            var action = 'change_file_name';
            $.ajax({
                url:"../uploads_qs/action.php",
                method:"POST",
                data:{folder_name:folder_name,
                old_file_name:old_file_name,
                    new_file_name:new_file_name,
                    action:action},
                    success:function(data){
                        var message = data.substring(0, data.indexOf("<"));
                        alert(message);
                    }
            })       
        });
    });

  
</script>

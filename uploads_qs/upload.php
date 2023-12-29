<?php


if($_FILES["upload_file"]["name"]!='')
{
    // $data = explode(".",$_FILES["upload_file"]["name"]);
    // $extension = $data[1];
    // $allowed_extension = array("pdf","docx","xlsx","doc","xls");
    if($filename = basename($_FILES["upload_file"]["name"])){
        // $new_file_name = rand().'.'.$extension;
        $path = $_POST["hidden_folder_name"].'/'.$filename;
        if(move_uploaded_file($_FILES["upload_file"]["tmp_name"],$path)){
            echo 'File Uploaded';
        }
        else
        {
            echo 'There is some error';
        }
    }else{
        echo 'error';
    }
}
else{
    echo 'Please Select File';
}
?>
<?php 
if(isset($_POST["action"]))
{
    if($_POST["action"]=="fetch")
    {
        $folder = array_filter(glob('*'),'is_dir');
        $output = '
        <table id="myTable" class = " table  table-striped">
        <thead>
        <tr>
        <th>Folder Name</th>
        <th>Total Fle</th>
        <th>Update</th>
        <th>Delete</th>
        <th>Upload File</th>
        <th>View Uploaded</th>
        </tr>
        </thead>

        ';

        if(count($folder)>0)
        {
            $output .=
                '
                <tbody>';
            foreach($folder as $name)
            {
                $output .=
                '
                <tr>
                <td>'.$name.'</td>
                <td>'.(count(scandir($name))-2).'</td>
                <td><button type="button" name="update"
                data-name="'.$name.'" class="btn-sm update btn btn-warning btn-xs">
                เปลี่ยนชื่อ Folder</button></td>

                <td><button type="button" name="delete"
                data-name="'.$name.'" class="btn-sm delete btn btn-danger btn-xs">
                ลบ Folder</button></td>

                <td><button type="button" name="upload"
                data-name="'.$name.'" class="btn-sm upload btn btn-info btn-xs">
                Upload File</button></td>
                

                <td><button  data-bs-toggle="modal" data-bs-target="#list_fileModal"  type="button" name="view_files"
                data-name="'.$name.'" class="btn-sm view_files btn btn-outline-dark btn-xs">
                View Files</button></td>
                </tr>
                
                ';
            }
            $output .=
                '
                </tbody>';
        }else{
            $output .= '
            <tbody>
            <tr>
            <td colspan="6">No Folder Found</td>
            </tr>
            </tbody>
            ';
        }
        
        $output .= '</table>';
        echo $output;

        
    }
    if($_POST["action"] == "create"){
        if(!file_exists($_POST["folder_name"])){
            mkdir($_POST["folder_name"],0777,true);
            echo 'Folder Created';
        }
        else{
             echo 'Folder Already Created';
        }
    }

    if($_POST["action"]=="change"){
        if(!file_exists($_POST["folder_name"])){
            rename($_POST["old_name"],$_POST["folder_name"]);
            echo 'Folder Name Change';
        }else{
            echo 'Folder Already Created';
        }
    }

    if($_POST["action"]=="fetch_files"){

        $file_data = scandir($_POST["folder_name"]);
        $output = '
        <table id="view_file" class="table table-bordered table-striped">
        <tr>
            <th>File Name</th>
            <th>Date Modified</th>
            <th>Delete</th>
        </tr>
        ';
        foreach($file_data as $file){
            if($file === '.' OR $file ==='..'){
                continue;
            }else{
                $path = $_POST["folder_name"].'/'.$file;
                $mod_date=date("d F  Y H:i:s.", filemtime($path));
                $output .='
                <tr>    
                    <td 
                    data-folder_name="'.$_POST['folder_name'].'"
                    data-file_name="'.$file.'" class="change_file_name">'.$file.'</td>
                    <td>'.$mod_date.'</td>
                    <td><button name="remove_file" class="remove_file btn btn-danger btn-xs" 
                    id="'.$path.'">Remove</button></td>
                </tr>
                ';
            }
        }
        $output .= '</table>';
        echo $output;
    }
    if($_POST["action"]=="remove_file")
    {
        if(file_exists($_POST["path"])){
            unlink($_POST["path"]);
            echo 'File Deleted';

        }
    }
    if($_POST["action"]=="delete"){
        $files = scandir($_POST["folder_name"]);
        foreach($files as $file){
            if($file == '.' || $file ==='..'){
                continue;
            }
            else{
                unlink($_POST["folder_name"].'/'.$file);

            }
        }
        if(rmdir($_POST["folder_name"]))
        {
            print 'Folder Deleted';
        }
    }
    if($_POST["action"] == "change_file_name"){
        $old_name = $_POST["folder_name"].'/'.$_POST["old_file_name"];
        $new_name = $_POST["folder_name"].'/'.$_POST["new_file_name"];
        if(rename($old_name, $new_name)){
            echo 'File name change successfully';
        }
        
        else{
            echo 'There is an error';
        }
    }
}                 


?>
<?php ?>
<script>
     $(document).ready(function () {
    $('#myTable').DataTable();
});
</script>

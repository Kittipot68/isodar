<?php
if(!empty($_GET['file']))
{
    $fileName = basename($_GET['file']);
    $targetDir = "../uploads/";
    $targetFilePath = $targetDir . $fileName;
    //print_r($targetFilePath);
    if(!empty($fileName) && file_exists($targetFilePath))
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        readfile($targetFilePath);
        exit;
    }
    else{
        echo "file not exit";
    }
}


if(!empty($_GET['fileuser']))
{
    $depart = $_GET['depart'];
    $fileName = basename($_GET['fileuser']);
    $targetDir = "../uploads_qs/$depart/";
    $targetFilePath = $targetDir . $fileName;
    //print_r($targetFilePath);
    if(!empty($fileName) && file_exists($targetFilePath))
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        readfile($targetFilePath);
        exit;
    }
    else{
        echo "file not exit";
    }
}

?>
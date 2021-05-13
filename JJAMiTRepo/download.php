<?php 
if(isset($_REQUEST['file']))
{
    $var_1 = $_REQUEST['file'];
$old_path = getcwd();
    
if (isset($_GET["id"])) {
        
        $file_type = $_GET["id"];
    if ($file_type == "azure1") {
        chdir("AZURE/");
    } else {
        chdir("AWS_CLI/");
    }
   
}
    
    $file = $var_1;

if (file_exists($file))
    {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    chdir($old_path);
    exit;
    } else {
    chdir($old_path);
    exit;
}
    
}
?>
<?php
if(isset($_GET['file'])) {
    $dir = $_GET['file'];

    if(file_exists($dir)) {
        $fileName = basename($dir);

        $fileType = mime_content_type($dir);

        $fileSize = filesize($dir);

        header("Content-Description: File Transfer");
        header("Content-Type: $fileType");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Length: $fileSize");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");
        
        readfile($dir);
        exit;
    } 
    else {
        echo "O arquivo não foi encontrado.";
    }
} 
else {
    echo "O parâmetro 'arquivo' não foi especificado.";
}
?>
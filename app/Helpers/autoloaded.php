<?php
function GetSysTempFilePath($ext=null) {
    $tempfile=null;
    while (is_null($tempfile) || file_exists($tempfile)){
        if (!is_null($tempfile)) usleep(1000);
        $tempfile = sys_get_temp_dir().DIRECTORY_SEPARATOR.uniqid();
    }
     if (!empty($ext)) {
        if ($ext[0]!=".") $ext=".".$ext;
        $tempfile.=$ext;
    }
    return $tempfile;
}
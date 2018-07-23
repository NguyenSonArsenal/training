<?php

use Carbon\Carbon;

if (!function_exists('doUploadToFoderTmp')) {
    function doUploadToFoderTmp($file)
    {
        createTmpUploadsFoder();
        $location = getLocationTmpUpload($file);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
            return session(['image' => $location]);
        }
        return false;
    }
}

// return tmp_uploads/2020-01-01/nameFile.extention
if(!function_exists('getTmpUploadDir')) {
    function getTmpUploadDir($file = null)
    {
        $now = new Carbon();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        return getSystemConfig('tmp_upload_dir', 'tmp_uploads') . DIRECTORY_SEPARATOR .
            $year . '-' . $month . '-' . $day;
    }
}

// return "C:\xampp\htdocs\www\training\public\tmp_uploads/nameFile.extention"
if (!function_exists('getTmpUploadUrl')) {
    function getTmpUploadUrl($file = null)
    {
        return public_path(getTmpUploadDir($file = null));
    }
}

if (!function_exists('createTmpUploadsFoder')) {
    function createTmpUploadsFoder()
    {
        $pathDir = getTmpUploadDir();
        if (!file_exists($pathDir))
        {
            \File::makeDirectory($pathDir, $mode = 0777, true, true);
        }
    }
}

if (!function_exists('getLocationTmpUpload')) {
    function getLocationTmpUpload($file) {
        $pathUploadtmp = getTmpUploadUrl();
        $fileName = getTimeNow() . '_' . $file->getClientOriginalName();
        return $pathUploadtmp . DIRECTORY_SEPARATOR . $fileName;
    }
}
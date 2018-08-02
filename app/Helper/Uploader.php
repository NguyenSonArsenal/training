<?php

use Carbon\Carbon;

if (!function_exists('doUploadToFoderTmp')) {
    function doUploadToFoderTmp($file)
    {
        $fileName = getConfig('tmp_upload_dir', 'tmp_uploads/') . $file->getClientOriginalName();

        if(Image::make($file)->save($fileName)) {
            return session()->put(['image' => $fileName]);
        }

        return false;
    }
}

// return tmp_uploads/2020-01-01/
if(!function_exists('createForderUpload')) {
    function createForderUpload()
    {
        $now = new Carbon();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $pathDir = getSystemConfig('upload_dir', 'uploads') . $year . '-' . $month . '-' . $day;
        $fullPath = public_path($pathDir);
        if (!file_exists($pathDir))
        {
            \File::makeDirectory($pathDir, $mode = 0777, true, true);
        }
    }
}

// return "C:\xampp\htdocs\www\training\public\tmp_uploads/nameFile.extention"
if (!function_exists('getTmpUploadUrl')) {
    function getTmpUploadUrl($file = null)
    {
        return public_path(getTmpUploadDir());
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

// return C:\xampp\htdocs\www\training\public\tmp_uploads\2018-7-30\fileName.png
if (!function_exists('getLocationTmpUpload')) {
    function getLocationTmpUpload($file) {
        $fileName = getFileName($file);
        return public_path($fileName);
    }
}

if (!function_exists('getFileName')) {
    function getFileName($file) {
        return getTmpUploadDir() . DIRECTORY_SEPARATOR . getTimeNow() . '_' . $file->getClientOriginalName();
    }
}

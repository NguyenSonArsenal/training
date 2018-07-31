<?php

use Carbon\Carbon;

if (!function_exists('doUploadToFoderTmp')) {
    function doUploadToFoderTmp($file)
    {
        define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
        define("PDF_UPLOADS", DOC_ROOT."tmp_uploads/");

        $tmp_name = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];

        $fileName = 'tmp_uploads/foo.jpg';

        if(Image::make($file)->resize(300, 200)->save($fileName)) {
            return session()->put(['image' => $fileName]);
        }

        return false;
    }
}

// return tmp_uploads/2020-01-01/
if(!function_exists('getTmpUploadDir')) {
    function getTmpUploadDir()
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

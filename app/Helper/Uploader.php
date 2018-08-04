<?php
use Carbon\Carbon;

if (!function_exists('doUploadToFoderTmp')) {
    function doUploadToFoderTmp($file)
    {
        $fileName = $file->getClientOriginalName();
        $pathImgTmp = getConfig('tmp_upload_dir', 'tmp_uploads' . DIRECTORY_SEPARATOR) . $fileName;

        if(Image::make($file)->save($pathImgTmp)) {
            $image = ['pathImgTmp' => $pathImgTmp, 'fileName' => $fileName];
            return session()->put('image', $image);
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
        $pathDir = getConfig('upload_dir', 'uploads' . DIRECTORY_SEPARATOR) . $year . '-' . $month . '-' . $day;
        if (!file_exists($pathDir))
        {
            \File::makeDirectory($pathDir, $mode = 0777, true, true);
        }

        return $pathDir . DIRECTORY_SEPARATOR ;
    }
}

if(!function_exists('deleteFileTmp')) {
    function deleteFileTmp($file) {
        return File::delete($file);
    }
}

if (!function_exists('validateImage')) {
    function validateImage($nameField) {
        return validateExtention($nameField) && validateSize($nameField);
    }
}

if (!function_exists('validateExtention')) {
    function validateExtention($nameField) {
        $extValidate = ['jpeg', 'png', 'jpg', 'gif'];
        $fileName = $_FILES[$nameField]['name'];
        $ext = getExtention($fileName);
        if (in_array($ext, $extValidate)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('validateSize')) {
    function validateSize($nameField) {
        $size = $_FILES[$nameField]['size']; // bytes
        if ($size > getConstant('MAX_IMAGE_UPLOAD')) {
                return false;
        }
        return true;
    }
}

if (!function_exists('doUpload')) {
    function doUpload() {
        $uploadDir = createForderUpload();
        $sourceImg = session()->get('image.pathImgTmp');
        $destImg = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . session()->get('image.fileName');
        if (copy($sourceImg, $destImg)) {
            return $destImg;
        }
        return false;
    }
}


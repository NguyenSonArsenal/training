<?php

use Illuminate\Http\Request;
use \Carbon\Carbon;

if (!function_exists('base_url'))
{
    function base_url()
    {
        return "http://prl.ce";
    }
}


if (!function_exists('asset'))
{
    function asset($file)
    {
        return base_url() . '/' . ltrim($file, '/');
    }
}

// Giữ lại paramaster phục vụ cho việc update record
if (!function_exists('keepValueInput'))
{
    function keepValueInput($input, $value = '')
    {
        if ($input)
            return $input;
        return $value;
    }
}

if (!function_exists('upload'))
{
    function upload($file, $inputPath = '/uploads')
    {
        $now = new Carbon();
        $year   = $now->year;
        $month  = $now->month;
        $day    = $now->day;
        $path = public_path() . rtrim($inputPath, '/') . "/$year/$month/$day/";
        if (!file_exists($path))
        {
            \File::makeDirectory($path, $mode = 0777, true, true);
        }
        $fileName = getTimeNow() . '_' . $_FILES['image']['name'];
        $baseFileName = $path . $fileName;
        move_uploaded_file($_FILES['image']['tmp_name'], $baseFileName);
        return  rtrim($inputPath, '/') ."/$year/$month/$day/" . $fileName;
    }
}

if (!function_exists('getTimeNow')) // mili giay so voi nam 1970. Ex: 1525945316
{
    function getTimeNow()
    {
        $now = new DateTime();
        return $now->getTimestamp();
    }
}

if (!function_exists('getParamsPaginate'))
{
    function getParamsPaginate($object) // object paginator
    {
        $results = [];
        $results['totalRecords'] = $object->total();
        $results['limitOnPage']  = $object->count(); // Số bản ghi trả về trên một trang
        // start = 1 nếu có kết quả trả về, ngược lại trả về 0
        $results['start']        = $object->firstItem() ? $object->firstItem() : 0;
        if ($results['start'] == 0)
            $results['end'] = 0;
        else
            $results['end']         = $results['limitOnPage'] + $results['start'] > $results['totalRecords']
                ? $results['totalRecords']
                : $results['limitOnPage'] + $results['start'] -1  ;
        return $results;
    }
}


<?php

//if (!function_exists('getConfig')) {
//    function getConfig($key, $default = null, $flip = false)
//    {
//        $r = config('config.' . $key, $default);
//        dd($r);
////        $r = config('config.' . $key, $default);
//        //return is_array($r) && $flip ? array_flip($r) : $r;
//    }
//}
//
//if (!function_exists('getKeysConfig')) {
//    function getKeysConfig($key, $default = null)
//    {
//        return array_keys(getConfig($key, $default));
//    }
//}

if (!function_exists('getConfig'))
{
    function getConfig($key, $default = null, $flip = false)
    {
        $r = config('config.' . $key, $default);
        return is_array($r) && $flip == true ? array_flip($r) : $r;
    }
}

if (!function_exists('getKeysConfig'))
{
    function getKeysConfig($key, $default = null)
    {
        return array_keys(getConfig($key, $default));
    }
}


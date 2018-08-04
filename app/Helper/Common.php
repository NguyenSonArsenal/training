<?php
if (!function_exists('getConstant')) {
    function getConstant($key, $default = null)
    {
        return config('constant.' . $key, $default);
    }
}

if (!function_exists('getConfig')) {
    function getConfig($key, $default = null, $flip = false)
    {
        $r = config('config.' . $key, $default);
        return is_array($r) && $flip == true ? array_flip($r) : $r;
    }
}

if (!function_exists('getKeysConfig')) {
    function getKeysConfig($key, $default = null)
    {
        return array_keys(getConfig($key, $default));
    }
}

if (!function_exists('getSystemConfig')) {

    function getSystemConfig($key, $default = null, $flip = false)
    {
        return config('system.' . $key, $default, $flip);
    }
}

if (!function_exists('getCreatedAtColumn')) {
    function getCreatedAtColumn($key = 'field')
    {
        return getSystemConfig('created_at_column.' . $key);
    }
}

if (!function_exists('getUpdatedAtColumn')) {
    function getUpdatedAtColumn($key = 'field')
    {
        return getSystemConfig('updated_at_column.' . $key);
    }
}

if (!function_exists('getDeletedAtColumn')) {
    function getDeletedAtColumn($key = 'field')
    {
        return getSystemConfig('deleted_at_column.' . $key);
    }
}

if (!function_exists('getDelFlagColumn')) {
    function getDelFlagColumn($key = 'field')
    {
        return getSystemConfig('del_flag_column.' .$key);
    }
}

// guard
if (!function_exists('backendGuard')) {

    /**
     * @param string $default
     * @return mixed
     */
    function backendGuard($default = 'admins')
    {
        return Auth::guard(getSystemConfig('backend_guard', $default));
    }
}

if (!function_exists('currentAdmin')) {
    function currentAdmin()
    {
        return backendGuard()->user();
    }
}

if (!function_exists('getExtention')) {
    function getExtention($file) {
        $file = explode('.', $file);
        return $file[count($file) - 1];
    }
}

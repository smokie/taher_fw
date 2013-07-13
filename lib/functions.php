<?php
/**
 * @author: smokiee
 * @date: 4/29/13
 * @package
 */

if (!function_exists('getv')) {
    function getv($arr, $key, $default = '') {

        if (is_scalar($arr)) {
            throw new BadFunctionCallException("getv works on arrays only");
        }

        return isset($arr[$key]) ? $arr[$key] : $default;

    }
}

if (!function_exists('get_class_namespace')) {
    function get_class_namespace($class) {
        if (!is_object($class)) {
            return false;
        }
        $class = get_class($class);
        $arr = explode('\\', $class);
        array_pop($arr);
        return implode('\\', $arr);
    }
}

if (!function_exists('get_class_dir')) {
    function get_class_dir($class) {
        if (!is_object($class)) {
            return false;
        }
        $class = str_replace("\\", DIRECTORY_SEPARATOR, get_class($class));
        $arr = explode(DIRECTORY_SEPARATOR, $class);
        array_pop($arr);
        return ROOT_PATH . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $arr);
    }
}
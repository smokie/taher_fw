<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package Lib/Helper
 */

namespace Helper;

class String
{

    private function __construct(){}

    public static function camelCase($string){
        $splits = explode("_", $string);
        $ret = '';

        $i= 0;
        foreach ($splits as $word){
            $ret .= $i ? ucfirst($word) : $word;
            $i++;
        }

        return $ret;
    }

    public static function deCamelCase($string){

        if (!is_scalar($string)){
            throw new Exception("Bad paramet");
        }

        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}

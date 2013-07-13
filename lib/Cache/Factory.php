<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */

namespace Cache;

class Factory
{
    private static $current;

    private static function determine(){
        if (class_exists('Cache\Predis')){
            self::$current = self::redis();
        }

        if (!self::$current->isConnected()){
            self::$current = self::basic();
        }
    }

    /**
     * @static
     * @param $cache
     * @return Cache
     */
    public static function current($cache = null) {

        if ($cache instanceof Cache){
            self::$current = $cache;
        }

        if (!self::$current){
            self::determine();
        }

        return self::$current;
    }

    public static function redis(){
        return Predis::i();
    }

    public static function basic(){
        return Basic::i();
    }
}

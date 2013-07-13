<?php
/**
 * @author: smokiee
 * @date: 5/22/13
 * @package
 */
class CoreObject
{
    public static $instance;

    public static function i($params = array()){
        if (!self::$instance){
            self::$instance = new self($params);
        }
        return self::$instance;
    }
}

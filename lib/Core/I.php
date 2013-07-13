<?php
/**
 * @author: smokiee
 * @date: 5/3/13
 * @package
 */
trait I
{
    public static $i;

    /**
     * @static
     * @param array $params
     * @return {@inheritDoc}
     */
    public static function i($params = array()){
        if (!self::$i){
            self::$i = new self($params);
        }
        return self::$i;
    }
}

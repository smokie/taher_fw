<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package Lib/Config
 */

/**
 * @method getHost
 * @method getUser
 * @method getPassword()
 */

namespace Config;


class DB extends \DataStorage
{
    use \I;

    protected function data() {
        return array(
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => '123qwe'
        );
    }

    /**
     * @return DB
     */
    public static function i(){
        static $i;

        if (!$i){
            $i = new self();
        }

        return $i;
    }

}


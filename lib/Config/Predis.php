<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */


namespace Config;


/**
 * @method \Config\Predis i
 */

class Predis extends \DataStorage
{
    use \I;
    protected function data() {
        return array(
            'host' => '127.0.0.1',
            'port' => 6379,
            'read_write_timeout' => 3600
        );
    }
}

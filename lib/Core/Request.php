<?php
/**
 * @author: smokiee
 * @date: 5/17/13
 * @package
 */

class Request extends DataStorage
{
    private static $i = array();

    const POST = 'post';
    const GET = 'get';
    const FILES = 'files';

    public function __construct($type){
        switch($type){
            case self::POST:
                $this->data= $_POST;
                break;
            case self::GET:
                $this->data= $_GET;
                break;
            case self::FILES:
                $this->data= $_FILES;
                break;
        }
    }

    /**
     * @static
     * @param $type
     * @return Request
     */
    public static function i($type){
        if (!isset(self::$i[$type])){
            self::$i[$type] = new self($type);
        }
        return self::$i[$type];
    }

    protected function data() {
        $this->data;
    }
}

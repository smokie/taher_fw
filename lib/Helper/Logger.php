<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package Lib/Helper
 */

namespace Helper;

class Logger
{

    private static $i = array();

    private $path;

    const TYPE_REDIS = 'redis';

    public function __construct($type) {

        if (!preg_match(\Config\Validation::i()->getDirectoryPreg(), $type)){
            throw new Exception('Log directory is invalid...[' . $type. ']');
        }

        $dir = sprintf("%s%s%s", LOG_PATH, DIRECTORY_SEPARATOR, $type);

        if (!is_dir($dir)) {
            if (!mkdir($dir)) {
                return;
            }
        }

        $this->path = $dir . DIRECTORY_SEPARATOR . date("Ymd") . ".log";

    }

    public function log($message) {

        file_put_contents($this->path, $message, FILE_APPEND);
    }

    /**
     * @static
     * @param $type
     * @return Logger
     */
    public static function i($type) {
        if (!getv(self::$i, $type)) {
            self::$i[$type] = new self($type);
        }
        return self::$i[$type];
    }

}

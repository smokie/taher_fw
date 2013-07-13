<?php
/**
 * @author: smokiee
 * @date: 4/27/13
 * @package
 */

require_once(dirname(__FILE__) . '/../Constants.php');
require_once(LIB_PATH . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'I.php');

class Autoloader
{
use I;

    static private $map = array(
        'Mod' => MOD_PATH,
        'Predis' => EXT_PATH
    );

    private static function rootMapDir($rootNS) {
        $root = getv(self::$map, $rootNS, null);

        if ($rootNS == 'Mod'){
            $root = explode(DIRECTORY_SEPARATOR, $root);
            array_pop($root);
            $root = implode(DIRECTORY_SEPARATOR, $root);
        }

        return $root ? : LIB_PATH;
    }

    public function __construct() {
        spl_autoload_register("Autoloader::load");
    }

    public static function load($className) {

        if (strpos($className, "\\") !== false) {
            $root = getv(explode("\\", $className), 0);
            $root = self::rootMapDir($root);
            $path = $root . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $className) . '.php';
        } else {
            $path = CORE_PATH . DIRECTORY_SEPARATOR . $className . '.php';
        }

        include $path;
    }

}


Autoloader::i();
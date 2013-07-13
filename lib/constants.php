<?php
/**
 * @author: smokiee
 * @date: 4/27/13
 * @package
 */


if (!defined('DEBUG')){
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);
} else {
    define("ROOT_PATH", dirname($_SERVER['PHP_SELF']));
}

define("LIB_PATH",  ROOT_PATH . DIRECTORY_SEPARATOR . 'lib');
define("MOD_PATH",  ROOT_PATH . DIRECTORY_SEPARATOR . 'Mod');
define("CORE_PATH", LIB_PATH . DIRECTORY_SEPARATOR . 'Core');
define("EXT_PATH", ROOT_PATH . DIRECTORY_SEPARATOR . 'ext');
define("RESOURCE_PATH", ROOT_PATH. DIRECTORY_SEPARATOR . 'resource');
define("LOG_PATH", ROOT_PATH . DIRECTORY_SEPARATOR . "log");
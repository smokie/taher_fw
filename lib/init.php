<?php
/**
 * @author: smokiee
 * @date: 4/29/13
 * @package
 */


if (isset($_SERVER['DEBUG_MODE'])) {
    define("DEBUG", 1);
    if (isset($argv[1])) {
        define("URL", str_replace("url:", "", $argv[1]));
    }
    define("TIMESTART_START", microtime(true));

    function getRunTime() {
        echo
            "\n" . '------------ RUNTIME -------------' . "\n" .
            "\n" . (microtime(true) - TIMESTART_START) . ' sec' . "\n" .
            '------------------------------------' . "\n";
    }
}

include (__DIR__ . DIRECTORY_SEPARATOR . 'Constants.php');
include (__DIR__ . DIRECTORY_SEPARATOR . 'functions.php');
include (__DIR__ . DIRECTORY_SEPARATOR . 'ClassFactory.php');
include (LIB_PATH . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'Autoloader.php');


System::i()->setDefaultTimezone('Asia/Jerusalem');





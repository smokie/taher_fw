<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */

//include(dirname(__FILE__)."/PHPUnit/Autoload.php");

if (!defined("DEBUG")){
    define("DEBUG", 1);
}

class RewriteTest extends PHPUnit_Framework_TestCase
{
    public function testEmpty(){

        include_once(dirname(__FILE__). "/../lib/init.php");

        define("URL" , '/');

        $arr = URLRules::i()->getURLData();

        $this->assertEquals('Index', $arr['mod']);
        $this->assertEquals('Index', $arr['action']);

    }
}

$r = new RewriteTest();

$r->testEmpty();

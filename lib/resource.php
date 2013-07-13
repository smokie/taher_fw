<?php
/**
 * @author: smokiee
 * @date: 5/12/13
 * @package
 */

include (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'init.php');

$r = new \Resources\Loader(getv($_REQUEST, 'type'), getv($_REQUEST, 'src'));

echo $r->getContents();
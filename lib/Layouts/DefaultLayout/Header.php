<?php
/**
 * @author: smokiee
 * @date: 5/17/13
 * @package
 */

namespace Layouts\DefaultLayout;

class Header extends \View
{
use \I;

    protected function type() {
        return \View::TYPE_HTML_FILE;
    }

    public static function getClassPath($class = '') {
        return LIB_PATH . DIRECTORY_SEPARATOR . parent::getClassPath($class);
    }
}

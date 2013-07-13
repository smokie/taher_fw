<?php
/**
 * @author: smokiee
 * @date: 5/3/13
 * @package
 */

namespace Mod\Index\View;


/**
 * @method View i
 */

class Index extends \View
{
    use \I;

    protected function type() {
        return \View::TYPE_HTML_FILE;
    }

}

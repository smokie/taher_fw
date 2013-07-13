<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Layouts;

class Factory
{
    private static $current;

    /**
     * @static
     * @param int $layout
     * @return Document|DefaultLayout
     */
    public static function current($layout = 0) {
        if ($layout instanceof \Document) {
            self::$current = $layout;
        }

        return self::$current ? : DefaultLayout\DefaultLayout::i();
    }
}

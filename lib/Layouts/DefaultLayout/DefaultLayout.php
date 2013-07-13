<?php
/**
 * @author: smokiee
 * @date: 5/9/13
 * @package
 */

namespace Layouts\DefaultLayout;

/**
 * @method @static DefaultLayout i
 */

class DefaultLayout extends \Document
{

    use \I;


    /**
     * @return View
     */
    public function Header() {
        return new Header();
    }

    /**
     * @return View
     */
    public function Footer() {
        return new Footer();
    }


}

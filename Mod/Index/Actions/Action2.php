<?php
/**
 * @author: smokiee
 * @date: 5/22/13
 * @package
 */

namespace Mod\Index\Actions;

/**
 * @method @static Action2 i()
 */

class Action2 extends \Action
{
use \I;

    public function run() {
        \Controller::i()->addJS(array(
            'index-list2',
            'index-list1',
            'index-list3',
        ));

       $this->setView(new \Mod\Index\View\Index());
    }

    public function actionName() {
        return 'Action2';
    }
}

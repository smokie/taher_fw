<?php
/**
 * @author: smokiee
 * @date: 5/22/13
 * @package
 */

namespace Mod\Index\Actions;

class Index extends \Action
{
    use \I;
    public function preRun(){
        \Controller::i()->addJS('index-list1');

        $this->setView(new \Mod\Index\View\Index());
    }

    public function actionName() {
        return 'Index';
    }

    public function run() {

    }

}

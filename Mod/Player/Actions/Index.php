<?php
/**
 * @author: smokiee
 * @date: 5/22/13
 * @package
 */

namespace Mod\Player\Actions;

class Index extends \Action
{
    use \I;
    public function preRun(){
        \Controller::i()->addJs(array('Player-player'));
    }

    public function actionName() {
        return 'Index';
    }

    public function run() {
        $this->setView(\Mod\Player\View\Index::i());

    }

}

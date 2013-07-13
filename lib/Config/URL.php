<?php
/**
 * @author: smokiee
 * @date: 5/12/13
 * @package
 */

/**
 * @method getJsUrl()
 * @method getCssUrl()
 * @method getMainUrl()
 */

namespace Config;

/**
 * @method URL i()
 */

class URL extends \DataStorage
{
    use \I;

    protected function data() {
        return array(
            'main_url'=> 'www.yalely.com',
            'css_url' => 'css.yalely.com',
            'js_url'  => 'js.yalely.com'
        );
    }

    public function __call($name, $arg){
        $ret= parent::__call($name, $arg);

        if (getv($arg, 0)){
            $ret= 'http://' . $ret;
        }

        return $ret;
    }

}

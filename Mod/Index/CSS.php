<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Mod\Index;

/**
 * @method CSS i()
 */
class CSS extends \Resources\ResourceList
{
    use \I;

    private function common() {
        return array(
            'a.css',
            'b.css',
            'c.css'
        );
    }

    public function __construct(){
        parent::__construct($this->common());
    }

    public function list1(){
        $this->push(array(
            'abc.css',
            'cba.css'
        ));
    }
}

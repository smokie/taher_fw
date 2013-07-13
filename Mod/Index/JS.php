<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Mod\Index;

/**
 * @method \Mod\Index\JS i()
 */
class JS extends \Resources\ResourceList
{
    use \I;

    private function common() {
        return array(
            'a.js',
            'b.js',
            'c.js'
        );
    }

    public function __construct(){
        parent::__construct($this->common());
    }

    public function list1(){
        $this->push(array(
            'abc.js',
            'cba.js'
        ));
    }

    public function list2(){
        $this->push(array(
            'zz.js',
            'cxxa.js'
        ));
    }

    public function list3(){
        $this->push(array(
            'ab2.js',
            'cb3.js'
        ));
    }
}

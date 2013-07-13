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
class Image extends \Resources\ImageResourceList
{
    use \I;

    private function common() {
        return array(
        );
    }

    public function __construct(){
        parent::__construct($this->common());
    }

    public function list1(){
        $this->push(array(
            'image.png',
            'image2.png',
            'image3.png',
            'image4.png',
            'image5.png',
            'image2.png',
            'image3.png',
            'image4.png'
        ));
    }

    public function list2(){
        $this->push(array(
        ));
    }

    public function list3(){
        $this->push(array(
        ));
    }
}

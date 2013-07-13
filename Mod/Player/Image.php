<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Mod\Player;

/**
 * @method \Mod\Player\JS i()
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
}

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
class JS extends \Resources\ResourceList
{
    use \I;

    private function common() {
        return array(
        );
    }

    public function __construct(){
        parent::__construct($this->common());
    }

    public function player(){
        $this->push(array(
            'jquery.js',
            'TrackList.js'
        ));
    }
}

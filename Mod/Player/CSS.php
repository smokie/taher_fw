<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Mod\Player;

/**
 * @method CSS i()
 */
class CSS extends \Resources\ResourceList
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

<?php
/**
 * @author: smokiee
 * @date: 5/3/13
 * @package
 */

namespace Exception;

class ModNotFound extends \Core\Exception
{
    public function __construct($modName){
        parent::__construct(sprintf("%s not found...", $modName));
    }
}

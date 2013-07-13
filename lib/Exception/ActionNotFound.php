<?php
/**
 * @author: smokiee
 * @date: 5/3/13
 * @package
 */

namespace Exception;

class ActionNotFound extends \Core\Exception
{
    public function __construct($modName, $actionName){
        parent::__construct(sprintf("%s in module %s was not found...", $modName, $actionName));
    }
}

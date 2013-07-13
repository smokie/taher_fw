<?php
/**
 * @author: smokiee
 * @date: 5/4/13
 * @package
 */

namespace Exception;

class TemplateNotFound extends \Core\Exception
{
    public function __construct($fileName, $mod, $action){
        parent::__construct(sprintf("Template file %s (mod: %s, action: %s) does not exist", $fileName, $mod, $action));
    }
}

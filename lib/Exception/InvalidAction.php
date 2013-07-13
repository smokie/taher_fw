<?php
/**
 * @author: smokiee
 * @date: 5/22/13
 * @package
 */
class InvalidAction extends \Core\Exception
{
    public function __construct($path, $className){
        parent::__construct(sprintf('Invalid action %s in actions directory %s',$className, $path));
    }
}

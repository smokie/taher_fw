<?php
/**
 * @author: smokiee
 * @date: 5/4/13
 * @package
 */

namespace Exception;

class ViewNotFound extends \Core\Exception
{
    public function __construct($view){
        parent::__construct(sprintf("View %s does not exist", $view));
    }
}

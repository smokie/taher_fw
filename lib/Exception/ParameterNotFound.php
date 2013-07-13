<?php
/**
 * @author: smokiee
 * @date: 4/30/13
 * @package
 */

namespace Exception;

class ParameterNotFound extends \Core\Exception
{
    public function __construct($paramKey){
        parent::__construct(sprintf('Parameter \'%s\' not defined in Config/Rewrite',$paramKey));
    }
}

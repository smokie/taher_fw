<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Exception;

class BadResourceType extends \Core\Exception
{
    public function __construct($type){
        parent::__construct(sprintf('Bad resource type [%s]', $type));
    }
}

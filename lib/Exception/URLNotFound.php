<?php
/**
 * @author: smokiee
 * @date: 4/30/13
 * @package
 */

namespace Exception;

class URLNotFound extends \Core\Exception
{
    public function __construct(){
        parent::__construct(sprintf('URL %s not found', \System::i()->getURL()));
    }
}

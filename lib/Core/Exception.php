<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package
 */

namespace Core;

class Exception extends \Exception
{
    public function __construct($message){

        $message = sprintf("[%s:%s] - %s", $this->getFile(), $this->getLine(), $message);
        parent::__construct($message);

        $this->log();
    }

    public function key(){
        return 'generic';
    }

    protected function log(){
        \Helper\Logger::i($this->key())->log($this->message);
    }
}

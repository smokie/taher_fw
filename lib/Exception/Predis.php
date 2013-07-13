<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */

namespace Exception;

class Predis extends \Core\Exception
{
    public function __construct($message){
        parent::__construct('Predis Exc: '. $message );
    }

    public function key(){
        return 'predis';
    }
}

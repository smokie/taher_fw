<?php
/**
 * @author: smokiee
 * @date: 5/11/13
 * @package
 */
class ClassFactory
{
    /**
     * @return Document
     */
    public static function layout(){
        return \Layouts\Factory::current();
    }

    /**
     * @static
     * @return \Config\Validation
     */
    public static function validations(){
        return \Config\Validation::i();
    }

    /**
     * @static
     * @return \Config\URL
     */
    public static function urls(){
        return \Config\URL::i();
    }

    public static function cache(){
        return \Cache\Factory::current();
    }

}

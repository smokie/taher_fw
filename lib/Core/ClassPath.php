<?php
/**
 * @author: smokiee
 * @date: 5/5/13
 * @package
 */
trait ClassPath
{
    public static function getClassPath($class=''){
        if (!$class){
            $class = get_called_class();
        }

        if (is_object($class)){
            $class= get_class($class);
        }

        return str_replace("\\", "//", $class);
    }

    public static function getClassName($class){
        $path= self::getClassPath($class);

        $splits = explode("/", $path);

        return end($splits);
    }

    public function classPath(){
        return self::getClassPath($this);
    }
}

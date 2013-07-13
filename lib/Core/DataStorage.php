<?php
/**
 * @author: smokiee
 * @date: 4/27/13
 */

abstract class DataStorage
{
    protected $data = array();

    protected abstract function data();

    public function __construct() {
        $this->data = $this->data();
    }

    public function __call($name, $args) {

        $ret = false;
        if (preg_match('/^get(.+)/', $name, $matches)) {
            $key = \Helper\String::deCamelCase($matches[1]);

            if (isset($this->data[$key])) {
                $ret = $this->data[$key];
            }
        } elseif (preg_match('/^set(.+)/', $name, $matches)) {
            $key = \Helper\String::deCamelCase($matches[1]);

            if (empty($args)) {
                throw new BadFunctionCallException();
            }

            $this->data[$key] = $args[0];
            $ret = $this;
        }

        return $ret;
    }

    public function getJSON() {
        return json_encode($this->data);
    }

}

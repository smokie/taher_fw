<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */

namespace Cache;

/**
 * @method Basic i
 */

class Basic extends \DataStorage implements Cache
{
    use \I;
    /**
     * Gets information about a specific cache stored in key: key
     * @param string $namespace
     * @param $key
     * @return mixed
     */
    public function getInfo($key, $namespace = 'default') {
        return $key;
    }

    public function get($key, $namespace = 'default') {
        if (!isset($this->data[$namespace])){
            return '';
        }
        return getv($this->data[$namespace], $key);
    }

    public function set($key, $value, $namespace = 'default', $timeout = 0) {
        if (!isset($this->data[$namespace])){
            $this->data[$namespace] = array();
        }

        $this->data[$namespace][$key] = $value;
    }

    public function size() {
        return count($this->data);
    }

    public function data(){
        return array();
    }

}

<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */

namespace Cache;

interface Cache
{
    const DEFAULT_TIMEOUT = 200;

    /**
     * Gets information about a specific cache stored in key: key
     * @abstract
     * @param string $namespace
     * @param $key
     * @return mixed
     */
    public function getInfo($key, $namespace = 'default');

    public function get($key, $namespace = 'default');

    public function set($key, $value, $namespace = 'default', $timeout = self::DEFAULT_TIMEOUT);

    public function size();
}

<?php
/**
 * @author: smokiee
 * @date: 5/20/13
 * @package
 */

namespace Cache;

/**
 * @method \Cache\Predis i
 */

class Predis implements Cache
{
use \I;

    /**
     * @var \Predis\Client
     */
    private $connection;

    const KEY_SEPARATOR = '::';

    public function __construct() {

        $arg = array(
            'host'               => \Config\Predis::i()->getHost(),
            'port'               => \Config\Predis::i()->getPort(),
            'read_write_timeout' => \Config\Predis::i()->getReadWriteTimeout()

        );

        $this->connection = new \Predis\Client($arg);
        $this->connection->connect();


        if (!$this->connection){
            throw new \Exception\Predis('Cannot connec to Redis server');
        }

    }

    public function isConnected(){
        return $this->connection->isConnected();
    }

    private function keyName($namespace, $key) {
        if (!is_scalar($namespace)) {
            try {
                $namespace = $namespace . '';
            } catch (\Exception $r) {
                $namespace = '';
            }
        }
        return $namespace . self::KEY_SEPARATOR . $key;
    }

    /**
     * Gets information about a specific cache stored in key: key
     * @param string $namespace
     * @param $key
     * @return mixed
     */
    public function getInfo($key, $namespace = 'default') {
        $cmdDebug = $this->connection->createCommand('debug', array('object', $this->keyName($namespace, $key)));
        $this->connection->executeCommand($cmdDebug);

    }

    public function size() {
        $cmd = $this->connection->createCommand('DBSIZE');
        return (int)$this->connection->executeCommand($cmd);
    }

    public function get($key, $namespace = 'default') {
        return $this->connection->hget($namespace, $key);
    }

    public function cmd($cmd, Array $args = array()) {
        $cmd = $this->connection->createCommand($cmd, $args);
        try {
            return $this->connection->executeCommand($cmd);
        } catch (\Exception $e) {
            trigger_error($e->getMessage(), E_USER_WARNING);
            return '';
        }
    }

    public function set($key, $value, $namespace = 'default', $timeout = Cache::DEFAULT_TIMEOUT) {

        if (!is_scalar($value)){
            $value = base64_encode(json_encode($value));
        }
        $this->connection->hset($namespace, $key, $value);
        $this->connection->expireat($key, $timeout);

        return $this;
    }

}

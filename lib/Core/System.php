<?php
/**
 * @author: smokiee
 * @date: 4/29/13
 * @package
 */

/**
 * @method @static System i()
 */
class System extends DataStorage
{
use I;

    private $defaults;
    private $server;

    public function __construct() {
        $this->defaults = ini_get_all();
        $this->defaults['memory_limit'] = ini_get('memory_limit');
        $this->server = $_SERVER;
    }

    protected function data() {
        return array(
            'server' => $_SERVER,
            'ini'    => ini_get_all()
        );
    }

    public function iniSet($key, $value) {
        if (!ini_get($key)) {
            trigger_error('ini key ' . $key . ' does not exist');
        } else {
            ini_set($key, $value);
            $this->data['ini'][$key] = $value;
        }
        return $this;
    }

    /**
     * @param $key
     * @return System
     */
    public function reset($key){
        $this->iniSet($key, $this->defaults[$key]);
        return $this;
    }

    /**
     * @param $limit
     * @return System
     */
    public function setTimeLimit($limit){
        $limit = intval($limit);
        set_time_limit($limit);
        return $this;
    }


    /**
     * @param string $tz
     * @return System
     */
    public function setDefaultTimezone($tz = '') {
        if (!$tz) {
            $tz = date_default_timezone_get();
        }
        date_default_timezone_set($tz);

        return $this;
    }

    public function getURL() {
        if (defined("DEBUG") && defined("URL")) {
            return URL;
        }

        return getv($_GET, 'url') ? : $_SERVER['REQUEST_URI'];
    }

    public function nl() {
        $nl = "\n";

        if (!defined("PHP_OS")) {
            return $nl;
        }

        switch (strtoupper(substr(PHP_OS, 0, 3))) {
            case 'WIN':
                $nl = "\n\r";
                break;
        }

        return $nl;
    }
}

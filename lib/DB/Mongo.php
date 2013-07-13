<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package /Lib/DB
 */

namespace DB;

class Mongo
{

    protected static $i;

    /**
     * @var MongoClient
     */
    protected $connection;


    /**
     * @static
     * @return Mongo
     */
    public static function i(){
        if (!self::$i){
           self::$i = new self();
        }

        return self::$i;
    }

    public function connection(){
        return $this->connection;
    }

    protected function connect(){
        $this->connection = new \MongoClient();
    }

    protected function __construct(){
        $this->connect();
    }

    public function __get($name){
        $db = $this->connection()->database;
        if (isset($db, $name)){
            return $db->$name;
        }
    }

}

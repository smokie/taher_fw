<?php
/**
 * @author: smokiee
 * @date: 6/15/13
 * @package
 */

namespace DAO;

class Track
{
    private $data;

    public function __construct($data = array()) {
        $this->data = $data;

        if (empty($this->data)){
            $this->loadDefaults();
        }
    }

    protected function loadDefaults() {
        $this->data = array(
            'id'   => 0,
            'title'=> '',
            'path' => '',
            'tags' => array()
        );
    }

    public static function loadById($id){
        $db = \DB\Mongo::i()->tracks;
        $data = $db->findOne(array('tags'=>'purple'));

        return $data;
    }

}

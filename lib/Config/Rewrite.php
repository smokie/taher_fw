<?php
/**
 * @author: smokiee
 * @date: 4/30/13
 * @package
 */

namespace Config;

class Rewrite extends \DataStorage
{
    use \I;
    public function getRules(){
        return $this->data();
    }

    protected function data() {
        return
            array(
                ''      => array(
                    'module' => 'Index',
                    'action' => 'Index'
                ),
                ':1'    => array(
                    'module' => ':1',
                    'action' => 'Index',
                    'params' => array(
                        ':1' => array(
                            'type' => '',
                        )
                    )
                ),
                ':1/:2' => array(
                    'module' => ':1',
                    'action' => ':2',
                    'params' => array(
                        ':1' => array(
                            'type' => '',
                        ),
                        ':2' => array(
                            'type' => '',
                        )
                    )
                ),
                ':1/:2/:3' => array(
                    'module' => ':1',
                    'action' => ':2',
                    'get'    => array(
                        'id' => ':3'
                    ) ,
                    'params' => array(
                        ':1' => array(
                            'type' => '',
                        ),
                        ':2' => array(
                            'type' => '',
                        ),
                        ':3' => array(
                            'type' => 'integer'
                        )
                    )
                ),
                ':1' => array(
                    'module' => 'Index',
                    'action' => 'Index',
                    'get'    => array(
                        'id' => ':1'
                    ) ,
                    'params' => array(
                        ':1' => array(
                            'type' => 'preg:/[a-zA-Z]+/',
                        )
                    )
                )
            );
    }

}

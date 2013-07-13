<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package
 */


namespace Config;


/**
 * @method mixed getDirectoryPreg()
 * @method mixed getUrlPreg()
 * @method mixed getResourceType()
 * @method @static Validation i()
 */

class Validation extends \DataStorage
{

use \I;

    protected function data() {
        return
            array(
                'directory_preg'    => '/^[a-zA-Z_0-9]+$/',
                'url_param'         => '/^[0-9a-zA-Z]+$',
                'resource_types' => array(
                    \Resources\ResourceList::TYPE_CSS,
                    \Resources\ResourceList::TYPE_JS,
                    \Resources\ResourceList::TYPE_IMAGE
                )
            );
    }

}

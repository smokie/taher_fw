<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Resources;

class ImageLoader extends Loader
{

    public function __construct($resources) {
        parent::__construct(ResourceList::TYPE_IMAGE, $resources);
    }

    protected function save(){

    }

    protected function parseContent() {
        $this->content = array();
        foreach ($this->resources as $res) {
            $this->content[] = $this->loadResource($res[0], $res[1]);
        }
    }

    /**
     * @param $mod
     * @param $rlist
     * @return mixed
     */
    private function loadResource($mod, $rlist) {
        /**
         * @var ResourceList $class
         */

        $type = ucfirst($this->type);

        $ns = '\\Mod\\' . ucfirst($mod);
        $className = $ns . '\\' . $type;

        if (!class_exists($className)) {
            trigger_error(sprintf("Bad resources class [%s]", $className), E_USER_WARNING);
            return;
        }

        $class = $className::i();

        $image = $class->getContent($rlist, $mod);

        $file = $mod . '-' . $rlist . ".png";
        $saveTo = RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . $file;

        if (!imagepng($image, $saveTo, 9)){
            trigger_error(sprintf("Cannot write to file [%s]", $saveTo), E_USER_WARNING);
            return;
        }

        \System::i()->reset("memory_limit");
        return $file;
    }

}

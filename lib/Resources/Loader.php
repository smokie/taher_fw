<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Resources;

class Loader
{

    protected $type;
    protected $resources;

    protected $content;

    const SEPARATOR = ',';

    public function __construct($type, $resources) {

        $this->type = $type;

        if (!in_array($type, \Config\Validation::i()->getResourceTypes())) {
            throw new \Exception\BadResourceType($type);
        }

        $this->resources = $resources;
        $this->parseLists();


    }

    protected function save() {
        $modListArr= array_map(function($v){
            return $v[0].'-'.$v[1];
        }, $this->resources);
        $fname = implode(self::SEPARATOR, $modListArr) . '.' . $this->type;
        $saveTo = RESOURCE_PATH . DIRECTORY_SEPARATOR  . strtolower($this->type) . DIRECTORY_SEPARATOR . $fname;

        file_put_contents($saveTo, $this->content);
    }

    /**
     * @return \Resources\Loader
     */
    protected function parseLists() {
        $res = array();

        if (!is_array($this->resources)) {
            $this->resources = explode(self::SEPARATOR, $this->resources);
        }

        foreach ($this->resources as $resource) {
            if (preg_match('/^(.+)-(.+)$/', $resource, $matches)) {
                list($mod, $rlist) = array($matches[1], $matches[2]);
//                $cont .= $this->loadResource($mod, $rlist);
                $res[] = array($mod, $rlist);
            }
        }

        $this->resources = $res;

        return $this;
    }

    protected function parseContent() {
        $this->content = '';
        foreach ($this->resources as $resource) {
            $this->content .= $this->loadResource($resource[0], $resource[1]);
            $this->content .= \System::i()->nl();
        }
        $this->save();
    }

    /**
     * @return mixed
     */
    public function getContent() {
        if (!$this->content) {
            $this->parseContent();
        }
        return $this->content;
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

        $contents = $class->getContent($rlist);

        return $contents;
    }

}

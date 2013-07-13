<?php
/**
 * @author: smokiee
 * @date: 5/10/13
 * @package
 */

namespace Resources;

abstract class ResourceList implements \Countable
{

    const TYPE_CSS = 'css';
    const TYPE_JS = 'js';
    const TYPE_IMAGE = 'image';


    protected $list;
    protected $content;
    protected $loaded = false;

    /**
     * @param array $resources
     */
    public function __construct($resources=array()){
        if (!is_array($resources)){
            trigger_error("resource must be an array", E_USER_WARNING);
            return;
        }
        $this->list = $resources;;
    }

    /**
     * @param $resource
     * @return ResourceList
     */
    public function push($resource){
        if (is_scalar($resource)){
            array_push($this->list, $resource);
        } elseif (is_array($resource)) {
            $this->list = array_merge($this->list, $resource);
        }

        return $this;
    }

    /**
     * @return array
     */
    protected function get(){
        return $this->list;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count() {
        return count($this->list);
    }

    /**
     * @param $rfile
     * @return mixed
     */
    protected function getResourceContent($rfile){
        return file_get_contents($rfile);
    }

    /**
     * @param $listName
     * @return array
     */
    protected function getPaths($listName){
        $ret=  array();

        if (!method_exists($this, $listName)){
            die('NO RESOURCE!');
        }

        $this->$listName();
        $list = $this->get();

        foreach ($list as $r){
            $called = get_called_class();
            $rtype = ucfirst(strtolower(\ClassPath::getClassName($called)));
            $dir = ROOT_PATH . DIRECTORY_SEPARATOR . dirname(\ClassPath::getClassPath($called));

            $rfile = $dir . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . $rtype . DIRECTORY_SEPARATOR . $r;

            if (file_exists($rfile)){
                $ret[] = $rfile;
            }
        }

        return $ret;

    }

    /**
     * @param $listName
     * @return string
     */
    protected function loadListContents($listName){

        $paths = $this->getPaths($listName);

        $this->content = '';
        foreach ($paths as $path){
            $this->content .= $this->getResourceContent($path);
        }

        $this->loaded= true;
    }

    /**
     * @param $listName
     * @return mixed
     */
    public function getContent($listName){
        if (!$this->loaded){
            $this->loadListContents($listName);
        }

        return $this->content;

    }
}

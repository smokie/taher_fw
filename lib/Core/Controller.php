<?php
/**
 * @author: smokiee
 * @date: 5/3/13
 * @package
 */

/**
 * @method @static Controller i()
 */
class Controller
{

    private static $i;
    /**
     * @var Mod
     */
    private $mod;

    private $css = array();
    private $js = array();

    /**
     * @static
     * @param null|URLRules $url
     * @return Controller
     */
    public static function i(URLRules $url = null) {
        if (!self::$i) {
            self::$i = new self($url);
        }

        return self::$i;
    }

    public function __construct(URLRules $url = null) {

        $urlData = $url->getURLData();
        $module = getv($urlData, 'module', 'Index');
        $action = getv($urlData, 'action', 'Index');

        \Layouts\Factory::current()->title(ucfirst($module) . ' - ' . ucfirst($action));

        $this->initModule($module, $action);
    }

    /**
     * @param $modName
     * @param $action
     * @throws Exception\ModNotFound
     */
    private function initModule($modName, $action) {
        /**
         * @var Mod $modClass
         */
        $modClass = "\\Mod\\" . $modName . "\\" . $modName;

        if (!class_exists($modClass)) {
            throw new \Exception\ModNotFound($modName);
        }

        $modClass = $modClass::i();

        $action = ucfirst($action);
        $modClass->setSelectedAction($action);

        $this->mod = $modClass;
    }

    /**
     * @return Controller
     */
    public function runAction() {
        $this->mod->runAction();

        return $this;
    }

    /**
     * @return string
     */
    public function renderDocument(){
        $view = $this->mod->getSelectedAction()->getView();
        ClassFactory::layout()->setView($view);

        return ClassFactory::layout()->render(true);
    }

    /**
     * @param bool $return
     * @return string
     */
    public function renderAction($return = false) {
        if ($return) {
            ob_start();
        }

        echo $this->mod->getSelectedAction()->getView() . '';

        if ($return) {
            return ob_get_clean();
        }

    }

    /**
     * @return string
     */
    public function getAction() {
        return $this->mod->getSelectedAction();
    }

    /**
     * @return string
     */
    public function getModName() {
        return get_class($this->mod);
    }

    /**
     * @param $cssList
     * @return Controller
     */
    public function addCss($cssList) {
        $this->addResource('css', $cssList);
        return $this;
    }

    /**
     * @param $jsList
     * @return Controller
     */
    public function addJS($jsList) {
        $this->addResource('js', $jsList);
        return $this;
    }

    /**
     * @return array
     */
    public function css() {
        return $this->css;
    }

    /**
     * @return array
     */
    public function js() {
        return $this->js;
    }

    /**
     * @param $type
     * @return string
     */
    public function getResourceLink($type) {

        if (!in_array($type, \ClassFactory::validations()->getResourceTypes())) {
            return '';
        }
        $list = $this->$type();

        if (!count($list)) {
            return '';
        }

        return implode(',', $list);
    }

    /**
     * @return string
     */
    public function getJSSrc() {
        return $this->getResourceLink('js');
    }


    /**
     * @return string
     */
    public function getCSSSrc() {
        return $this->getResourceLink('css');
    }

    /**
     * @param $type
     * @param $resource
     * @return mixed
     * @throws Exception\BadResourceType
     */
    private function addResource($type, $resource) {

        $rtypes= \Config\Validation::i()->getResourceTypes();
        if (!is_scalar($rtypes)){
            $rtypes = '(' . implode("|", $rtypes) . ')';
        }

        if (!preg_match('/'.$rtypes.'/', $type)) {
            throw new \Exception\BadResourceType($type);
            return;
        }

        if (is_scalar($resource)) {
            array_push($this->$type, $resource);
        } elseif (is_array($resource)) {
            $this->$type = array_merge($this->$type, $resource);
        }
    }

}

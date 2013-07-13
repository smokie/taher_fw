<?php
/**
 * @author: smokiee
 * @date: 5/22/13
 * @package
 */


abstract class Action
{
    protected $view;
    protected $module;
//    protected $resources = array();

    public function __construct(Mod $module, View $view = null) {

        if (!$module) {
            throw new \Exception\ActionNeedsModule('Action needs module!');
        }

        $this->module = $module;
        $this->view = $view;
    }

    protected final function setView(View $view = null) {
        if (!$view) {
            $view = $this->actionName();

            $viewClass = get_class($this->module) . '\\' . 'View' . '\\' . $view;

            if (!class_exists($viewClass)) {
                throw new \Exception\ViewNotFound($view);
            }
        }

        $this->view = $view;
    }

    final public function getView() {
        return $this->view;
    }

    abstract public function actionName();

    public function getModule() {
        return $this->module;
    }

    public function preRun() {
    }

    abstract public function run();

    public function afterRun() {
    }

}

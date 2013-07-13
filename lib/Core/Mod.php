<?php
/**
 * @author: smokiee
 * @date: 5/3/13
 * @package
 */

abstract class Mod
{
use classPath;

    protected $view; // todo: remove
    protected $actionsPool = array();
    protected $selectedActionKey;

    public function __construct() {
        $this->loadActionsFromSystem();
    }

    public function runAction() {
        $action = $this->getSelectedAction();
        $action->preRun();
        $action->run();
        $action->afterRun();
    }

    public function getActionsPool() {
        return $this->actionsPool;
    }

    private function loadActionsFromSystem() {
        $actionsPath = get_class_dir($this) . DIRECTORY_SEPARATOR . 'Actions' . DIRECTORY_SEPARATOR;

        $pool = ClassFactory::cache()->get($actionsPath, 'ActionPools');

        if (!$pool){
            foreach (glob(sprintf("%s*.php", $actionsPath)) as $actionClass) {
                $actionClassName = preg_replace('/\.php$/', '', basename($actionClass));
                $pool [] = $actionClassName;
            }

            ClassFactory::cache()->set($actionsPath, json_encode($pool), 'ActionPools');
        } else {
            $pool = json_decode($pool, true);
        }

        $poolArr = array();
        foreach ($pool as $actionClassName){
            $actionClass = get_class_namespace($this) . '\\Actions\\' . $actionClassName;

            if (class_exists($actionClass)) {
                /**
                 * @var Action $actionI
                 */
                $actionI = $actionClass::i($this);
                if (is_subclass_of($actionI, 'Action') == false) {
                    throw new InvalidAction($actionsPath, $actionClass);
                }
                $poolArr[$actionI->actionName()] = $actionI;
            }

            $this->actionsPool = $poolArr;
        }
    }

    /**
     * @param $action
     * @return string
     */
    public function getActionByKey($action) {
        return $this->actionExists($action) ? $this->actionsPool[$action] : null;
    }

    /**
     * @param $action
     * @return bool
     */
    public function actionExists($action) {
        if (is_scalar($action)) {
            return isset($this->actionsPool[$action]);
        } elseif ($action instanceof Action) {
            return in_array($action, $this->actionsPool);
        }
        return false;
    }

    public function setSelectedAction($action) {
        if (!$this->actionExists($action)) {
            throw new \Exception\ActionNotFound(get_class($this), $action);
        }
        $this->selectedActionKey = is_scalar($action) ? $action : array_search($this->actionsPool, $action);
    }

    /**
     * @return Action
     */
    public function getSelectedAction(){
        return $this->getActionByKey($this->selectedActionKey);
    }
}

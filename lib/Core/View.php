<?php
/**
 * @author: smokiee
 * @date: 5/4/13
 * @package
 */
abstract class View extends \DataStorage
{
use ClassPath;

    const TYPE_NO_VIEW = 'no_view';
    const TYPE_INNER = 'inner';
    const TYPE_HTML_FILE = 'html_file';

    public function __construct($data = array()) {
        $this->data = $data;
    }

    public function viewName(){
        $splits = explode("\\", get_class($this));

        return end($splits);
    }

    abstract protected function type();

    final public function __toString() {
        $ret = '';
        $called = get_called_class();
        switch ($this->type()) {
            case self::TYPE_NO_VIEW:
                return '';
            case self::TYPE_INNER:
                if (!method_exists($called, '__out')) {
                    trigger_error(sprintf("__out is defined in view of type INNER [%s]", get_class($called)));
                }
                $ret = call_user_func(array($called, '__out'));
                break;
            case self::TYPE_HTML_FILE:
                $classPath = $this->getClassPath();
                $htmlFile = dirname($classPath) . DIRECTORY_SEPARATOR . "Html" . DIRECTORY_SEPARATOR . $this->viewName()  . "_html.php";
                if (!file_exists($htmlFile)) {
                   // throw new \Exception\TemplateNotFound($htmlFile, Controller::i()->getModName(), Controller::i()->getAction());
                    trigger_error(sprintf('HTML template does not exist [file: %s, mod: %s, action: %s]', $htmlFile, Controller::i()->getModName(), Controller::i()->getAction()), E_USER_ERROR);
                }
                ob_start();
                include($htmlFile);
                $ret = ob_get_clean();
                break;
        }
        return $ret;
    }

    protected function data() {
        return $this->data;
    }
}

<?php
/**
 * @author: smokiee
 * @date: 5/7/13
 * @package
 */

abstract class Document
{
    /**
     * @var \View
     */
    private $view = View::TYPE_NO_VIEW;
    private $title;


    /**
     * @param \View $view
     * @return \Document
     */
    final public function setView(\View $view) {
        if (!is_subclass_of($view, 'View')) {
            throw new \Exception\ViewNotFound($view);
        }
        $this->view = $view;
    }

    /**
     * @param string $title
     * @return string
     */
    public function title($title = ''){
        if (is_scalar($title) && $title){
            $this->title = $title . '';
        }

        return $this->title;
    }

    /**
     * @abstract
     * @return View
     */
    abstract public function Header();

    /**
     * @abstract
     * @return View
     */
    abstract public function Footer();


    /**
     * @param bool $return
     * @return string
     */
    public function render($return = false) {

        // load css and js from cache files

        $out = '';

        $out .= $this->Header() . '';

        $out .= $this->view;

        $out .= $this->Footer();

        if ($return){
            ob_start();
        }

        echo $out;

        if ($return){
            return ob_get_clean();
        }

    }
}

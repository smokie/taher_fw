<?php
/**
 * @author: smokiee
 * @date: 4/30/13
 * @package
 */

/**
 * @method @static \URLRules i()
 */
class URLRules
{
use I;

    private $url;
    private $rule;
    private $ruleString;

    const CACHE_NS = 'URLRewrite';

    public function __construct() {
        $this->url = System::i()->getURL();
        $this->selectRule();

        if (!$this->rule) {
            throw new \Exception\URLNotFound();
        }

    }

    public function getURLData() {

        $module = getv($this->rule, 'module', 'Index');
        $action = getv($this->rule, 'action', 'Index');

        if (strpos($module, ':') !== false) {
            $module = $this->getValueByParam($module);
        }

        if (strpos($action, ':') !== false) {
            $action = $this->getValueByParam($action);
        }

        $getParams = array();

        if (isset($this->rule['get'])) {
            foreach ($this->rule['get'] as $param=> $paramKey) {
                $getParams[$param] = $this->getValueByParam($paramKey);
            }
        }

        return array(
            'module' => $module,
            'action' => $action,
            'get'    => $getParams
        );
    }

    protected function selectRule() {

        $ruleString = ClassFactory::cache()->get($this->url, self::CACHE_NS);
        if ($ruleString) {
            $found = 1;
        } else {

            $rewrite = \Config\Rewrite::i();

            /** @var \Config\Rewrite */
            $rewriteRules = $rewrite->getRules();

            $urlSplits = explode("/", $this->url);
            $ruleString = '';
            foreach ($rewriteRules as $string => $rule) {
                $splits = explode("/", $string);

                if (count($splits) != count($urlSplits)) {
                    continue;
                }

                $paramRules = getv($rule, 'params', array());
                $splitCount = 0;
                foreach ($splits as $paramKey) {
                    $found = true;

                    $type = '';
                    if (strpos($paramKey, ':') !== false) {
                        if (!isset($paramRules[$paramKey])) {
                            throw new \Exception\ParameterNotFound($paramKey);
                        }

                        $type = $paramRules[$paramKey]['type'];
                    }
                    $valFn = $this->validationFnByParamType($type);

                    if (!$valFn($urlSplits[$splitCount])) {
                        $found = false;
                    }

                    if (!$found) {
                        break;
                    }

                    $splitCount++;
                    $ruleString = $string;

                    ClassFactory::cache()->set($this->url, $ruleString, self::CACHE_NS);
                }
            }
        }

        if ($found) {
            $this->setRule($ruleString);
        }
    }

    private function setRule($ruleString = '') {
        $rules = \Config\Rewrite::i()->getRules();

        $this->rule = $rules[$ruleString];
        $this->ruleString = $ruleString;
    }

    private function getValueByParam($paramKey) {
        if (!$this->rule) {
            throw new \Exception\URLNotFound();
        }

        if (!isset($this->rule['params'][$paramKey])) {
            throw new \Exception\ParameterNotFound($paramKey);
        }

        $splits = explode("/", $this->ruleString);
        $urlSplits = explode("/", $this->url);

        if (($splitKey = array_search($paramKey, $splits)) === false) {
            throw new \Exception\ParameterNotFound($paramKey);
        }

        $val = $urlSplits[$splitKey];
        $type = getv($this->rule['params'][$paramKey], 'type');


        switch ($type) {
            case 'integer':
                $val = intval($val) . '';
                break;
        }

        return $val;

    }

    private function validationFnByParamType($type) {

        switch ($type) {
            case 'integer':
                $fn =
                    function($v) {
                        return abs(intval($v)) . '' === (string)$v;
                    };
                break;

            case '':
            default:

                $preg = \Config\Validation::i()->getUrlPreg();
                if (strpos($type, 'preg:') === 0) {
                    $preg = substr($type, strlen('preg:'));
                }

                if (!$preg) {
                    $preg = '/.*/';
                }

                $fn =
                    function($v) use ($preg) {
                        return preg_match($preg, $v);
                    };

        }

        return $fn;

    }
}

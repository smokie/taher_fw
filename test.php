<?php
/**
 * @author: smokiee
 * @date: 4/26/13
 * @package
 */

include("lib/init.php");

//$track = new \DAO\Track();

//$mongo = \DB\Mongo::i()->connection();

//var_dump($mongo->database->tracks->find());
//die;

$d=  \DAO\Track::loadById(1);
var_dump($d);


die;


$l = new \Resources\ImageLoader(array('Index-list1'));
$l->getContent();

die;

$_GET['src'] = 'index-list2,index-list1,index-list3';
$_GET['type'] = 'js';

include("resources.php");


die;

include("index.php");

die;


$image = new Image(ROOT_PATH . '/image.png');


die;

$url = \URLRules::i();

$controller = Controller::i($url);

$controller
    ->runAction()
    ->render();


if (defined('DEBUG')){
    getRunTime();
}


die;


include dirname(__FILE__) . '/lib/init.php';


ClassFactory::cache()->set('key1', 'value1');
//echo $predis->get('a');



die;

$predis  = new \Predis\Client();

echo $pres->get("aa");



$loader= new \Resources\Loader('CSS', 'Index-list1');

$c = $loader->getContents();

print_r($c);

die;

$urlData= URLRules::i();

Controller::i($urlData)
    ->runAction()
    ->render()
;

var_dump(Controller::i()->css());



?>
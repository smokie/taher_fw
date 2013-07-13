<?php
/**
 * @author: smokiee
 * @date: 5/11/13
 * @package
 */

include("lib" . DIRECTORY_SEPARATOR . 'init.php');

$res = Request::i(Request::GET)->getSrc();
$type = Request::i(Request::GET)->getType();

if (!$res || !$type) {
    die("error");
}

$loader = new \Resources\Loader($type, $res);

if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
    $if_modified_since = preg_replace('/;.*$/', '',   $_SERVER['HTTP_IF_MODIFIED_SINCE']);
} else {
    $if_modified_since = '';
}

$mtime = filemtime($_SERVER['SCRIPT_FILENAME']);
$gmdate_mod = gmdate('D, d M Y H:i:s', $mtime) . ' GMT';

if ($if_modified_since == $gmdate_mod) {
    header("HTTP/1.0 304 Not Modified");
    exit;
}

$content_type = 'text/html';
switch ($type) {
    case 'css':
        $content_type = 'text/css';
        break;
    case 'js':
        $content_type = 'text/javascript';
}

header("Last-Modified: $gmdate_mod");
header('Content-type: ' . $content_type);
header('Expires: ' . date('D, d M Y H:i:s', time() + (60*60*24*45)) . ' GMT');

echo $loader
    ->getContent();

?>


<?php
/**
 * @author: smokiee
 * @date: 5/17/13
 * @package
 */


?>
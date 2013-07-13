<?php
/**
 * @author: smokiee
 * @date: 5/11/13
 * @package
 */

include("lib" . DIRECTORY_SEPARATOR . 'init.php');

$rules= URLRules::i();

Controller::i($rules)
    ->runAction()
;

?>
<!DOCTYPE html>

<html>
    <head>
        <title><?php echo ClassFactory::layout()->title() ?></title>
        <script type="text/javascript" src="<?= ClassFactory::urls()->getJsUrl(true) . '/' . Controller::i()->getJsSrc() ?>"></script>
    </head>
    <body>
        <?= Controller::i()->renderDocument() ?>
    </body>
</html>
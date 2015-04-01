<?php

require('core/init.inc.php');

$request = new Request();
$request->addParameter('mod', $_GET['mod']);
$request->addParameter('act', $_GET['act']);

$presentation = new Presentation();
$presentation->setMainTpl('main/templates/previewData.tpl');

$system = new SmartSystem($request, new Response(), $presentation);
$system->run();

?>
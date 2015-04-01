<?php

require('core/init.inc.php');

$request = new Request();
$request->addParameter('mod', 'gallery');
$request->addParameter('act', 'preview');

$presentation = new Presentation();
$presentation->setMainTpl('gallery/templates/preview.tpl');

$system = new SmartSystem($request, new Response(), $presentation);
$system->run();

?>
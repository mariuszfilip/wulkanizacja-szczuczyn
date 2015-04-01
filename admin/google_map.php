<?php

require('core/init.inc.php');

$presentation = new Presentation();
$presentation->setMainTpl('main/templates/google_map.tpl');

$system = new SmartSystem(new Request(), new Response(), $presentation);
$system->run();

?>
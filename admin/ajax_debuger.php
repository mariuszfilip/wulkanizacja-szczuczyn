<?php

require('core/init.inc.php');

$presentation = new Presentation();
$presentation->setMainTpl('ajax_debuger/templates/ajax_debuger.tpl');

$system = new SmartSystem(new Request(), new Response(), $presentation);
$system->run();

?>
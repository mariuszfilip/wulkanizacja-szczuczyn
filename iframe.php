<?php
require('core/init.inc.php');

$p = new Presentation();
$p->mainTpl = 'main/templates/iframe.tpl';
$p->setCompileDir("var/templates_c/");

$system = new SmartSystem(new Request(), new Response(array('iframe', true)), $p);
$system->run();

$s = Session::getInstance();
$s->unsetAttribute('login_error');

unset( $_SESSION['errors'] );
unset( $_SESSION['message'] );
?>
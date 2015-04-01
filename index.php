<?php
/*if(substr($_SERVER['HTTP_HOST'],0,3) !='www') {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:http://www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	header("Connection: close");
	die;
}*/

ini_set('display_errors', 0);
require('core/init.inc.php');
$p = new Presentation();
$p->setCompileDir("var/templates_c/");
$system = new SmartSystem(new Request(), new Response(), $p);
$system->run();

$s = Session::getInstance();
$s->unsetAttribute('login_error');

unset( $_SESSION['errors'] );
unset( $_SESSION['message'] );


?>
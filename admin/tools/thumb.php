<?php
require_once("../modules/main/classes/Thumb.class.php");
  $t = new Thumb($_GET['dir'],$_GET['file'],$_GET['w'],$_GET['h']);
  $t->setThumbsDir('../var/thumbs/');
  if( $t->setMime( $t->getFileExtension() ) ) {
    header( $t->getMime() );
		$expires = 3600; // seconds
		header("Pragma: public");
		header("Cache-Control: maxage=".$expires);
		header('Expires: '.gmdate('D, d M Y H:i:s', time()+$expires).' GMT');
		session_cache_limiter(false);
    $t->screenPicture();
  } else {
    echo "nie rozpoznawalne rozszerzenie pliku";
  }
?>
<?php
/**
 * Plik inicjalizacyjny SmartSystem
 *
 * @package smartsystem
 */

/** Plik konfiguracyjny */
require_once('core/config.inc.php');
require_once('core/config_paypal.inc.php');

/** Katalog z bazowymi klasami */
require_once(ROOT_CLASS_PATH . 'main/classes/AutoLoader.class.php');
/** Smarty */
require_once(ROOT_DIR . 'lib/smarty/Smarty.class.php');
/**  FCKeditor*/

require_once(ROOT_DIR . 'lib/ckeditor/ckeditor.php');
/**  phpMailer*/
require_once(ROOT_DIR . 'lib/phpmailer/class.phpmailer.php');
?>
<?php
/**
 * Plik inicjalizacyjny SmartSystem
 *
 * @package smartsystem
 */
ini_set('display_errors', 1);
/** Plik konfiguracyjny */
require_once('../core/config.inc.php');
/** Konfiguracja PayPal */
require('../core/config_paypal.inc.php');
/** Katalog z bazowymi klasami */
require(ADMIN_CLASS_PATH.'main/classes/AutoLoader.class.php');
/** Smarty */
require(ROOT_DIR.'lib/smarty/Smarty.class.php');
/** FCKeditor */

require_once(ROOT_DIR . 'lib/ckeditor/ckeditor.php');

/**  phpMailer */
require(ROOT_DIR.'lib/phpmailer/class.phpmailer.php');
?>
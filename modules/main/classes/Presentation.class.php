<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Warstwa prezentacyjna systemu.
 *
 * Warstwa prezentacyjna to rozszerzone szablony Smarty.
 *
 * @package smartsystem
 */
class Presentation extends Smarty implements IPresentation {

  public $mainTpl = 'main/templates/index.tpl';

  public function __construct() {
    $this->Smarty();
    $this->template_dir      = ROOT_DIR . 'modules/';
    $this->compile_dir       = ROOT_DIR . 'var/templates_c/';
    $this->config_dir        = ROOT_DIR . 'lib/smarty/configs/';
		if(ALLOW_DEBUG) {
			$this->debugging_ctrl    = 'URL';
			$this->_smarty_debug_id  = 'DEBUG';
		}
  }

  public function assignResponse(Response $response) {
    $responseArr = $response->toArray();
    foreach($responseArr as $key => $value) {
      if($value instanceof DBObject ||
         $value instanceof DBObjectsSimpleCollection ||
         $value instanceof DBObjectsCollection) {
      	$value = $value->toArray();
      }
      $this->_tpl_vars[$key] = $value;
    }
  }

  public function display() {
  	parent::display($this->mainTpl);
  }

  public function getMainTpl() {
  	return $this->mainTpl;
  }

  public function setMainTpl($mainTpl) {
  	$this->mainTpl = $mainTpl;
  }

  public function setTemplateDir($dir) {
  	$this->template_dir = ROOT_DIR . $dir;
  }
  
  public function setCompileDir($dir) {
  	$this->compile_dir = ROOT_DIR . $dir;
  }
}
?>
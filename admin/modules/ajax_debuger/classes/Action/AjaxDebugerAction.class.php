<?php
class AjaxDebugerAction extends Action {
  public function init() {
  }
  
  public function doAction($param) {
    
    $param = strip_tags($param);
    switch($param) {
      default:
        $this->getAll();
        break;
    }
  }

  protected function add() {
   
  }

  protected function getAll() {
	if($_SESSION['ajax_debug_array']){
		foreach($_SESSION['ajax_debug_array'] as $k=>$ajax_debug){
			$debugPresentation = new Presentation();
    		$debugPresentation->caching = false;
			$debugPresentation->assign('ajax_debug', $ajax_debug );
			$debugPresentation->assign('k', $k );		
			echo $debugContent = $debugPresentation->fetch('ajax_debuger/templates/single_debug.tpl');	
			unset($_SESSION['ajax_debug_array'][$k]);
		}
	}
  }

  protected function edit() {
  }

  protected function delete() {   
  }
  
}
?>
<?php
class AjaxAction extends Action {
  public function init() {
  }
  
  public function doAction($param) {
    
    $param = strip_tags($param);
    switch($param) {
			case 'show_search':
    		$this->show_search();
    		break;
      default:
        break;
    }
  }

  protected function add() {
  }

  protected function edit() {
  }

  protected function delete() {   
  }
	
	
	protected function show_search() { 
		if($this->request->getParameter('module') && isset($_POST['status'])){
			$_SESSION['show_search'][$this->request->getParameter('module')] = $this->request->getParameter('status');
		}
  }
  
}
?>
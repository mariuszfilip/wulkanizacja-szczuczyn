<?php
class GeneralAction extends Action {

  public function init() {
	  if($_GET['show_debug']=='show') {
		  $_SESSION['show_debug'] = true;
		  die;
	  }elseif($_GET['show_debug']=='hide') {
		  $_SESSION['show_debug'] = false;
		  die;
	  }
	  
	  elseif($_GET['show_left_menu']=='show') {
		  $_SESSION['hide_left_menu'] = false;
		  die;
	  }elseif($_GET['show_left_menu']=='hide') {
		  $_SESSION['hide_left_menu'] = true;
		  die;
	  }
  }

  public function doAction($param) {
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    $menuTopA = array ( 'title' => 'Strona główna' ) ;
    
    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
    
    $this->response->addParameter("moduletpl","general/templates/general.tpl");  
  }
}
?>
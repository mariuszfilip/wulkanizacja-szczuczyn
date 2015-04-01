<?php
class Meta_tagAction extends Action {
  public function init() {
  
  }
  
  public function doAction($param) {
  
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();
    
    $menuTopA = array ( 'title' => 'Domyślne meta tagi' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=meta_tag' ) ;
    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
  
    $param = strip_tags($param);
    switch($param) {
      case 'edit':
        $this->edit();
        break;
      case 'add':
        $this->add();
        break;
      case 'del':
        $this->delete();
        break;
      default:
        $this->edit();
        break;
    }
  }

  protected function add() {/*
    $meta_tag = new Meta_tag();
    $meta_tag->fromArray($this->request->getParameter('data'));
    if($this->request->getParameter('confirm')) {
      if($meta_tag->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $meta_tag);
        $this->response->addParameter('moduletpl', 'meta_tag/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'meta_tag/templates/add.tpl');
    }*/
  }

  protected function getAll() {
  }

  protected function edit() {
    $meta_tag = new Meta_tag();
    if($this->request->getParameter('confirms')) {
      $meta_tag->fromArray($this->request->getParameter('data'));
      $meta_tag->save();
			if($this->request->getParameter('all_lang')) $meta_tag->modifyAllLanguages($this->request->getParameter('all_lang'));
			$meta_tag = new Meta_tag();
    }

    $this->response->addParameter('data', $meta_tag);    
    $this->response->addParameter('moduletpl', 'meta_tag/templates/edit.tpl');
  }

  protected function delete() {
    /*$id = $this->request->getParameter('id');
    $meta_tag = new Meta_tag($id);
    $meta_tag->delete();
    $this->getAll();*/
  }
  
}
?>
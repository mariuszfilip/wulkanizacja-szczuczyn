<?php
class ServiceAction extends Action {
  public function init() {
  }
  
  public function doAction($param) {
  
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    if( $param == 'list' || $param == '') {
      $menuTopA = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=service' ) ;
    } elseif ( $param == 'add' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=service' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=service&amp;act=add' ) ;
    } elseif ( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=service' ) ;
      $menuTopA = array ( 'title' => 'Edycja' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=service&amp;act=edit&amp;id='.$this->request->getParameter('id') ) ;
    }

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
      case 'list':
      default:
        $this->getAll();
        break;
    }
  }

  protected function add() {
    $service = new Service();
    $service->fromArray($this->request->getParameter('data'));
	$categories = new Tree();
	$this->response->addParameter('categories', $categories->getTree());
	$this->response->addParameter('categories_type', $service->getTypeCategory());
    if($this->request->getParameter('confirms')) {
      if($service->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $service);
        $this->response->addParameter('moduletpl', 'service/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'service/templates/add.tpl');
    }
  }

  protected function getAll() {
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    $menuTopA = array ( 'title' => 'Lista' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=service' ) ;

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
	
	$s = Session::getInstance();
	if( $this->request->getParameter( 'search_service' ) )
	{
		$s->setAttribute('s_service', $this->request->getParameter( 's_service' ) );
		$_SESSION['paging'][$this->request->getParameter( 'mod' )]=0;
	}

	if( $s->is_set( 's_service' ) )
	{
		$this->response->addParameter('s_service', $s->getAttribute('s_service') );
    }	
    
    $this->response->addParameter('moduletpl', 'service/templates/list.tpl');
  }

  protected function edit() {
    $id = $this->request->getParameter('id');
    $service = new Service( ( int )$id );
    if($this->request->getParameter('confirms')) {		
      $service->fromArray($this->request->getParameter('data'));
	  	$realFileName = '';
      $mimeTypes = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif', 'image/bmp' );
  	  $uploadFile = new FileUpload('../files/service/','file',$mimeTypes);
			if($uploadFile) { // jesli zuploadowano plik na serwer
				if($uploadFile->move()) {
					$realFileName = $uploadFile->getFileName();
		     		$service->setPicture($realFileName);
		      	//$service->setPictureSize($uploadFile->getSize());
				    //ustawiam width i height po przeniesieniu pliku
				    /*$sizeArray 		= getimagesize(PICT_DIR.$realFileName);
						$page->setPictureWidth($sizeArray[0]);
						$page->setPictureHeight($sizeArray[1]);*/	
				}
			}
			
	  if($this->request->getParameter('delete_file')) {
			@unlink('../files/service/'.$service->getPicture());
			$service->setPicture('');
	  }
		$service->save();
		$service = new Service( (int)$id );
   }

    $this->response->addParameter('data', $service);
		$categories = new Tree();
		$this->response->addParameter('categories', $categories->getTree());
		$this->response->addParameter('categories_type', $service->getTypeCategory());
    $this->response->addParameter('moduletpl', 'service/templates/edit.tpl');
  }

  protected function delete() {
    $id = $this->request->getParameter('id');
    $service = new Service($id);
    $service->delete();
    $this->getAll();
  }
  
}
?>
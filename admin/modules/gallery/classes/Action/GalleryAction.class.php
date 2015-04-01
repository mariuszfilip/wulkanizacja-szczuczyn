<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.gallery
 */


/**
 * Obsłga modułu zarządzania galleryami.
 *
 * @package smartsystem.gallery
 */
class GalleryAction extends Action {

  public function init() {
	/*if($_POST['change_position']==1){
		$photo = new Photo($_POST['id_image']);
		$photo->move_it($_GET['id'], $_POST['direction']);
	}*/
	//if($_REQUEST['act'] == 'ajax_add_photo') {echo "1"; die;}
  }

  public function doAction($param) {
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
      case 'popup':
        $this->popup();
        break;
      case 'preview':
        $this->preview();
        break;
	  case 'ajax_add_photo':
	    $this->ajax_add_photo();
	    break;
      case 'list':
      default:
        $this->getAll();
        break;
    }
    $menuTopL = array ( ) ;
    $menuTopA = array ( ) ;
    $menuTopR = array ( ) ;

    if( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista galerii' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=gallery' ) ;
      $menuTopA = array ( 'title' => 'Edycja galerii' ) ;
    } elseif ( $param == 'add') {
      $menuTopL[] = array ( 'title' => 'Lista galerii' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=gallery' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie galerii' ) ;
    } else {
      $menuTopA = array ( 'title' => 'Lista galerii') ;
    }
    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);

  }

  protected function add() {
    $gallery = new Gallery();
    $gallery->fromArray($this->request->getParameter('data'));
    if( $this->request->getParameter('confirms') ) {
      if($gallery->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $gallery);
        $this->response->addParameter('moduletpl', 'gallery/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'gallery/templates/add.tpl');
    }
  }

  protected function getAll() {
    $s = Session::getInstance();
    $sort_arr = array(  'name' => 'nazwa',
              'active' => 'aktywny &nbsp;' );
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_gallery' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_gallery') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'name', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_gallery',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

//    print_r( $s->getAttribute('sort') );
    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_gallery' ) ) {
      $s->setAttribute('s_gallery', $this->request->getParameter( 's_gallery' ) );
      $s->setAttribute('page_gallery', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_gallery ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_gallery' ) ) {
      $this->response->addParameter('s_gallery', $s->getAttribute('s_gallery') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_gallery',(int)$_GET['page']);
    }
    $collection = new GallerysCollection( $s->getAttribute('page_gallery'),$s->getAttribute('sort_gallery') );
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'gallery/templates/list.tpl');


  }

  protected function edit() {
    $gallery = new Gallery($_GET['id']);
    $e = "";
    if($this->request->getParameter('confirms')) {
      $gallery->fromArray($this->request->getParameter('data'));
      $gallery->save();
    }
    if($this->request->getParameter('confirm_photo')) {
      $toDel_arr = $this->request->getParameter('deletePhoto');
      if( count( $toDel_arr ) > 0 ) {
        foreach( $toDel_arr as $del=>$val ) {
          $p = new Photo( $val );
          $p->delete();
        }
      }
	  
	  
	  if($_POST['order_sort']){
		$order_sort = explode('|', $_POST['order_sort']);
		//print_r($order_sort);
		foreach($order_sort as $order_key=>$order_value){
			//echo '<br>id: '.$order_value.' position: '.$order_key;
			$photo = new Photo($order_value);
			$photo->change_position($order_key);
		}
		
		/*$photo = new Photo($_POST['id_image']);
		$photo->move_it($_GET['id'], $_POST['direction']);*/		
	  }
	  
	  
      /*if ($p = new Photo() ){
        $type_array = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
        $p->setIdGallery( $_GET[ 'id' ] );
        //tutaj ustawiamy sciezke gdzie beda zapisywane photo
        $p->add('../files/photo/','file',$type_array);
      }*/
    }
	
    if($_POST['describe_array']) {
		if( count( $_POST['describe_array'] ) > 0 ){
	 		foreach( $_POST['describe_array'] as $key=>$val ) {
				$p = new Photo( $key );
				$p->update_desc($val);
	 		}
		}
    }

    if($_POST['name_array']) {
		if( count( $_POST['name_array'] ) > 0 ){
	 		foreach( $_POST['name_array'] as $key=>$val ) {
				$p = new Photo( $key );
				$p->update_name($val);
	 		}
		}
    }
	
    if($_POST) $gallery = new Gallery($_GET['id']);
    $this->response->addParameter('data', $gallery);
    $photo = new PhotosSimpleCollection( $_GET['id'] );
    $this->response->addParameter('photo', $photo);
    $this->response->addParameter('moduletpl', 'gallery/templates/edit.tpl');
	$this->response->addParameter('session_id', session_id());
  }
  
  protected function popup() {
    $gallery = new Gallery($_GET['id']);
    $e = "";
    if($this->request->getParameter('confirms')) {
      $gallery->fromArray($this->request->getParameter('data'));
      $gallery->save();
    }
    if($this->request->getParameter('confirm_photo')) {
      $toDel_arr = $this->request->getParameter('deletePhoto');
      if( count( $toDel_arr ) > 0 ) {
        foreach( $toDel_arr as $del=>$val ) {
          $p = new Photo( $val );
          $p->delete();
        }
      }
      if ($p = new Photo() ){
        $type_array = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif' );
        $p->setIdGallery( $_GET[ 'id' ] );
        $p->add('../files/photo/','file',$type_array);
      }
    }
    $gallery = new Gallery($_GET['id']);
    $this->response->addParameter('data', $gallery);
    $photo = new PhotosSimpleCollection( $_GET['id'] );
    $this->response->addParameter('photo', $photo);
    $this->response->addParameter('moduletpl', 'gallery/templates/popup-edit.tpl');
  }

  protected function preview() {
		$photo = new PhotosSimpleCollection( $_GET['id'] );
    $this->response->addParameter('photos', $photo);
    $this->response->addParameter('moduletpl', 'gallery/templates/preview.tpl');
  }

  protected function delete() {
    $gallery = new Gallery($_GET['id']);
    $gallery->delete();
    $this->getAll();
  }
  
  
  protected function ajax_add_photo() {	  

	if( $_GET['id'] && $_FILES['Filedata'] )
	{
		
		$ext_array = array('jpg','png','gif');
		$p = new Photo();		
		$p->setIdGallery( $_GET['id'] );
		//
		if( $p->add('../files/photo/','Filedata',$ext_array) ) echo '{"id":'.$p->getId().', "file":"'.$p->getFileName().'", "size":"'.$p->getWidth()."x".$p->getHeight().'"}'; else echo 'Błąd dodania pliku';
		
		unset($_SESSION['message']);
	}else{
		echo 'Błędne dane';
	}
  }

}
?>
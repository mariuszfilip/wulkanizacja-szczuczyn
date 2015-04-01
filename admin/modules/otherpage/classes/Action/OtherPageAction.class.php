<?php
/**
 * SmartSystem v.4
 *
 * @package smartsystem.otherpage
 */


/**
 * Obsłga modułu zarządzania otherpage.
 *
 * @package smartsystem.otherpage
 */
class OtherPageAction extends Action {

  public function init() {
  }

  public function doAction($param) {

    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();
    if( $param == 'list' || $param == '') {
      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      										  'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page'
      										);
      $menuTopA = array ( 'title' => 'Inne treści' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' ) ;
    } elseif ( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      										  'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page'
      										);
      $menuTopL[] = array ( 'title' => 'Inne treści' ,
                            'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage'
                          ) ;
      $menuTopA = array ( 'title' => 'Edycja treści' ) ;
    } elseif ( $param == 'add' ) {
      $menuTopL[] = array ( 'title' => 'Drzewko stron' ,
      										  'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page'
      										);
      $menuTopL[] = array ( 'title' => 'Inne treści' ,
                            'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage'
                          ) ;
      $menuTopA = array ( 'title' => 'Dodawanie nowej treści' ) ;
    } elseif ( $param == 'popup') {
      $menuTopA = array ( 'title' => 'Edycja treści' ) ;
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
     case 'popup':
      	$this->popup();
      	break;
      case 'getcontent':
      	$this->getContent();
      	break;
      case 'list':
      default:
        $this->getAll();
        break;
    }
  }

  protected function add() {
    $otherpage = new OtherPage();
    $otherpage->fromArray( $this->request->getParameter('data') );
    if( $this->request->getParameter('confirms') ) {
      if($otherpage->save()) {
        $this->getAll();
        echo '<script type=\'text/javascript\'>index.php?mod=otherpage&act=add&id='.(int)$_GET['id'].'\'</script>';

      } else {
        $this->response->addParameter('data', $otherpage);
        $this->response->addParameter('moduletpl', 'otherpage/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'otherpage/templates/add.tpl');
    }
  }

  protected function getAll() {
    $s = Session::getInstance();
    $sort_arr = array(  'name' => 'nazwa klucz',
              'content' => 'tytuł' );
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_otherpage' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_otherpage') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'name', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_otherpage',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_otherpage' ) ) {
      $s->setAttribute('s_otherpage', $this->request->getParameter( 's_otherpage' ) );
      $s->setAttribute('page_otherpage', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_gallery ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_otherpage' ) ) {
      $this->response->addParameter('s_otherpage', $s->getAttribute('s_otherpage') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_otherpage',(int)$_GET['page']);
    }
    $collection = new OtherPagesCollection( $s->getAttribute('page_otherpage'),$s->getAttribute('sort_otherpage') );

    $menuTopL = array ( ) ;
    $menuTopA = array ( ) ;
    $menuTopR = array ( ) ;

    $menuTopL[] = array ( 'title' => 'Drzewko stron' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=page' ) ;
    $menuTopA = array ( 'title' => 'Inne treści' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=otherpage' ) ;

    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);

    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'otherpage/templates/list.tpl');
  }

  protected function edit() {
    $otherpage = new OtherPage($_GET['id']);
    if($this->request->getParameter('confirms')) {
      $otherpage->fromArray($this->request->getParameter('data'));
      $otherpage->save();
      /*echo '<script type=\'text/javascript\'>location.href=\'index.php?mod=otherpage&act=edit&id='.(int)$_GET['id'].'\'</script>';*/
			$otherpage = new OtherPage($_GET['id']);
    }    
    $this->response->addParameter('data', $otherpage);
    $this->response->addParameter('moduletpl', 'otherpage/templates/edit.tpl');
  }

  protected function delete() {
    $id = $this->request->getParameter('id');
    $o = new OtherPage( ( int )$id );
    $deleted = $o->delete();
    $this->getAll();
  }

  public function popup() {
 		$otherpage = new OtherPage($_GET['id']);
    if($this->request->getParameter('confirm')) {
      $otherpage->fromArray($this->request->getParameter('data'));
      $otherpage->save();
    }
    $otherpage = new OtherPage($_GET['id']);
    $this->response->addParameter('data', $otherpage);
    $this->response->addParameter('moduletpl', 'otherpage/templates/popup-edit.tpl');
  }


	 	public function getContent() {
	 		$otherpage= new OtherPage($_GET['id']);
	    $this->response->addParameter('data', $otherpage->getContent());
	 }


}
?>
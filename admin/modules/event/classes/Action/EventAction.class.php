<?php

class EventAction extends Action {

  public function init() {
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
      case 'list':
      default:
        $this->getAll();
        break;
    }

    $menuTopL = array ( ) ;
    $menuTopA = array ( ) ;
    $menuTopR = array ( ) ;
    
    if( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista aktualności' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=event' ) ;
      $menuTopA = array ( 'title' => 'Edycja aktualności' ) ;
    } elseif ( $param == 'add') {
      $menuTopL[] = array ( 'title' => 'Lista aktualności' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=event' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie aktualności' ) ;
    } elseif ( $param == 'popup') {
      $menuTopA = array ( 'title' => 'Edycja aktualności' ) ;
    } else {
      $menuTopA = array ( 'title' => 'Lista aktualności') ;
    }
    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);
  }

  protected function add() {
    $event = new Event();
    $event->fromArray($this->request->getParameter('data'));
    $type_array = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif' );
    if($this->request->getParameter('confirms')) {
      if($event->save()) {
        $file = new FileUpload('../files/event/','logo',$type_array);
        if( $file->move() ) {
          $e = new Event( $event->getID() );
          $e->setPicture($file->getFileName());
          $e->save();
        }
        $this->getAll();
      } else {
        $this->response->addParameter('data', $event);
        $this->response->addParameter('moduletpl', 'event/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'event/templates/add.tpl');
    }
  }

  protected function getAll() {
    $s = Session::getInstance();
    $sort_arr = array(  'title' => 'tytuł',
                        'added' => 'data dodania',
                        'date_from' => 'wyswietlane od',
                        'date_to' => 'wyswietlane do',
                        'always' => 'bezterminowo',
                        'active' => 'aktywny'
              );
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_event' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_event') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'title', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_event',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

//    print_r( $s->getAttribute('sort') );
    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    $search = $this->request->getParameter( 'search_event' );
    if( isset( $search ) && !empty( $search ) ) {
      $s->setAttribute('s_event', $this->request->getParameter( 's_event' ) );
      $s->setAttribute('page_event', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_event ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_event' ) ) {
      $this->response->addParameter('s_event', $s->getAttribute('s_event') );
    }
    if( isset($_GET['page']) && (int)$_GET['page'] > 0) {
      $s->setAttribute('page_event',(int)$_GET['page']);
    }
    $collection = new EventsCollection( $s->getAttribute('page_event'),$s->getAttribute('sort_event') );
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'event/templates/list.tpl');


  }

  protected function edit() {
    $s = Session::getInstance();
    $event = new Event($_GET['id']);
    $type_array = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif' );
    if($this->request->getParameter('confirms'))
    {
      $event->fromArray($this->request->getParameter('data'));
      $delete_file = $this->request->getParameter('delete_file');
      if( ( int )$delete_file == 1 )
      {
      	$event->setPicture('');
      }
      $event->save();
      $file = new FileUpload('../files/event/','file',$type_array);
      if( $file->move() )
      {
        $e = new Event( $_GET['id'] );
        $e->setPicture($file->getFileName());
        $e->save();
      }
			$event = new Event($_GET['id']);
    }    
    $this->response->addParameter('data', $event);
    $this->response->addParameter('moduletpl', 'event/templates/edit.tpl');
  }
  
  protected function popup() {
    $event = new Event($_GET['id'], $s->getAttribute('lang'));
    if($this->request->getParameter('confirm')) {
      $event->fromArray($this->request->getParameter('data'));
      $event->save();
    }
    $event = new Event($_GET['id'], $s->getAttribute('lang'));
    $this->response->addParameter('data', $event);
    $this->response->addParameter('moduletpl', 'event/templates/popup-edit.tpl');
  }

  protected function delete() {
    $event = new Event($_GET['id']);
    $event->delete();
    $this->getAll();
  }

}
?>
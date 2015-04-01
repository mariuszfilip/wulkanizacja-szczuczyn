<?php
class EventAction extends Action {

  public function init() {
      $events_menu = new EventsSimpleCollection(EVENT_PER_VIEW);  // ostatnie aktualnosci
      $this->response->addParameter('events_menu', $events_menu->getArr());
  }

  public function doAction($param) {
	  
		$page_node = new Page();
		$page_node->getByModule('event');
		$name = $page_node->getName();
		$this->response->addParameter('event_title',$name);
		$this->response->addParameter('page',$page_node);
	  
    $ida = $this->request->getParameter('ida');
    if( (int)$ida > 0 ) {
      $event = new Event($ida);
      $this->response->addParameter('event',$event);
      $this->response->addParameter('moduletpl', 'event/templates/event.tpl');
    } else {
      $s = Session::getInstance();
      
      $sort_arr = array(  
      		'added' => 'dodano'
      );
      $sort = new Sort();
      $sort -> setSort( $sort_arr );
      if( $s->is_set( 'sort_events' ) ) {
        if( $this->request->getParameter('sort_change') ) {
          $sort->setSortParam( $this->request->getParameter('sort') );
        } else {
          $sort->setSortParam( $s->getAttribute('sort_events') );
        }
      } else {
        $sort -> setSortParam( array( 'sort' => 'added', 'sortdir' => 'ASC' ) );
      }
      $s->setAttribute( 'sort_events',$sort->getSortParam() );
      $this->response->addParameter('sort', $sort->getSort() );
      // sprawdzamy czy wyszukiwanie ...
      // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
      if( $this->request->getParameter( 'search_events' ) ) {
        $s->setAttribute('s_events', $this->request->getParameter( 's_events' ) );
        $s->setAttribute('page_events', 1);
      }
      // sprawdzamy czy jest ustawiona sesja dla s_candidate ...
      // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
      if( $s->is_set( 's_events' ) ) {
        $this->response->addParameter('s_events', $s->getAttribute('s_events') );
      }
    
      $page = 0;
      $page = $this->request->getParameter( 'page' );
      if( isset($page) && (int)$page > 0) {
        $s->setAttribute('page_events',(int)$page);
      }else{
	  $s->setAttribute('page_events','1');
	  }
      
      $collection = new EventsCollection($s->getAttribute('page_events') );
      $this->response->addParameter('collection', $collection);
      $this->response->addParameter('moduletpl', 'event/templates/events.tpl');
    }
  }

}
?>
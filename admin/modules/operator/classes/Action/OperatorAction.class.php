<?php

class OperatorAction extends Action {

  public function init() {
  }

  public function doAction($param) {
  
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    if( $param == 'list' || $param == '') {
      $menuTopA = array ( 'title' => 'Lista operatorów' );
    } elseif ( $param == 'add' ) {
      $menuTopL[] = array ( 'title' => 'Lista operatorów' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=operator' ) ;
      $menuTopA = array ( 'title' => 'Dodawanie nowego operatora' ) ;
    } elseif ( $param == 'edit' ) {
      $menuTopL[] = array ( 'title' => 'Lista operatorów' , 'href' => $_SERVER [ 'PHP_SELF' ] . '?mod=operator' ) ;
      $menuTopA = array ( 'title' => 'Edycja operatora' ) ;
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
    $operator = new Operator();
    $operator->fromArray($this->request->getParameter('data'));
    if($this->request->getParameter('confirms')) {
      if($operator->save()) {
        $this->getAll();
      } else {
        $this->response->addParameter('data', $operator);
        $this->response->addParameter('moduletpl', 'operator/templates/add.tpl');
      }
    } else {
      $this->response->addParameter('moduletpl', 'operator/templates/add.tpl');
    }
  }

  protected function getAll() {
    $s = Session::getInstance();
    $sort_arr = array(  
			'name' => 'imię',
			'surname' => 'nazwisko',
			'added' => 'data dodania',
			'modified' => 'data modyfikacji',
			'active' => 'aktywny'
    );
    $sort = new Sort();
    $sort -> setSort( $sort_arr );
    if( $s->is_set( 'sort_operator' ) ) {
      if( $this->request->getParameter('sort_change') ) {
        $sort->setSortParam( $this->request->getParameter('sort') );
      } else {
        $sort->setSortParam( $s->getAttribute('sort_operator') );
      }
    } else {
      $sort -> setSortParam( array( 'sort' => 'name', 'sortdir' => 'ASC' ) );
    }
    $s->setAttribute( 'sort_operator',$sort->getSortParam() );
    $this->response->addParameter('sort', $sort->getSort() );

    // sprawdzamy czy wyszukiwanie ...
    // ... jesli tak to przypisujemy wyszukiwane arguemty do sesji
    if( $this->request->getParameter( 'search_operator' ) ) {
      $s->setAttribute('s_operator', $this->request->getParameter( 's_operator' ) );
      $s->setAttribute('page_operator', 1);
    }
    // sprawdzamy czy jest ustawiona sesja dla s_candidate ...
    // ... jesli tak to przypisujemy do tablicy ktora wypiszemy w wyszukiwarce
    if( $s->is_set( 's_operator' ) ) {
      $this->response->addParameter('s_operator', $s->getAttribute('s_operator') );
    }

    $page = 0;
    $page = $this->request->getParameter( 'page' );
    if( isset($page) && (int)$page > 0) {
      $s->setAttribute('page_operator',(int)$page);
    }

    $collection = new OperatorsCollection( $s->getAttribute('page_operator') );
 
    $menuTopL = array();
    $menuTopA = array();
    $menuTopR = array();

    $menuTopA = array ( 'title' => 'Lista operatorów' );
    $this->response->addParameter('menuTopL', $menuTopL);
    $this->response->addParameter('menuTopA', $menuTopA);
    $this->response->addParameter('menuTopR', $menuTopR);    
    $this->response->addParameter('collection', $collection);
    $this->response->addParameter('moduletpl', 'operator/templates/list.tpl');
  }

  protected function edit() {
    $id = $this->request->getParameter('id');
    $o = new Operator( (int)$id );
    if($this->request->getParameter('confirms')) {
      $o->fromArray($this->request->getParameter('data'));
      $o->save();
			$o = new Operator( (int)$id );
    }

    $this->response->addParameter('data', $o);
		$this->response->addParameter('modules_o', $o->modules_o);
    $this->response->addParameter('moduletpl', 'operator/templates/edit.tpl');
  }

  protected function delete() {
    $operator = new Operator($_GET['id']);
    $operator->delete();
    $this->getAll();
  }

}

?>
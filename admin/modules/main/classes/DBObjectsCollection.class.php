<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Abstrakcyjna kolekcja obiektów - rekordów z bazy danych.
 *
 * @package smartsystem
 */
abstract class DBObjectsCollection {
  
  public $items = array();
  protected $DB    = null;
  public $page = array();
  
  protected $rows_per_view = 25;
  protected $all        = 0;
  protected $all_pages  = 0;
  protected $current    = 1;
  protected $from       = 0;
  protected $to         = 0;
  protected $first      = 0;
  protected $last       = 0;
  protected $next       = 0;
  protected $next_1     = 0;
  protected $next_2     = 0;
  protected $previous   = 0;
  protected $previous_1 = 0;
  protected $previous_2 = 0;
  protected $backwards  = 0;
  protected $forwards   = 0;
//  protected $sql_conditions        = 0;
/*
  protected $sort_arr = array();
*/
  protected $sort;
  protected $sortdir;

  public function __construct( $current_page = 1) {
    $this->setCurrent( $current_page );
    
//    $this->setSqlConditions( $sql_conditions );
    $this->DB = DB::getInstance();
		if($this->sql_order && is_array($this->field_type) && $_SESSION['collation']) {			
			$order_array=explode('.', trim(substr(str_replace('`', '',$this->sql_order), 0, -4)));
			$order_name = (count($order_array) >0) ? $order_array[count($order_array)-1] : $order_array[0];
		
			if( in_array($order_name, array_keys($this->field_type)) )  
				if(substr($this->field_type[$order_name],0, 7) == 'varchar'){
					$this->sql_order = substr($this->sql_order,0,-4).' COLLATE '.$_SESSION['collation'].' '.substr($this->sql_order,-4);
				}
		}
    $this->load();
  }
  
  protected function setSortParam( $sort_arr ) {
    $this->sort = $sort_arr['sort'];
    $this->sortdir = $sort_arr['sortdir'];
  }
  
  protected function getSqlConditions() {
    return $this->sql_conditions;
  }
  
  protected function setSqlConditions( $_sql_conditions ) {
    $this -> sql_conditions = $_sql_conditions;
  }
  
  protected function getRowsPerView() {
    return $this->rows_per_view;
  }
  
  protected function setBackwards( $_backwards ) {
    $this->backwards = ( int )$_backwards;
  }
  
  protected function getBackwards() {
    return $this->backwards;
  }
  
  protected function setForwards( $_forwards ) {
    $this->forwards = ( int )$_forwards;
  }
  
  protected function getForwards() {
    return $this->forwards;
  }
  
  protected function setCurrent( $_current ) {
    $this -> current = ( int )$_current;
  }
  
  protected function getCurrent() {
    return $this->current ;
  }
  
  
  protected function setAll( $_all ){
    $this -> all = $_all;
  }
  
  protected function getAll(){
    return $this->all ;
  }
    
  protected function setAllPages(){
    $this -> all_pages = ceil( $this -> all / $this -> rows_per_view );
  }
  
  protected function getAllPages() {
    return $this->all_pages ;
  }
  
  protected function setFrom() {
   $this->from = ( ( $this->current * $this -> rows_per_view ) - $this -> rows_per_view );
  }
  
  protected function getFrom() {
    return $this->from;
  }
  
  protected function setTo( $_ilosc_wynikow_zapytania ) {
    $this -> to = $this->from + $_ilosc_wynikow_zapytania;
  }
  
  protected function getTo() {
    return $this->to;
  }

  protected function setPrevious( $_previous ) {
    $this->previous = ( int )$_previous;
  }
  
  protected function getPrevious() {
    return $this->previous;
  }
  
  protected function setPrevious1( $_previous ) {
    $this->previous_1 = ( int )$_previous;
  }
  
  protected function getPrevious1() {
    return $this->previous_1;
  }
  
  protected function setPrevious2( $_previous ) {
    $this->previous_2 = ( int )$_previous;
  }
  
  protected function getPrevious2() {
    return $this->previous_2;
  }
  
  protected function setFirst( $_first ) {
    $this->first = ( int )$_first;
  }
  
  protected function getFirst() {
    return $this->first;
  }
  
  protected function setNext( $_next ){
    $this->next = ( int )$_next;
  }
  
  protected function getNext() {
    return $this->next;
  }
  
  protected function setNext1( $_next ){
    $this->next_1 = ( int )$_next;
  }
  
  protected function getNext1() {
    return $this->next_1;
  }
  
  protected function setNext2( $_next ){
    $this->next_2 = ( int )$_next;
  }
  
  protected function getNext2() {
    return $this->next_2;
  }
  
  protected function setLast( $_last ){
    $this->last = ( int )$_last;
  }
  
  protected function getLast() {
    return $this->last;
  }
  
  /**
   * Przedtem byla funkcja
   * 
public function toArray() {
  $r = array();
  for($i=0, $j=count($this->items); $i<$j; $i++) {
    if ($this->items[$i] instanceof DBObject) {
      $r[$i] = $this->items[$i]->toArray();
    }
  }
  return $r;
}
   *
   * @return unknown
   */
  
  public function toArray() {
    $r = array();
    for($i=0, $j=count($this->items); $i<$j; $i++) {
      if ($this->items[$i] instanceof DBObject) {
        $r['items'][$i] = $this->items[$i]->toArray();
      }
      $r['page'] = $this->page;
    }
    return $r;
  }


  protected function loadPage( $_sql ){
    $r = array();
    $this->DB = DB::getInstance();
    //$this -> setCurrent( $_current );
    $stmt = $this->DB->query($_sql);
    if( $stmt ) {
      $this -> setAll( count($stmt->fetchAll()) );
      $stmt->closeCursor();
    } else {
      $this -> setAll( 0 );
    }
    
    $this -> setAllPages();
    
    if( $this->current > 1 ) {
      $this -> setFrom();

    }
    
    $sql = $_sql . ' LIMIT ' . $this->from . ', ' . $this->rows_per_view ;
    $this->DB = DB::getInstance();
    $stmt1 = $this->DB->query( $sql );
    if( $stmt1 ) {
      $this->setTo( count($stmt1->fetchAll()) );
      $stmt1->closeCursor();
    } else {
      $this->setTo( 0 );
    }
    
    
    if( ( int )$this->current > 1 ) {
      $this->setPrevious( $this->current-1 );
      $this->setFirst( 1 );
    }
    if( $this->current < $this->all_pages ) {
      $this->setNext( $this->current+1 );
      $this->setLast( $this->all_pages );
    }
  
    $count = $this->current-3;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setBackwards( $count );
    }
    $count ++;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setPrevious2( $count );
    }
    $count ++;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setPrevious1( $count );
    }
    // current
    $count ++;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setCurrent( $count );
    }
  
    $count ++;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setNext1( $count );
    }
    $count ++;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setNext2( $count );
    }
    $count ++;
    if( $count >= 1 && $count <= $this->all_pages ) {
      $this->setForwards( $count );
    }
    
    $this->page['all']            = $this->getAll();
    $this->page['all_pages']      = $this->getAllPages();
    $this->page['rows_per_view']  = $this->getRowsPerView();
    $this->page['current']        = $this->getCurrent();
    $this->page['from']           = $this->getFrom() + 1;
    $this->page['to']             = $this->getTo();
    $this->page['last']           = $this->getLast();
    $this->page['first']          = $this->getFirst();
    $this->page['next']           = $this->getNext();
    $this->page['next_1']         = $this->getNext1();
    $this->page['next_2']         = $this->getNext2();
    $this->page['previous']       = $this->getPrevious();
    $this->page['previous_1']     = $this->getPrevious1();
    $this->page['previous_2']     = $this->getPrevious2();
    $this->page['backwards']      = $this->getBackwards();
    $this->page['forwards']       = $this->getForwards();
  }
  
  
/*
  function setSort( $_dane ) {
    foreach( $_dane as $k => $v ) {
      $this -> sort_arr[ $k ] = $v;
    }
  }
  
  function getSort() {
    $a = array();
    $a[ 'sort' ] = $this -> sort;
    $a[ 'sortdir' ] = $this -> sortdir;
    foreach( $this -> sort_arr as $k => $v ){
      $a[ 'value' ][ $k ] = $v;
    }
    return $a;
  }
  
  function setSortParam( $_param ){
    $this -> sort = $_param[ 'sort' ];
    $this -> sortdir = $_param[ 'sortdir' ];
  }
*/  
  abstract protected function load( );
  
}

?>